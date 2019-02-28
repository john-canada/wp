<?php
/*
** content-archive.php
** mk_build_main_wrapper : builds the main divisions that contains the content. Located in framework/helpers/global.php
** mk_get_view gets the parts of the pages, modules and components. Function located in framework/helpers/global.php
*/
?>

<div class="container"> 
 
 <?php   

      // $paged = get_query_var('paged');

      // $arg=array(
      //   'post_type'      =>'products',
      //   'categoty_name'  =>'jacket',
      //   'posts_per_page' =>-1,
      //   'paged'          =>$paged
      // );

      // $query = new wp_query($arg);
 
      if(have_posts()): 
         
          while(have_posts()): the_post();   ?> 
         
                <?php the_post_thumbnail(array(150,150)); ?>
                <h3><?php the_title(); ?></h3>
                <small>Posted on : <?php the_time('F j, Y');?> at <?php the_time('g:i a');?> <?php the_category(' ');?></small>
                <p><?php the_excerpt();  ?></p>  
              
         <?php endwhile; ?>
     
        <?php //echo paginate_link(array('total'=>$query->max_num_pages));
         endif;?>

<h2>This is content-archive.php in jupiter child</h2>
</div>
<?php


