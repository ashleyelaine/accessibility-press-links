<?php
namespace accessibility_press_links;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
include_once("controllerAPLink.php");
/**
 * Class AdminController This is the workhorse controller for the Plugin. Most of the business gets dispatched from here.
 * AccessibilityPress : LINKS
 */
class AdminController extends Controller {
	function addMenuItem() {
		$page_title   = 'AccessibilityPress';
        $menu_title   = 'AccessibilityPress';
        $capabilities = 'manage_options';
        $menu_slug    = 'accessibility-press-info';
        $function     = array( &$this, 'accessibilityPressInfo' );
        $icon_url     = plugins_url().'/accessibility-press-links/images/APmenuIcon.png';
        if ( empty ( $GLOBALS['admin_page_hooks']['accessibility-press-info'] ) ) {
            add_menu_page($page_title, $menu_title, $capabilities, $menu_slug, $function, $icon_url );
    		add_submenu_page('accessibility-press-info', 'General', 'General', $capabilities, 'accessibility-press-info', $function );
        }

		$page_title   = 'External Links';
        $menu_title   = 'External Links';
        $capabilities = 'manage_options';
        $menu_slug    = 'accessibility-press-external-links';
        $function     = array( &$this, 'accessibilityPressExternalLinks' );

        add_submenu_page( 'accessibility-press-info', $page_title, $menu_title, $capabilities, $menu_slug, $function );

	}

	function accessibilityPressInfo() {
		echo fjorge_view_object('admin/accessibilityPressInfo.php');
	}

	function accessibilityPressExternalLinks() {
		echo fjorge_view_object('admin/accessibilityPressExternalLinks.php');
	}
}
