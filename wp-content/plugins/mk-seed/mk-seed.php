<?php
/**
 * Plugin Name: Mapishi Seed
 * Description: One-click demo content (cooks, dishes, pages, menus, contact form) for the food marketplace. Tools > Mapishi Seed. Deactivate and delete after use.
 * Version: 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_menu', function () {
	add_management_page( 'Mapishi Seed', 'Mapishi Seed', 'manage_options', 'mk-seed', 'mk_seed_screen' );
} );

function mk_seed_screen() {
	echo '<div class="wrap"><h1>Mapishi Seed</h1>';
	$missing = array();
	if ( ! class_exists( 'WooCommerce' ) ) {
		$missing[] = 'WooCommerce';
	}
	if ( ! function_exists( 'dokan' ) ) {
		$missing[] = 'Dokan Lite';
	}
	if ( $missing ) {
		echo '<p><strong>Install and activate first:</strong> ' . esc_html( implode( ', ', $missing ) ) . '. Also WPForms Lite for the contact form.</p></div>';
		return;
	}
	if ( isset( $_POST['mk_run'] ) && check_admin_referer( 'mk_seed' ) ) {
		@set_time_limit( 300 );
		$repo = plugin_dir_path( __FILE__ );
		try {
			require __DIR__ . '/seed.php';
			echo '<div class="notice notice-success"><p>Done. Pages, cooks, dishes and menus created. You can deactivate this plugin now.</p></div>';
		} catch ( Throwable $e ) {
			echo '<div class="notice notice-error"><p>' . esc_html( $e->getMessage() ) . '</p></div>';
		}
	}
	echo '<p>Creates 5 demo cooks, 16 dishes, pages, menus, a contact form and blog posts. Safe to run again.</p>';
	echo '<form method="post">';
	wp_nonce_field( 'mk_seed' );
	echo '<p><button class="button button-primary" name="mk_run" value="1">Run seed</button></p></form></div>';
}
