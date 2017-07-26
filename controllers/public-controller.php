<?php
namespace accessibility_press_links;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Class PublicController Dispatches actions and filters for the non-admin side of wordpress
 */
class PublicController {
}
add_action( 'wp_head', 'accessibility_press_links\accessible_press_assets' );
function accessible_press_assets() {
    if (get_option('externalLinkFixStatus') === 'on') {
        wp_enqueue_style( 'altLinkCSS', plugins_url().'/accessibility-press-links/css/externalLinks.css' );
        wp_enqueue_script('fontAwesome', 'https://use.fontawesome.com/00d8085e0c.js');
        wp_enqueue_script('altLinkJS', plugins_url().'/accessibility-press-links/js/externalLinks.js');
    }
}
