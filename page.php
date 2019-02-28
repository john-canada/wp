<?php
/*
** page.php
** mk_build_main_wrapper : builds the main divisions that contains the content. Located in framework/helpers/global.php
** mk_get_view gets the parts of the pages, modules and components. Function located in framework/helpers/global.php
*/

get_header();


Mk_Static_Files::addAssets('mk_button'); 
Mk_Static_Files::addAssets('mk_audio');
Mk_Static_Files::addAssets('mk_swipe_slideshow');

mk_build_main_wrapper( mk_get_view('singular', 'wp-page', true) );
?>

<?php
    //     if(is_front_page()) {
    //         $ourCurrentPage = (get_query_var('page')) ? get_query_var('page') : 1;
    //     }else {
    //         $ourCurrentPage = (get_query_var('paged')) ? get_query_var('paged') : 1;
    //    }
?>

<?php if (is_page('Loan System')):?>

<div class="container">
<section>
    <?php
    // global $wp_query;

   $ourCurrentPage = get_query_var('paged');
         $arg = array(
             'post_type'      =>'post',
             'category_name'  =>'model',
             'posts_per_page' =>3,
             'paged'          =>$ourCurrentPage
         );

         $query = new wp_query($arg); 
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
        <?php //echo get_the_password_form();?>
        <aside><?php //generated_dynamic_sidebar($sidebar_name); ?></aside>

 </section>
page.php
</div>

 <?php endif;?>
<?php
get_footer();


