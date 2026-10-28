<?php
/**
 * Plugin Name: Mapishi Seed
 * Description: Installs the required plugins and creates demo content (cooks, dishes, pages, menus, contact form) for the food marketplace. Tools > Mapishi Seed. Deactivate and delete after use.
 * Version: 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Plugins the marketplace needs: slug => [main file, display name]. */
function mk_required_plugins() {
	return array(
		'woocommerce'    => array( 'woocommerce/woocommerce.php', 'WooCommerce (shop engine)' ),
		'dokan-lite'     => array( 'dokan-lite/dokan.php', 'Dokan Lite (multi-cook marketplace)' ),
		'wpforms-lite'   => array( 'wpforms-lite/wpforms.php', 'WPForms Lite (contact form)' ),
		'wp-mail-smtp'   => array( 'wp-mail-smtp/wp_mail_smtp.php', 'WP Mail SMTP (reliable email)' ),
		'wp-smushit'     => array( 'wp-smushit/wp-smush.php', 'Smush (image compression)' ),
		'wp-super-cache' => array( 'wp-super-cache/wp-cache.php', 'WP Super Cache (speed)' ),
	);
}

/**
 * Install (if missing) and activate one plugin from wordpress.org.
 * Returns true on success or an error message string.
 */
function mk_install_plugin( $slug ) {
	$all = mk_required_plugins();
	if ( ! isset( $all[ $slug ] ) ) {
		return 'Unknown plugin.';
	}
	$file = $all[ $slug ][0];

	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/misc.php';
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	require_once ABSPATH . 'wp-admin/includes/plugin-install.php';

	if ( ! file_exists( WP_PLUGIN_DIR . '/' . $file ) ) {
		$api = plugins_api( 'plugin_information', array( 'slug' => $slug, 'fields' => array( 'sections' => false ) ) );
		if ( is_wp_error( $api ) ) {
			return $api->get_error_message();
		}
		$upgrader = new Plugin_Upgrader( new Automatic_Upgrader_Skin() );
		$result   = $upgrader->install( $api->download_link );
		if ( is_wp_error( $result ) ) {
			return $result->get_error_message();
		}
		if ( ! $result ) {
			return 'Download failed. Try again.';
		}
	}
	if ( ! is_plugin_active( $file ) ) {
		$act = activate_plugin( $file );
		if ( is_wp_error( $act ) ) {
			return $act->get_error_message();
		}
	}
	return true;
}

add_action( 'admin_menu', function () {
	add_management_page( 'Mapishi Seed', 'Mapishi Seed', 'manage_options', 'mk-seed', 'mk_seed_screen' );
} );

function mk_seed_screen() {
	echo '<div class="wrap"><h1>Mapishi Seed</h1>';
	@set_time_limit( 300 );

	// Step 1: install required plugins, one per click (keeps each request short on free hosting).
	if ( isset( $_POST['mk_install'] ) && check_admin_referer( 'mk_seed' ) ) {
		$res = mk_install_plugin( sanitize_key( wp_unslash( $_POST['mk_install'] ) ) );
		if ( true === $res ) {
			echo '<div class="notice notice-success"><p>Installed and activated.</p></div>';
		} else {
			echo '<div class="notice notice-error"><p>' . esc_html( $res ) . '</p></div>';
		}
	}

	$missing = array();
	foreach ( mk_required_plugins() as $slug => $p ) {
		if ( ! is_plugin_active( $p[0] ) ) {
			$missing[ $slug ] = $p[1];
		}
	}

	echo '<h2>Step 1: required plugins</h2>';
	if ( $missing ) {
		echo '<p>Click the button below. Repeat until nothing is left. Each click installs one plugin and can take up to a minute.</p><ul>';
		foreach ( mk_required_plugins() as $slug => $p ) {
			echo '<li>' . ( isset( $missing[ $slug ] ) ? '&#9744; ' : '&#9745; ' ) . esc_html( $p[1] ) . '</li>';
		}
		echo '</ul><form method="post">';
		wp_nonce_field( 'mk_seed' );
		$next = key( $missing );
		echo '<p><button class="button button-primary" name="mk_install" value="' . esc_attr( $next ) . '">Install next: ' . esc_html( $missing[ $next ] ) . '</button></p></form></div>';
		return;
	}
	echo '<p>&#9745; All required plugins are active.</p>';

	// Step 2: demo content.
	echo '<h2>Step 2: demo content</h2>';
	if ( isset( $_POST['mk_run'] ) && check_admin_referer( 'mk_seed' ) ) {
		$repo = plugin_dir_path( __FILE__ );
		try {
			require __DIR__ . '/seed.php';
			echo '<div class="notice notice-success"><p>Done. Pages, cooks, dishes and menus created. You can now deactivate and delete this plugin.</p></div>';
		} catch ( Throwable $e ) {
			echo '<div class="notice notice-error"><p>' . esc_html( $e->getMessage() ) . '</p></div>';
		}
	}
	echo '<p>Creates 5 demo cooks, 16 dishes, pages, menus, a contact form and blog posts. Safe to run again. Do not refresh while it runs.</p>';
	echo '<form method="post">';
	wp_nonce_field( 'mk_seed' );
	echo '<p><button class="button button-primary" name="mk_run" value="1">Run seed</button></p></form></div>';
}
