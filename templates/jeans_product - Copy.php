<?php if(!defined('ABSPATH')) exit; // prevent direct access

/*
** template name: Jeans Product
*/

get_header('blog');
?>

<div class="container">
    <?php
     global $product;
   //$card_model= rwmb_meta( 'model' );
   /** pagination **/
   $ourCurrentPage = get_query_var('paged')? get_query_var('paged'):1;

   $args = array(
    'post_type'     => 'product',
    'post_status'   => 'publish',
    'posts_per_page'=> 3,
    'paged'         => $ourCurrentPage,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => array( 'jeans'), 
        ),
    )
);

         $query = new wp_query($args); 
     // var_dump($query);
         ?>  
      
       <?php if($query->have_posts()): ?>
       <ul class="ul-data">  
       
          <?php while($query->have_posts()): $query->the_post();
            $card_model = rwmb_meta( 'model' );
            $product = wc_get_product();
            $price=$product->get_price();
            ?> 
          <li>  
            <a href="<?php the_permalink();?>"><?php the_post_thumbnail(array(250,250));?></a>
            <div class="ul-li-data"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
            <div class="ul-li-model"><?php // echo $card_model;?></div>
            <div class="ul-li-price">Price : $<?php echo $price;?></div>
            
           
           <?php if ( $product->is_in_stock() ) : ?>

	        <?php //do_action( 'woocommerce_before_add_to_cart_form' ); ?>

                <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
                    <?php //do_action( 'woocommerce_before_add_to_cart_button' ); ?>

                    <?php
                    // do_action( 'woocommerce_before_add_to_cart_quantity' );

                    // woocommerce_quantity_input( array(
                    //     'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                    //     'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                    //     'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                    // ) );

                    // do_action( 'woocommerce_after_add_to_cart_quantity' );
                    ?>

                    <button type="submit" class="form-control btn btn-primary mt-2" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

                    <?php //do_action( 'woocommerce_after_add_to_cart_button' ); ?>
                </form>
            <?php endif;?> 
           </li>
          <?php endwhile;
          wp_reset_query();
          ?>
       </ul>
       <div class="pag">
        <div class="pagination">
            <?php  echo paginate_links(array('total' =>$query->max_num_pages));?>
        </div>
       </div>
    <?php  endif;?>  
  </div>
<?php
  /**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );?>

<?php get_footer();?>


