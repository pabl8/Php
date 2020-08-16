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
 * show sell by
 

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
   unset($vendor_nav['businesses']); // for Stats / Reports
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
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 60 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 30;
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


/**
 * hide my shop
 */
add_filter( 'wcmp_vendor_dashboard_header_nav', 'filter_wcmp_vendor_dashboard_header_nav', 10, 1 );
function filter_wcmp_vendor_dashboard_header_nav( $header_nav ) {
	unset($header_nav['shop-link']); //remove Vendor Shop Link
	return $header_nav;
}

/**
 * removing phone checkout woocomerce :)
 */
add_filter( 'woocommerce_billing_fields', 'remove_billing_phone_field', 20, 1 );
function remove_billing_phone_field($fields) {
    $fields ['billing_phone']['required'] = false; // To be sure "NOT required"

    $fields['billing_email']['class'] = array('form-row-wide'); // Make the field wide

    unset( $fields ['billing_phone'] ); // Remove billing phone field
    return $fields;
}


//* Remove Font Awesome from WordPress theme
add_action( 'wp_print_styles', 'tn_dequeue_font_awesome_style' );
function tn_dequeue_font_awesome_style() {
      wp_dequeue_style( 'fontawesome' );
      wp_deregister_style( 'fontawesome' );
}


// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Lo quiero', 'woocommerce' ); 
}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Lo quiero', 'woocommerce' );
}

// Cambia boton al final en lugar de realizar compra1
add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' ); 
function woo_custom_order_button_text() {
    return __( 'Finalizar Pedido', 'woocommerce' ); 
}


// Cambia boton al final en lugar de realizar compra
add_filter( 'woocommerce_order_button_text', 'misha_custom_button_text' );
 function misha_custom_button_text( $button_text ) {
   return 'Finalizar pedido'; // new text is here 
}

// Esconde cosas del panel de Wcmp 

add_filter('wcmp_product_data_tabs', 'callback_wcmp_product_data_tabs', 99);
function callback_wcmp_product_data_tabs($tabs){
    unset($tabs['inventory']);
   unset($tabs['Shipping']);
   unset($tabs['linked_product']); 
   unset($tabs['attribute']);
   unset($tabs['advanced']);
   return $tabs;
}



/**
--------------------- no usados ----------------------
 *diseable google maps v1 no funciono lo guardo por las dudas


function disable_google_map_api($load_google_map_api) {

  $load_google_map_api = false;

  return $load_google_map_api;

}

$plugins = get_option('active_plugins');
$required_plugin = 'auto-location-pro/auto-location.php';

if ( in_array( $required_plugin , $plugins ) ) {
  add_filter('avf_load_google_map_api', 'disable_google_map_api', 10, 1);
}
 
/**
 *diseable google maps v2 no funciono lo guardo por las dudas
 
	 add_filter( 'avf_load_google_map_api', '__return_false' );

/**
 * change title from category blog title
 
// Simply remove anything that looks like an archive title prefix ("Archive:", "Foo:", "Bar:").
add_filter('get_the_archive_title', function ($title) {
    return preg_replace('/^\w+: /', '', $title);
});



 
Remove archives 
function meks_remove_wp_archives(){
  //If we are on category or tag or date or author archive
  if( is_category() || is_tag() || is_date() || is_author() ) {
    global $wp_query;
    $wp_query->set_404(); //set to 404 not found page
  }
}
*/
