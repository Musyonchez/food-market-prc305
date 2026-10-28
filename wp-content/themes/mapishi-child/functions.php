<?php
/**
 * Mapishi Child theme functions.
 */

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'astra-parent', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style(
		'mapishi-child',
		get_stylesheet_uri(),
		array( 'astra-parent' ),
		wp_get_theme()->get( 'Version' )
	);
} );

/**
 * Return the Dokan vendor object for a product, or null if Dokan is inactive.
 */
function mk_get_vendor( $product_id ) {
	if ( ! function_exists( 'dokan_get_vendor_by_product' ) ) {
		return null;
	}
	$vendor = dokan_get_vendor_by_product( $product_id );
	return ( $vendor && $vendor->get_id() ) ? $vendor : null;
}

/**
 * Show "By <cook>" under the title on dish cards.
 */
add_action( 'woocommerce_after_shop_loop_item_title', function () {
	$vendor = mk_get_vendor( get_the_ID() );
	if ( ! $vendor ) {
		return;
	}
	printf(
		'<span class="mk-cook-name">By <a href="%s">%s</a></span>',
		esc_url( $vendor->get_shop_url() ),
		esc_html( $vendor->get_shop_name() )
	);
}, 6 );

/**
 * Show the cook on the single dish page too.
 */
add_action( 'woocommerce_single_product_summary', function () {
	$vendor = mk_get_vendor( get_the_ID() );
	if ( ! $vendor ) {
		return;
	}
	printf(
		'<span class="mk-cook-name">Cooked by <a href="%s">%s</a></span>',
		esc_url( $vendor->get_shop_url() ),
		esc_html( $vendor->get_shop_name() )
	);
}, 6 );

/**
 * "Order on WhatsApp" button on the dish page, using the cook's store phone.
 */
add_action( 'woocommerce_single_product_summary', function () {
	global $product;
	$vendor = mk_get_vendor( get_the_ID() );
	if ( ! $vendor || ! $product ) {
		return;
	}
	$phone = preg_replace( '/\D+/', '', (string) $vendor->get_phone() );
	if ( ! $phone ) {
		return;
	}
	// Kenyan local format 07xx -> 2547xx.
	if ( strpos( $phone, '0' ) === 0 ) {
		$phone = '254' . substr( $phone, 1 );
	}
	$text = sprintf(
		'Hi %s, I would like to order %s (KSh %s).',
		$vendor->get_shop_name(),
		$product->get_name(),
		$product->get_price()
	);
	printf(
		'<a class="mk-whatsapp" href="%s" target="_blank" rel="noopener">Order on WhatsApp</a>',
		esc_url( 'https://wa.me/' . $phone . '?text=' . rawurlencode( $text ) )
	);
}, 35 );

/**
 * Format prices as "KSh 350" with no decimals.
 */
add_filter( 'woocommerce_price_trim_zeros', '__return_true' );

/**
 * Brand fonts (Google Fonts) and favicon.
 */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'mapishi-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@600;700&display=swap',
		array(),
		null
	);
} );

add_action( 'wp_head', function () {
	if ( has_site_icon() ) {
		return;
	}
	printf( '<link rel="icon" type="image/svg+xml" href="%s">' . "\n", esc_url( get_stylesheet_directory_uri() . '/assets/favicon.svg' ) );
} );

/**
 * Branded placeholder for dishes that have no photo yet.
 */
add_filter( 'woocommerce_placeholder_img_src', function () {
	return get_stylesheet_directory_uri() . '/assets/placeholder.svg';
} );

/**
 * Logo in the header when no logo is uploaded in the Customizer.
 */
add_filter( 'get_custom_logo', function ( $html ) {
	if ( $html ) {
		return $html;
	}
	return sprintf(
		'<a class="mk-logo" href="%s" rel="home"><img src="%s" alt="%s" width="190" height="43"></a>',
		esc_url( home_url( '/' ) ),
		esc_url( get_stylesheet_directory_uri() . '/assets/logo.svg' ),
		esc_attr( get_bloginfo( 'name' ) )
	);
} );

/**
 * Customizer section "Mapishi Contact and Social": the client's connection points.
 * Appearance > Customize > Mapishi Contact and Social.
 */
function mk_contact_fields() {
	return array(
		'mk_email'     => array( 'Contact email', 'sanitize_email' ),
		'mk_phone'     => array( 'Phone (e.g. 0712 345 678)', 'sanitize_text_field' ),
		'mk_whatsapp'  => array( 'WhatsApp number, international (e.g. 254712345678)', 'sanitize_text_field' ),
		'mk_facebook'  => array( 'Facebook page URL', 'esc_url_raw' ),
		'mk_instagram' => array( 'Instagram profile URL', 'esc_url_raw' ),
		'mk_youtube'   => array( 'YouTube channel URL', 'esc_url_raw' ),
		'mk_tiktok'    => array( 'TikTok profile URL', 'esc_url_raw' ),
		'mk_x'         => array( 'X (Twitter) profile URL', 'esc_url_raw' ),
	);
}

add_action( 'customize_register', function ( $wp_customize ) {
	$wp_customize->add_section( 'mk_contact', array(
		'title'    => 'Mapishi Contact and Social',
		'priority' => 30,
	) );
	foreach ( mk_contact_fields() as $key => $f ) {
		$wp_customize->add_setting( $key, array(
			'default'           => '',
			'sanitize_callback' => $f[1],
		) );
		$wp_customize->add_control( $key, array(
			'section' => 'mk_contact',
			'label'   => $f[0],
			'type'    => 'text',
		) );
	}
} );

/**
 * [mk_contact_details] shortcode for the Contact page.
 */
add_shortcode( 'mk_contact_details', function () {
	$out  = '<ul class="mk-contact-list">';
	$mail = get_theme_mod( 'mk_email' );
	$tel  = get_theme_mod( 'mk_phone' );
	$wa   = preg_replace( '/\D+/', '', (string) get_theme_mod( 'mk_whatsapp' ) );
	if ( $mail ) {
		$out .= '<li><strong>Email:</strong> <a href="mailto:' . esc_attr( $mail ) . '">' . esc_html( $mail ) . '</a></li>';
	}
	if ( $tel ) {
		$out .= '<li><strong>Phone:</strong> <a href="tel:' . esc_attr( preg_replace( '/\s+/', '', $tel ) ) . '">' . esc_html( $tel ) . '</a></li>';
	}
	if ( $wa ) {
		$out .= '<li><strong>WhatsApp:</strong> <a href="https://wa.me/' . esc_attr( $wa ) . '" target="_blank" rel="noopener">Chat with us</a></li>';
	}
	$out .= '<li><strong>Area:</strong> Nairobi</li><li><strong>Hours:</strong> Mon-Sat, 8am-8pm</li></ul>';
	return $out;
} );

/**
 * Social strip above the footer. Only networks with a URL are shown.
 */
add_action( 'wp_footer', function () {
	$nets = array(
		'mk_facebook'  => 'Facebook',
		'mk_instagram' => 'Instagram',
		'mk_youtube'   => 'YouTube',
		'mk_tiktok'    => 'TikTok',
		'mk_x'         => 'X',
	);
	$links = '';
	foreach ( $nets as $key => $label ) {
		$url = get_theme_mod( $key );
		if ( $url ) {
			$links .= sprintf( '<a href="%s" target="_blank" rel="noopener" aria-label="%s">%s</a>', esc_url( $url ), esc_attr( $label ), esc_html( $label ) );
		}
	}
	if ( ! $links ) {
		return;
	}
	echo '<div class="mk-social"><span>Follow us</span>' . $links . '</div>';
} );
