<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}



/**
 * Hide email and phone form wcMP shop
 */
add_filter('wcmp_vendor_store_header_hide_store_phone', '__return_true');
add_filter('wcmp_vendor_store_header_hide_store_email', '__return_true');

/**
 * show sell by   --- comentada el 21/10 porque se agrego esta linea en la actualizacion del template de wyzi y ya no es necesario agregarlo por codigo
 

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

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 100 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 100;
  return $cols;
}

/**
 * hide fields in checkout woocomerce
 */
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );
 
function custom_override_default_address_fields( $address_fields ) {
    unset( $address_fields['postcode'] );
    unset( $address_fields['company'] );
    unset( $address_fields['address_1'] );
    unset( $address_fields['address_2'] );
    unset( $address_fields['city'] );
    unset( $address_fields['country'] );
    unset( $address_fields['state'] );
 
    return $address_fields;
}

