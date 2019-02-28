<?php if(!defined('ABSPATH')) exit; // prevent direct access

/*
** template name: Blog post
*/

get_header();
?>

   <div class="container post_container_with_ajax">
     <?php if(have_posts()): ?>
     <?php while(have_posts()): the_post();?>
        <a href="<?php the_permalink();?>"><?php the_post_thumbnail(array(250,250));?></a>
        <div class="ul-li-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
        <div class="ul-li-title"><a href="<?php the_permalink();?>"><?php the_content();?></a></div>
    <?php endwhile; endif;?>    
    </div>

  <div class="container text-container">
    <a class="btn btn-default load_more_post_width_ajax" data-page="1" data-url="<?php echo admin_url('admin-ajax.php');?>"><span class="icon-here"></span>Load more posts width Ajax</a>
  </div>


<?php get_footer();?>


