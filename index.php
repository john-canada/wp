<?php
/*

 */

get_header();
 global $wp_query;
?>
  <div class="primary" class="content-area">
     <main id="main" class="site-main" role="main">
       <div class="container">
           <div class="row">
            <div class="col-xs-12 col-sm-10"> 
            <div class="post_container_with_ajax">
            <?php if(have_posts()): ?>
            <?php  echo '<div class="page-limit" data-page="/">'; ?>
                <?php while(have_posts()): the_post();?>
                <?php // $class='reveal'; set_query_var('post-class', $class );?>
                <?php get_template_part('templates/content-product');?>
                <?php endwhile;?>
            <?php echo '</div>';?>
                <?php else: echo 0; ?>
            <?php endif;?> 

            </div>
        
            <div class="text-container">
                <span class="loading-icon" style="display:none"><img src="http://localhost/alpha/wp-content/uploads/2018/12/loading.gif"></span>
                <a class="btn-loading load_more_post_width_ajax" data-page="1" data-url="<?php echo admin_url('admin-ajax.php');?>">
                 <span class="text">Load more </span>
                </a>
            </div>
            </div><!-- .col-xs-12 -->

              <div class="col-xs-12 col-sm-2 ">
                <?php //get_sidebar();?>
             </div><!-- .col-xs-12 -->
           
         </div><!--.row-->
          
       </div> <!--.container -->
     </main> 
   </div> <!--#primary .content-area -->
 index
<?php get_footer();?>