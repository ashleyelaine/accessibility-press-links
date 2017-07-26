<?php
namespace accessibility_press_links;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//include_once("controller.php");
/**
 * Class AdminController This is the workhorse controller for the Plugin. Most of the business gets dispatched from here.
 */
class Controller {

  public function getPluginDisplayName() {
    return 'AccessibilityPress: Links';
  }

  protected function getMainPluginFileName() {
    return dirname(dirname(__FILE__)).'/plugin.php';
  }

}
