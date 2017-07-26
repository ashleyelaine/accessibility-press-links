<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @param string $filename The filename of the php view to be output. Must be in views folder.
 */
function fjorge_view($filename) {
	include(dirname(dirname(__FILE__)) . '/views/' . $filename);
}

/**
 * @param string $filename
 *
 * @return string the rendered PHP
 */
function fjorge_view_object($filename) {
	ob_start();
	fjorge_view($filename);
	return ob_get_clean();
}
