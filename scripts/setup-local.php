<?php
/**
 * Local seeding via WP-CLI:  wp eval-file scripts/setup-local.php <repo-path>
 * The live site uses the mk-seed plugin instead (same logic in wp-content/plugins/mk-seed/seed.php).
 */
$repo = isset( $args[0] ) ? rtrim( str_replace( '\\', '/', $args[0] ), '/' ) : dirname( __DIR__ );
require $repo . '/wp-content/plugins/mk-seed/seed.php';
WP_CLI::success( 'Local site seeded.' );
