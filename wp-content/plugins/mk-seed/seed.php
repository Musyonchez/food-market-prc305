<?php
/**
 * Seeds the local site: WooCommerce settings, cooks (Dokan vendors), dishes, pages, menus.
 * Run from the WordPress root:  wp eval-file <repo>/scripts/setup-local.php <repo-path>
 * Safe to re-run: existing users/pages/products are skipped.
 */


// ---- WooCommerce basics ---------------------------------------------------
update_option( 'woocommerce_currency', 'KES' );
update_option( 'woocommerce_default_country', 'KE:30' );
update_option( 'woocommerce_price_num_decimals', 0 );
update_option( 'woocommerce_currency_pos', 'left_space' );
update_option( 'woocommerce_enable_reviews', 'yes' );
update_option( 'woocommerce_task_list_hidden', 'yes' );
update_option( 'woocommerce_onboarding_profile', array( 'skipped' => true ) );
$cod = get_option( 'woocommerce_cod_settings', array() );
$cod['enabled']     = 'yes';
$cod['title']       = 'Pay on delivery / pickup';
$cod['description'] = 'Pay the cook in cash or M-Pesa when you receive your food.';
update_option( 'woocommerce_cod_settings', $cod );

// Shipping zone: Nairobi flat rate + local pickup.
if ( ! WC_Data_Store::load( 'shipping-zone' )->get_zones() ) {
	$zone = new WC_Shipping_Zone();
	$zone->set_zone_name( 'Nairobi' );
	$zone->add_location( 'KE', 'country' );
	$zone->save();
	$flat   = $zone->add_shipping_method( 'flat_rate' );
	$pickup = $zone->add_shipping_method( 'local_pickup' );
	update_option( 'woocommerce_flat_rate_' . $flat . '_settings', array( 'title' => 'Delivery (Nairobi)', 'cost' => '150', 'tax_status' => 'none' ) );
	update_option( 'woocommerce_local_pickup_' . $pickup . '_settings', array( 'title' => 'Pickup from the cook', 'cost' => '0' ) );
}

// ---- Cuisine categories + dietary tags ------------------------------------
$cats = array(
	'Swahili / Coastal', 'Kenyan Classics', 'Indian', 'Italian', 'Chinese / Asian',
	'Street Food', 'Healthy / Vegan', 'Desserts and Bakes', 'Drinks',
);
foreach ( $cats as $c ) {
	if ( ! term_exists( $c, 'product_cat' ) ) {
		wp_insert_term( $c, 'product_cat' );
	}
}

// ---- Cooks (Dokan vendors) -----------------------------------------------
$cooks = array(
	'Mama Amina'   => array( 'login' => 'cook_amina',   'shop' => 'Mombasa Kitchen', 'area' => 'Eastleigh',  'phone' => '0712000001', 'bio' => 'Third-generation coastal cook. Pilau, biryani and fresh fish the way my grandmother made them.' ),
	'Baba Otieno'  => array( 'login' => 'cook_otieno',  'shop' => 'Choma Corner',    'area' => 'Kasarani',   'phone' => '0712000002', 'bio' => 'Weekend choma master turned full-time cook. Honest Kenyan food, charcoal grilled.' ),
	'Priya Shah'   => array( 'login' => 'cook_priya',   'shop' => 'Spice Route',     'area' => 'Parklands',  'phone' => '0712000003', 'bio' => 'Family recipes from Gujarat and Nairobi, cooked fresh to order.' ),
	'Luca Rossi'   => array( 'login' => 'cook_luca',    'shop' => "Nonna's Oven",    'area' => 'Westlands',  'phone' => '0712000004', 'bio' => 'Italian home cooking: thin-crust pizza, lasagne and desserts made from scratch.' ),
	'Wanjiru Green' => array( 'login' => 'cook_wanjiru', 'shop' => 'Fresh Bowl',      'area' => 'Kilimani',   'phone' => '0712000005', 'bio' => 'Plant-based bowls, soups and smoothies. Healthy food that actually tastes good.' ),
);
$cook_ids = array();
foreach ( $cooks as $name => $c ) {
	$u = get_user_by( 'login', $c['login'] );
	if ( ! $u ) {
		$uid = wp_insert_user( array(
			'user_login'   => $c['login'],
			'user_pass'    => 'password123',
			'user_email'   => $c['login'] . '@example.com',
			'display_name' => $name,
			'first_name'   => explode( ' ', $name )[0],
			'role'         => 'seller',
		) );
	} else {
		$uid = $u->ID;
	}
	update_user_meta( $uid, 'dokan_enable_selling', 'yes' );
	update_user_meta( $uid, 'dokan_publishing', 'yes' );
	update_user_meta( $uid, 'dokan_store_name', $c['shop'] );
	update_user_meta( $uid, 'dokan_profile_settings', array(
		'store_name'  => $c['shop'],
		'phone'       => $c['phone'],
		'show_email'  => 'no',
		'address'     => array( 'street_1' => $c['area'], 'city' => 'Nairobi', 'country' => 'KE' ),
		'location'    => '',
		'banner'      => 0,
		'gravatar'    => 0,
		'store_ppp'   => 12,
		'vendor_biography' => $c['bio'],
		'dokan_store_time_enabled' => 'no',
	) );
	$cook_ids[ $name ] = $uid;
}

