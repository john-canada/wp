<?php
/*
** archive.php
** mk_build_main_wrapper : builds the main divisions that contains the content. Located in framework/helpers/global.php
** mk_get_view gets the parts of the pages, modules and components. Function located in framework/helpers/global.php
*/
get_header();?>

<div class="container"> 
 
 <?php if(have_posts()): ?>
   
   <?php
     the_archive_title('<h2 class="page-title">','</h2>');
       the_archive_description('<h2 class="taxonomy-description">','</h2>');
       while(have_posts()): the_post();   
       get_template_part('templates/content-product',get_post_format());                   
       endwhile;
     the_posts_navigation();
  endif;
 
  ?>

</div>
archive
<?php
get_footer();

