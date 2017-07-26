<?php
namespace accessibility_press_links;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Class Deactivator Provides the method to deactivate the plugin
 */
class Deactivator {

	/**
	 * Clears any wp-cron jobs scheduled, and flushes the cache.
	 */
	public static function DEACTIVATE() {
        remove_action( 'wp_head', 'accessibility_press_links\accessible_press_assets' );
		flush_rewrite_rules();
	}
}