// ---- Dishes from CSV ------------------------------------------------------
$csv = $repo . '/exports/sample-products.csv';
if ( file_exists( $csv ) && ! wc_get_product_id_by_sku( 'MK-001' ) ) {
	$fh   = fopen( $csv, 'r' );
	$head = fgetcsv( $fh );
	while ( ( $row = fgetcsv( $fh ) ) !== false ) {
		$r = array_combine( $head, $row );
		$p = new WC_Product_Simple();
		$p->set_name( $r['Name'] );
		$p->set_sku( $r['SKU'] );
		$p->set_status( 'publish' );
		$p->set_featured( (bool) $r['Is featured?'] );
		$p->set_short_description( $r['Short description'] );
		$p->set_description( $r['Description'] );
		$p->set_regular_price( $r['Regular price'] );
		$p->set_stock_status( 'instock' );
		$cat_ids = array();
		foreach ( explode( ',', $r['Categories'] ) as $cn ) {
			$t = get_term_by( 'name', trim( $cn ), 'product_cat' );
			if ( $t ) {
				$cat_ids[] = $t->term_id;
			}
		}
		$p->set_category_ids( $cat_ids );
		$tag_ids = array();
		foreach ( array_filter( array_map( 'trim', explode( ',', $r['Tags'] ) ) ) as $tn ) {
			$t = term_exists( $tn, 'product_tag' ) ?: wp_insert_term( $tn, 'product_tag' );
			$tag_ids[] = (int) ( is_array( $t ) ? $t['term_id'] : $t );
		}
		$p->set_tag_ids( $tag_ids );
		$id = $p->save();
		foreach ( $cook_ids as $name => $uid ) {
			if ( false !== strpos( $r['Description'], 'Cook: ' . explode( ' ', $name )[0] ) || false !== strpos( $r['Description'], $name ) ) {
				wp_update_post( array( 'ID' => $id, 'post_author' => $uid ) );
				break;
			}
		}
	}
	fclose( $fh );
}

// ---- Pages ---------------------------------------------------------------
function mk_page( $title, $content, $slug = '' ) {
	$existing = get_page_by_path( $slug ?: sanitize_title( $title ) );
	if ( $existing ) {
		return $existing->ID;
	}
	return wp_insert_post( array(
		'post_title'   => $title,
		'post_name'    => $slug ?: sanitize_title( $title ),
		'post_content' => $content,
		'post_status'  => 'publish',
		'post_type'    => 'page',
	) );
}

$home = '
<!-- wp:cover {"minHeight":420,"overlayColor":"vivid-red"} --><div class="wp-block-cover" style="min-height:420px"><span aria-hidden="true" class="wp-block-cover__background has-vivid-red-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container">
<!-- wp:heading {"textAlign":"center","level":1} --><h1 class="wp-block-heading has-text-align-center">Know who\'s cooking your food.</h1><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">Discover home cooks and local kitchens near you. See the menu. See the price. Order.</p><!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/browse-cooks/">Browse Cooks</a></div><!-- /wp:button --><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/shop/">Browse Dishes</a></div><!-- /wp:button --></div><!-- /wp:buttons -->
</div></div><!-- /wp:cover -->
<!-- wp:heading --><h2 class="wp-block-heading">Pick a cuisine</h2><!-- /wp:heading -->
<!-- wp:shortcode -->[product_categories number="8" columns="4" parent="0"]<!-- /wp:shortcode -->
<!-- wp:heading --><h2 class="wp-block-heading">Meet our cooks</h2><!-- /wp:heading -->
<!-- wp:shortcode -->[dokan-stores per_page="4" per_row="4"]<!-- /wp:shortcode -->
<!-- wp:heading --><h2 class="wp-block-heading">Popular dishes</h2><!-- /wp:heading -->
<!-- wp:shortcode -->[products limit="8" columns="4" visibility="featured"]<!-- /wp:shortcode -->
<!-- wp:heading --><h2 class="wp-block-heading">How it works</h2><!-- /wp:heading -->
<!-- wp:list {"ordered":true} --><ol><li><strong>Pick a cook.</strong> Meet the people behind the food, with their story, kitchen and menu.</li><li><strong>Choose your meal.</strong> Clear prices, real photos, no surprises.</li><li><strong>Enjoy.</strong> Pick up or get it delivered.</li></ol><!-- /wp:list -->
<!-- wp:group {"backgroundColor":"luminous-vivid-amber"} --><div class="wp-block-group has-luminous-vivid-amber-background-color has-background"><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">Love to cook? Open your kitchen online.</h3><!-- /wp:heading --><!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/become-a-cook/">Start selling your food</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:group -->';

