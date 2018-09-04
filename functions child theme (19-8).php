<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
/** Desactiva llamadas Ajax de WooCommerce en portada y entradas*/
add_action( 'wp_enqueue_scripts', 'dequeue_woocommerce_cart_fragments', 11);
function dequeue_woocommerce_cart_fragments() {
if (is_front_page() || is_single() ) wp_dequeue_script('wc-cart-fragments');
}
/** Saca boton mi tienda de dashboard WCMp*/
add_filter( 'wcmp_vendor_dashboard_header_nav', 'filter_wcmp_vendor_dashboard_header_nav', 10, 1 ); 
function filter_wcmp_vendor_dashboard_header_nav( $header_nav ) {
unset($header_nav['shop-link']); //remove Vendor Shop Link
return $header_nav;
}