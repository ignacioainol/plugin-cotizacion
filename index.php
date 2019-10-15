<?php
/*
Plugin Name: Cotizaciones Crecic
Plugin URI: https://cyrax.cl
Description: Crear cotizacion de productos en Crecic Store
Version: 1.0.0
Author: Ignacio Ainol Rivera
Author URI: 
License: GPLv2 or later
Text Domain: Cotizaciones Crecicyrax
*/

global $jal_db_version;
$jal_db_version = '1.0';

function jal_install() {
	global $wpdb;
	global $jal_db_version;

	$table_cotizaciones          = $wpdb->prefix . 'cotizaciones_crecic';
	$table_detalles_cotizaciones = $wpdb->prefix . 'detalles_cotizaciones_crecic';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "
        CREATE TABLE $table_cotizaciones (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		email VARCHAR(100) NOT NULL,
		PRIMARY KEY  (id)
    ) $charset_collate;";
    
    $sqlDetalle = "
        CREATE TABLE $table_detalles_cotizaciones(
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        product_name VARCHAR(100),
        id_cotizacion int(10) NOT NULL,
        PRIMARY KEY (id)
        ) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta([$sql, $sqlDetalle]);

	add_option( 'jal_db_version', $jal_db_version );
}

/*function jal_install_data() {
	global $wpdb;
	
	$table_cotizaciones = $wpdb->prefix . 'cotizaciones_crecic';
	
	$wpdb->insert( 
		$table_cotizaciones, 
		array( 
			'created_at' => date("Y-m-d H:i:s"), 
			'email' => 'ignacio.ainolrivera@gmail.com', 
		) 
	);
}*/

register_activation_hook( __FILE__, 'jal_install' );
// register_activation_hook( __FILE__, 'jal_install_data' );