$about = '
<!-- wp:heading --><h2 class="wp-block-heading">Our story</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Big delivery apps list thousands of restaurants, but you never find out who is actually behind the food. Mapishi Market started with a simple idea: put the cook first. Every kitchen on our platform has a face, a story, a menu and honest prices.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Our mission</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>To give small cooks and local kitchens a shop window, and to help people eat food made by people they can know.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">What we believe</h2><!-- /wp:heading -->
<!-- wp:list --><ul><li><strong>Local.</strong> We back neighbourhood kitchens.</li><li><strong>Transparent.</strong> The cook, the menu and the price are always visible.</li><li><strong>Fresh.</strong> Real food, made with care.</li></ul><!-- /wp:list -->
<!-- wp:heading --><h2 class="wp-block-heading">For cooks</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Cooks keep control of their menu and prices. We take a small commission on each order.</p><!-- /wp:paragraph -->';

$contact = '
<!-- wp:heading --><h2 class="wp-block-heading">Talk to us</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Questions about an order, want to become a cook, or have a partnership idea? Send us a message and we will reply within one working day.</p><!-- /wp:paragraph -->
[CONTACT_FORM]
<!-- wp:paragraph --><p><strong>Area:</strong> Nairobi<br><strong>Hours:</strong> Mon-Sat, 8am-8pm</p><!-- /wp:paragraph -->';

$gallery = '<!-- wp:paragraph --><p>A taste of what our cooks make. Photos coming soon.</p><!-- /wp:paragraph -->';

$cook_page = '
<!-- wp:heading --><h2 class="wp-block-heading">Open your kitchen online</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Create your cook profile, add your dishes and set your own prices. Customers will see who you are and what you cook. Approval usually takes one day.</p><!-- /wp:paragraph -->
<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/my-account/">Register as a cook</a></div><!-- /wp:button --></div><!-- /wp:buttons -->
<!-- wp:paragraph --><p>On the registration form, choose <strong>I am a vendor</strong>.</p><!-- /wp:paragraph -->';

$privacy = '<!-- wp:paragraph --><p>We store only the details needed to process orders and never sell personal data. Cooks are independent and responsible for the safety and hygiene of the food they prepare. Prices are set by cooks and delivery fees are shown at checkout. Orders can be cancelled before the cook starts preparing them.</p><!-- /wp:paragraph -->';

$p_home    = mk_page( 'Home', $home, 'home' );
$p_cooks   = mk_page( 'Browse Cooks', '<!-- wp:shortcode -->[dokan-stores per_page="12"]<!-- /wp:shortcode -->', 'browse-cooks' );
$p_about   = mk_page( 'About', $about, 'about' );
$p_contact = mk_page( 'Contact', $contact, 'contact' );
$p_gallery = mk_page( 'Gallery', $gallery, 'gallery' );
$p_become  = mk_page( 'Become a Cook', $cook_page, 'become-a-cook' );
$p_terms   = mk_page( 'Privacy and Terms', $privacy, 'privacy-and-terms' );
$p_blog    = mk_page( 'Blog', '', 'blog' );

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $p_home );
update_option( 'page_for_posts', $p_blog );

// ---- Blog seed posts ------------------------------------------------------
$posts = array(
	'Cook of the Week: Mama Amina' => 'Mama Amina of Mombasa Kitchen learned to cook pilau standing next to her grandmother. Today her spiced rice, biryani and coconut fish curry are the most ordered dishes on Mapishi Market.',
	'5 dishes you must try this month' => 'One dish from each cuisine: Pilau Beef, Nyama Choma, Butter Chicken, Margherita Pizza and the Quinoa Power Bowl. Browse the menus and order from the cook directly.',
	'How to make kachumbari like a pro' => 'Slice tomatoes and red onion thinly, add chopped coriander and chilli, squeeze in lime, add salt, and rest it for ten minutes. Serve cold with anything grilled.',
);
foreach ( $posts as $t => $body ) {
	if ( ! get_page_by_title( $t, OBJECT, 'post' ) ) {
		wp_insert_post( array( 'post_title' => $t, 'post_content' => '<!-- wp:paragraph --><p>' . $body . '</p><!-- /wp:paragraph -->', 'post_status' => 'publish' ) );
	}
}

