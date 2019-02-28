<?php
/*
 template name: books template
 */

get_header('blog');
 global $wp_query;
?>
  <div class="primary" class="content-area">
     <main id="main" class="site-main" role="main">
       <div class="container">
         <article class="books-post-type">
           <?php
               $args=array(
                 'post_type'=>'book',
                 'posts_per_page'=>2
               );
            $output= new wp_query($args);
           ?>
            <?php if($output->have_posts()): ?>
           
                <?php while($output->have_posts()): $output->the_post();?>
                <?php the_post_thumbnail();?>
                   <?php the_title('<h1 class="book-title">','</h1>');?>
                   <?php the_content();?>
                   <iframe width="500" height="400" src="https://www.youtube.com/watch?v=BwIvn8jp_j4" allowfullscreen>
                   </iframe>
                 
                <?php endwhile;?>
                <?php endif;?>        
           </article>
          </div> <!--.container -->
     </main> 
   </div> <!--#primary .content-area -->

<?php get_footer();?>