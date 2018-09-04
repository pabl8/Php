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


/**
 * Hide email and phone form wcMP shop
 */
add_filter('wcmp_vendor_store_header_hide_store_phone', '__return_true');
add_filter('wcmp_vendor_store_header_hide_store_email', '__return_true');

/**
 * show sell by
 */

add_filter( 'wcmp_sold_by_text_after_products_shop_page', 'filter_wcmp_sold_by_text' );
function filter_wcmp_sold_by_text() 
{
     if( is_tax( 'dc_vendor_shop' ) )
{
        return false;
}

if (is_product ())

{
 return true;   
}
}

/**
 * hide Questions & Answers
 */

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 99 );
function woo_remove_product_tabs( $tabs ) {
   unset( $tabs['wcmp_customer_qna'] );      	// Questions & Answers
   unset( $tabs['additional_information'] );  	// Remove the additional information tab
   return $tabs;
}
/**
 * hide escaparate wcmp
 */
add_filter('wcmp_vendor_dashboard_nav', 'callback_wcmp_vendor_dashboard_nav', 99);
function callback_wcmp_vendor_dashboard_nav($vendor_nav){
    
   unset($vendor_nav['store-settings']['submenu']['storefront']);
 
   return $vendor_nav;
}
/**
 * hide progress bar wcmp
 */
add_filter( 'wcmp_vendor_dashboard_show_progress_bar', 'filter_wcmp_vendor_dashboard_show_progress_bar', 10, 1 );
function filter_wcmp_vendor_dashboard_show_progress_bar( $vendor) {
unset( $vendor); 
}