// ---- Menus ---------------------------------------------------------------
$shop_id = wc_get_page_id( 'shop' );
$cart_id = wc_get_page_id( 'cart' );
$acct_id = wc_get_page_id( 'myaccount' );
wp_update_post( array( 'ID' => $shop_id, 'post_title' => 'Browse Dishes' ) );

function mk_menu( $name, $location, $page_ids ) {
	$menu = wp_get_nav_menu_object( $name );
	if ( $menu ) {
		wp_delete_nav_menu( $menu->term_id );
	}
	$menu_id = wp_create_nav_menu( $name );
	foreach ( $page_ids as $pid ) {
		wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-object-id' => $pid,
			'menu-item-object'    => 'page',
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
		) );
	}
	$locs = get_theme_mod( 'nav_menu_locations', array() );
	$locs[ $location ] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locs );
}
mk_menu( 'Primary', 'primary', array( $p_home, $p_cooks, $shop_id, $p_blog, $p_about, $p_contact, $cart_id, $acct_id ) );
mk_menu( 'Footer', 'footer_menu', array( $p_terms, $p_become, $p_contact ) );

flush_rewrite_rules();

// ---- Contact form (WPForms Lite) -----------------------------------------
if ( post_type_exists( 'wpforms' ) && ! get_posts( array( 'post_type' => 'wpforms', 'title' => 'Contact Form', 'numberposts' => 1 ) ) ) {
	$fields = array(
		1 => array( 'id' => 1, 'type' => 'name', 'label' => 'Name', 'format' => 'simple', 'required' => '1', 'size' => 'large' ),
		2 => array( 'id' => 2, 'type' => 'email', 'label' => 'Email', 'required' => '1', 'size' => 'large' ),
		3 => array( 'id' => 3, 'type' => 'phone', 'label' => 'Phone', 'format' => 'international', 'required' => '0', 'size' => 'large' ),
		4 => array( 'id' => 4, 'type' => 'select', 'label' => 'Subject', 'required' => '1', 'size' => 'large', 'choices' => array( 1 => array( 'label' => 'Order help', 'value' => '' ), 2 => array( 'label' => 'Become a cook', 'value' => '' ), 3 => array( 'label' => 'Partnership', 'value' => '' ), 4 => array( 'label' => 'Other', 'value' => '' ) ) ),
		5 => array( 'id' => 5, 'type' => 'textarea', 'label' => 'Message', 'required' => '1', 'size' => 'medium', 'limit_enabled' => '0' ),
	);
	$data = array( 'fields' => $fields, 'field_id' => 6, 'settings' => array(
		'form_title' => 'Contact Form', 'submit_text' => 'Send message', 'submit_text_processing' => 'Sending...',
		'antispam_v3' => '1', 'honeypot' => '1',
		'confirmation_type' => 'message', 'confirmation_message' => 'Thank you! Your message has been sent. We will reply soon.',
		'notification_enable' => '1',
		'notifications' => array( 1 => array( 'email' => '{admin_email}', 'subject' => 'New contact message', 'sender_name' => 'Mapishi Market', 'sender_address' => '{admin_email}', 'replyto' => '{field_id="2"}', 'message' => '{all_fields}' ) ),
	) );
	$fid = wp_insert_post( array( 'post_title' => 'Contact Form', 'post_status' => 'publish', 'post_type' => 'wpforms', 'post_content' => '{}' ) );
	$data['id'] = $fid;
	wp_update_post( array( 'ID' => $fid, 'post_content' => wp_slash( wp_json_encode( $data ) ) ) );
	$cp = get_page_by_path( 'contact' );
	if ( $cp ) {
		wp_update_post( array( 'ID' => $cp->ID, 'post_content' => str_replace( '[CONTACT_FORM]', '<!-- wp:shortcode -->[wpforms id="' . $fid . '"]<!-- /wp:shortcode -->', $cp->post_content ) ) );
	}
}

// ---- Dokan store URL: /cook/<kitchen>/ -----------------------------------
$dg = get_option( 'dokan_general', array() );
$dg['custom_store_url'] = 'cook';
update_option( 'dokan_general', $dg );
foreach ( array( 'cook_amina' => 'mombasa-kitchen', 'cook_otieno' => 'choma-corner', 'cook_priya' => 'spice-route', 'cook_luca' => 'nonnas-oven', 'cook_wanjiru' => 'fresh-bowl' ) as $login => $nice ) {
	$cu = get_user_by( 'login', $login );
	if ( $cu ) {
		wp_update_user( array( 'ID' => $cu->ID, 'user_nicename' => $nice ) );
	}
}
update_option( 'permalink_structure', '/%postname%/' );
flush_rewrite_rules();
