<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// Delete any options
//ex) delete_option( 'option' );

// Drop the database
global $wpdb;
// $wpdb->query( "DROP TABLE IF EXISTS DBNAME" );
