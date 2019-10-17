<?php
session_start();
/*
Plugin Name: Cotizaciones Crecic
Plugin URI: https://cyrax.cl
Description: Crear cotizacion de productos en Crecic Store
Version: 1.0.0
Author: Ignacio Cyrax Ainol Rivera
Author URI: 
License: GPLv2 or later
Text Domain: Cotizaciones Crecic
*/

//Creando tablas en la base de datos
require 'install/Jal_install.php';
$jai_install = new Jal_install;


function cs_additional_button() {
    $postId = get_the_ID();
     echo '<button type="button" style="background:orangered;" data-idPost="'.$postId.'" class="button alt addCotizacion">Añadir a cotizacion</button>';
}

function muestra_porcentaje_descuento(){
    $postId = get_the_ID();
    echo '<button data-idPost="'.$postId.'" type="submit" style="background:orangered;" class="button alt addCotizacion">Añadir a cotizacion</button>';
}

add_action('woocommerce_after_add_to_cart_button', 'cs_additional_button');
//this
add_action('woocommerce_after_shop_loop_item', 'muestra_porcentaje_descuento');
add_action( 'wp_footer', 'my_action_javascript' ); // Write our JS below here

//insertar javascript js
add_action('wp_enqueue_scripts','dcms_insert_js');

function dcms_insert_js(){
    wp_register_script('dcms_miscript', plugins_url(). '/cotizaciones/js/scripts.js', array('jquery'),'1', true);
    wp_enqueue_script('dcms_miscript');

    wp_localize_script('dcms_miscript','dcms_vars',['ajaxurl' => admin_url('admin-ajax.php')]);
}

//definir funcion que retorna algo
add_action('wp_ajax_nopriv_dcms_ajax_cotizacion','dcms_crear_cotizacion');
add_action('wp_ajax_dcms_ajax_cotizacion','dcms_crear_cotizacion');
add_action('init','register_session');

function register_session() {
    if (!session_id())
        session_start();
}

function dcms_crear_cotizacion(){
    if(!in_array($_POST['id_post'], $_SESSION['cart_cotizacion'])){
        $_SESSION['cart_cotizacion'][]= $_POST['id_post'];
    }

    print_r($_SESSION['cart_cotizacion']);
    die();
}
