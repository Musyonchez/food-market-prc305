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
