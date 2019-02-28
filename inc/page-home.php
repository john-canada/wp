<?php
/*
  template name:home page
 */

get_header();
 global $product;
?>

  <div class="primary" class="content-area">
     <main id="main" class="site-main" role="main">

     <div class="container-fluid">
    
         <?php echo do_shortcode('[smartslider3 slider=1]')?>
    </div><!-- container-fluid -->

     <!-- social -->
        <section style="font-size: 25px;text-align: center;margin-bottom: 40px;">		
          <a href="https://www.facebook.com/jaz.balase"><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.facebook.com/jaz.balase"><i class="fab fa-twitter" style="padding-left: 15px; padding-right: 15px;"></i></a>
          <a href="https://www.youtube.com/watch?v=3O0cLjTev9c"><i class="fab fa-youtube"></i></a>
	   </section>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
       <div class="container">
           <div class="row">
           
          <!--
           =================================
            Display post
           =================================
         -->  
       
             <div class="col-xs-12 col-sm-3">
               <?php get_sidebar();?>
             </div><!--col-xs-12 col-sm-2-->

             <div class="col-xs-12 col-sm-9">
            
                  <div class="col-xs-12 col-sm-4"> 
                  <ul class="the-post">
                    <?php 
              
                  $include=array(
                      'include'=>'3,22,26'
                  );

                  $categories = get_categories($include);
                    $i=1;
                    foreach($categories as $category){
                        $args = array(
                            'post_type'=>'post',
                            'posts_per_page'=>'1',
                            'category__in'=>$category->term_id,
                           // 'category__not_in'=>array(1),
                          ); 

                        $args = new wp_query($args);
                          
                          if($args->have_posts()): while($args->have_posts()): $args->the_post(); ?>
                          <li>            
                            <?php $feature = wp_get_attachment_url(get_post_thumbnail_id(get_the_id()));?> 
                            <div class="featured" style="background-image:url(<?php echo $feature;?>)"></div>
                            
                      <?php 
                            $posted_on = human_time_diff(get_the_time('U'),current_time('timestamp'));
                              $categories = get_the_category();
                              $output=""; 
                              $comma="";
                              $i=1;
                              foreach($categories as $category){ $i++;
                              if($i>1){$comma=",";}
                              $output.="<a href=" . get_the_permalink() . ">".$category->name .$comma."<a/>" ;
                            }
                        ?>
                            <small>Posted on: <?php echo $posted_on ." ago ";?><?php echo "Category : " . $output;?></small>                      
                            <div class="the-title"><a href="<?php the_permalink();?>"> <?php the_title();?></a></div>
                          </li>   
                      <?php       
                          endwhile;?>
                      
                      <?php endif;
                          $i++;
                      }

                ?>
                </ul>
          </div><!-- .col-xs-12 col-sm-4 -->

       
         <!--
           =================================
           Products by categories
           =================================
         -->  

          <section class="product-categories <?php //the_ID();?>">
            <h2 >Product by categories</h2>
            <ul class="ul-product-cat">
                <?php
                $prod_categories = get_terms( 'product_cat', array(
                    //'type'       =>'product',
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                    'hide_empty' => 1
                ));
              
                  foreach( $prod_categories as $prod_cat ) :
                    $cat_thumb_id = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
                    $cat_thumb_url = wp_get_attachment_thumb_url( $cat_thumb_id );
                    $term_link = get_term_link( $prod_cat, 'product_cat' );
              ?>
               <li>
                  <a href="<?php echo $term_link; ?>"><img width="250" height="250" src="<?php echo $cat_thumb_url; ?>" alt="<?php echo $prod_cat->name; ?>" /></a>
                 <h6> <?php echo $prod_cat->name; ?> <span>( <?php echo $prod_cat->count; ?> )</span></h6>
               
               </li>
                <?php endforeach; wp_reset_query(); ?>

            </ul>
          </section>

         <!--
           =================================
           Featured products
           =================================
         -->  
         <?php //echo do_shortcode('[popup_trigger]'); ?>
         <h2>Featured products </h2>
          <section class="featured-product">
       <!-- <button class="popmake-355"></button>triger popup-->

        <?php
     
            $args = array(
                'post_type' => 'product',
                'posts_per_page' =>4,
                'tax_query' => array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'featured',
                        ),
                    ),
                );
            $loop = new WP_Query( $args );
            if ( $loop->have_posts() ) { ?>
              <ul class="ul-product-cat">
             <?php   $product=wc_get_product();
                while ( $loop->have_posts() ) : $loop->the_post();?>
                <li>
                    <a href="<?php the_permalink() ?>"><?php  the_post_thumbnail(array(250,250));?> </a>
                    <a href="<?php the_permalink() ?>"><?php  the_title();?> </a>
                    <span class="the-price"> <?php echo get_woocommerce_currency_symbol(); ?><b><?php  echo  $product->get_price() ; ?></b></span>
                    <?php woocommerce_template_single_add_to_cart();?> 
                </li>   
            <?php    
           endwhile;?>
           </ul>
         <?php   } else {
                echo __( 'No products found' );
            }
            wp_reset_postdata();
        ?>
         
        </section>

       </div><!--col-xs-12 col-sm-8--->
        
         </div><!--.row-->
          
       </div> <!--.container -->
      </article>
     </main> 
   </div> <!--#primary .content-area -->
   <?php //echo wc_get_product_category_list(the_id());?>

      <section>
        <?php get_template_part('custom-login');?>
      </section>

   <div class="container">
     <div id="dataholder">datahere</div>
   </div>
  
   <div class="container">
   <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FLandAsia.Ph%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
   </div>

<?php get_footer();?>