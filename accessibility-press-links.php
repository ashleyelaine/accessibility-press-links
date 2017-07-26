<?php namespace accessibility_press_links;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * @since             0.1
 * @package           accessibility-press-links
 * @author            fjorge developers <developers@fjorgedigital.com>
 *
 * Plugin Name:       AccessibilityPress: Links
 * Description:       Plugin to diagnose and fix external link accessibility issues.
 * Version:           1.0
 * Author:            fjorge
 * Author URI:		  http://fjorgedigital.com/
 */

// If wordpress isn't the one calling this
if ( ! defined( 'WPINC' ) ) {
	die(); // end.
}

define( 'AP_LINKS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Helpers
require_once( 'helpers/activator.php' );
require_once( 'helpers/deactivator.php' );
require_once( 'helpers/view-helper.php' );
// End Helpers

// Models
//End Models

// Controllers
require_once( 'controllers/admin-controller.php' );
require_once( 'controllers/public-controller.php' );
require_once( 'controllers/default-controller.php' );
// End Controllers

// Activation and deactivation hooks need to be in this file.
// (De)Activation Hooks
register_activation_hook( __FILE__, array( 'accessibility_press_links\Activator', 'ACTIVATE' ) );
register_deactivation_hook( __FILE__, array( 'accessibility_press_links\Deactivator', 'DEACTIVATE' ) );
// End Hooks
