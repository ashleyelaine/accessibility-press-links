<?php
namespace accessibility_press_links;

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

if(isset($_GET["status"])&&$_GET["status"]){
	$status = htmlspecialchars($_GET["status"]);
}
add_option( 'externalLinkFixStatus', 'off', '', 'yes' );
update_option( 'externalLinkFixStatus', $status);

echo $status;

?>
