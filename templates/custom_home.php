<?php if(!defined('ABSPATH')) exit; // prevent direct access

/**
 * Template name: Custom Home page template
 */

get_header();
?>


<div class="container">
<section>
    <?php
     global $wp_query;

     $ourCurrentPage = get_query_var('paged');
         $arg = array(
             'post_type'      =>'post',
             'category_name'  =>'model',
             'posts_per_page' =>2,
             'paged'          =>$ourCurrentPage
         );

         $query = new WP_QUERY($arg); 
         ?>  
      
       <?php if($query->have_posts()): ?>
        <ul class="ul-data">        
          <?php while($query->have_posts()): $query->the_post();?>      
            <li>
                 <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(150,150)); ?></a>
                  <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                  <small>Posted on : <?php the_time('F j, Y');?> at <?php the_time('g:i a');?><?php// the_category();?>  </small>
                  <p><?php the_excerpt();  ?></p>  
                  <a href="<?php the_permalink(); ?>">Read More</a>
            </li>
         
         <?php endwhile;wp_reset_query(); 
          
         ?>
    </ul>  
    <?php echo paginate_links(array('total' =>$query->max_num_pages));endif;?>  
 
 </section>
</div>
custome home page
<?php
get_footer();