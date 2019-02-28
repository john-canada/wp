<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Created by John Canada.
 * User: golden tribe
 * Date: 12/01/2018
 * Time: 06:00 PM
 */
class alpha_Product_Meta_box {


	public function __construct( ) {
        add_filter( 'rwmb_meta_boxes', array( $this, 'alpha_product_meta_box_generator'));
        add_filter( 'woocommerce_product_tabs', array($this, 'woo_remove_product_tabs' ));
        add_filter( 'woocommerce_product_tabs', array($this, 'woo_reorder_tabs' ));
        remove_action( 'woocommerce_after_single_product_summary','woocommerce_output_related_products', 20 );
       // add_action( 'woocommerce_product_meta_end', 'alpha_product_meta_box_data');
	}

    public function alpha_product_meta_box_generator($meta_boxes){

         //set meta box fields default
         $meta_boxes_fields_default = array(
            array(
                'id'   => 'activate',
                'name' => esc_html__( 'Enable Card Details', 'alpha' ),
                'type' => 'checkbox',
                'desc' => esc_html__( '', 'alpha' ),
                'std'  => true
            ),   
      
            array(
                'id'          => 'product_type',
                'type'        => 'text',
                'name'        => esc_html__( 'Product Type', 'alpha' ),
                'placeholder' => esc_html__( 'product type', 'alpha' ),
            ),

            array(
                'id'          => 'model',
                'type'        => 'text',
                'name'        => esc_html__( 'Model', 'alpha' ),
                'placeholder' => esc_html__( 'model number', 'alpha' ),
                
            ),

     );// end of default value

        $meta_boxes[] = array(
            'id'         => 'product_card',
            'title'      => esc_html__( 'Product Details', 'alpha' ),
            'post_types' => array( 'product' ),
            'context'    => 'normal',
            'priority'   => 'high',
            'autosave'   => true,
            'fields'     => $meta_boxes_fields_default
        );

        return $meta_boxes;

      }


      function alpha_product_meta_box_data()
      {
                  $meta = rwmb_meta( 'model' );
                  
                  echo '<strong>' . __( 'Model:', 'Alpha' ) . "</strong> $meta<br>";
                  
                  
      }
    
      
   

      function woo_remove_product_tabs($tabs) {
      
          unset( $tabs['Description'] );      // Remove the description tab
          unset( $tabs['Reviews'] ); 			// Remove the reviews tab
      // unset( $tabs['additional_information'] );  	// Remove the additional information tab
      
          return $tabs;
      }
      
    
      function woo_reorder_tabs($tabs) {
          $tabs['Description']['priority'] = 5;		// Description first
          $tabs['Reviews']['priority'] = 40;			// Reviews second
      //	$tabs['additional_information']['priority'] = 15;	// Additional information third
      
         return $tabs;
      }

   
    } // end of class

    
    

new alpha_Product_Meta_box();