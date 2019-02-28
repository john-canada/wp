<?php if ( !defined( 'ABSPATH' ) ) exit; //prevent direct access

/*
 ============================
    theme support
 ============================

*/

add_theme_support('video');
add_post_type_support('posts', 'excerpt','video');
require_once( dirname( __FILE__ ) . '/product_card_meta/class-product-card-helper.php' );
require_once( dirname( __FILE__ ) . '/product_card_meta/class-single-product-register-sidebar.php' );
require_once( dirname( __FILE__ ) . '/product_card_meta/class-single-product-footer-template.php' );
require_once( dirname( __FILE__ ) . '/product_card_meta/class-add-meta-box-product-page.php' );
require_once( dirname( __FILE__ ) . '/product_card_meta/ajax.php' );
require_once( dirname( __FILE__ ) . '/product_card_meta/walker.php' );
//require_once( dirname( __FILE__ ) . '/product_card_meta/custom-wc-template-functions.php' );

require_once( dirname( __FILE__ ) . '/product_card_meta/scroll_ajax.php' );
//require_once( dirname( __FILE__ ) . '/product_card_meta/theme-support.php' );

add_action('wp_enqueue_scripts','load_more_post');

function load_more_post(){
     wp_enqueue_script('load_more_post', get_template_directory_uri() . '/js/load_more_post.js',NULL, 2.0 , true);
     wp_localize_script('load_more_post','magicalData', array(
    'siteURL'=>get_site_URL(),
    'nonce'=>wp_create_nonce('wp_rest')
      ));
 }

/*
 ============================
    enqueue script
 ============================

*/

add_action('wp_enqueue_scripts','load_more_post_ajax');
function load_more_post_ajax(){
    wp_enqueue_script('load_more_ajax_post', get_template_directory_uri() . '/js/ajax.js',array('jquery'), 1.0 , true);
    wp_register_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js',array('jquery'),'4.1',true);
    wp_enqueue_script('bootstrap-js'); 
  //  wp_deregister_script('bootstrap-js');
    wp_register_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css',array(),'4.1');
    wp_enqueue_style('bootstrap-css'); 
}


add_action('wp_enqueue_scripts','load_restapi');
function load_restapi(){
    wp_enqueue_script('load_restapi', get_template_directory_uri() . '/js/rest_api.js',array(), 1.0 , true);  
   // wp_enqueue_script('load_restapi'); 
  
}


// function custom_posts_per_page( $query ) {

//     if ( $query->is_archive('cpt_name') || $query->is_category() ) {
//         set_query_var('posts_per_page', 1);
//     }
// }
// add_action( 'pre_get_posts', 'custom_posts_per_page' );

/** header function **/



function remove_wordpress_version(){
   return '';
 }
 add_filter('the_generator','remove_wordpress_version');
   ?>

<?php 

remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
add_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);

remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
add_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',35);


add_action('woocommerce_single_product_summary','add_product_price',25);

function add_product_price(){
   $product=wc_get_product();
   echo '<h3>' . get_woocommerce_currency_symbol(); ?><b><?php  echo  $product->get_price() . '</h3>'; 
}

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 8 );


/*
 ==========================================
  add delivery date field in checkout
 ==========================================

*/

add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );



function my_custom_checkout_field( $checkout ) {



    echo '<div id="my_custom_checkout_field"><h4>' . __('Delivery Date') . '</h4>';



    woocommerce_form_field( 'my_field_name', array(

        'type'          => 'date',

        'class'         => array('my-field-class form-row-wide'),

        'label'         => __(''),

        'placeholder'   => __('Enter something'),

        ), $checkout->get_value( 'my_field_name' ));


    echo '</div>';



}

add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');



function my_custom_checkout_field_process() {

    // Check if set, if its not set add an error.

    if ( ! $_POST['my_field_name'] )

        wc_add_notice( __( 'Please enter something into this new shiny field.' ), 'error' );

}

/**

 * Update the order meta with field value

 */

add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );



function my_custom_checkout_field_update_order_meta( $order_id ) {

    if ( ! empty( $_POST['my_field_name'] ) ) {

        update_post_meta( $order_id, 'Delivery date', sanitize_text_field( $_POST['my_field_name'] ) );

    }

}

// =============================
//      Logout redirect
// =============================

function custom_redirect_to_login_page(){
   wp_redirect(site_url() . "/custom_login");
   exit();
}
add_action('wp_logout','custom_redirect_to_login_page');

// function admin_redirect_to_login_page(){
//     global $pagenow;
//     if($pagenow == 'wp-login.php' && $_GET['action']!='logout'){
//         wp_redirect(home_url() . "/custom_login");
//         exit();
//     }
//  }
//  add_action('init','admin_redirect_to_login_page');

// add_filter( 'wp_nav_menu_secondary_items','wpsites_loginout_menu_link' );

// function wpsites_loginout_menu_link( $menu ) {
//     $loginout = wp_loginout($_SERVER['REQUEST_URI'], false );
//     $menu .= $loginout;
//     return $menu;

// }



function remove_menus(){
	remove_menu_page( 'tools.php' ); //Tools
	}
    add_action( 'admin_menu', 'remove_menus' );
    
    add_action('rest_api_init', 'register_rest_images' );
function register_rest_images(){
    register_rest_field( array('post'),
        'fimg_url',
        array(
            'get_callback'    => 'get_rest_featured_image',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}
function get_rest_featured_image( $object, $field_name, $request ) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
        return $img[0];
    }
    return false;
}