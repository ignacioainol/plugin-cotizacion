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

//Creando tablas en la base de datos
require 'install/Jal_install.php';
$jai_install = new Jal_install;


function cs_additional_button() {
     echo '<button type="submit" style="background:orangered;" class="button alt">Añadir a cotizacion</button>';
}

function muestra_porcentaje_descuento(){
    $postId = get_the_ID();
    echo '<button data-idPost="'.$postId.'" type="submit" style="background:orangered;" class="button alt addCotizacion">Añadir a cotizacion</button>';
}

add_action('woocommerce_after_add_to_cart_button', 'cs_additional_button');
//this
add_action('woocommerce_after_shop_loop_item', 'muestra_porcentaje_descuento');
add_action( 'wp_footer', 'my_action_javascript' ); // Write our JS below here

function my_action_javascript() { ?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {
        $('.addCotizacion').on('click',function(){
            $.ajax({
                url: 'http://'+window.location.hostname+'/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {
                    test: 'algo'
                },
                success: function(response){
                    alert(response);
                }
                .error: function(msg){
                    console.log(msg);
                }
            });
        })
	});
	</script> <?php
}
?>