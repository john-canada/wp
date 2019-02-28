<?php
/**
 * Created by John Canada.
 * User: John Canada
 */


add_action('wp_ajax_nopriv_load_more_ajax_post','load_more_ajax_post');
add_action('wp_ajax_load_more_ajax_post','load_more_ajax_post');

function load_more_ajax_post(){
    $paged=$_POST['page']+1;
  
    $args = array(
        'post_type'     => 'post',
        'post_status'   => 'publish',
        'paged'         => $paged  
      );
    
     $query = new wp_query($args); 

      if($query->have_posts()):
      //  $class='reveal'; set_query_var('post-class', $class );
        echo '<div class="page-limit" data-page="page/' . $paged . '">'; //page limit
           while($query->have_posts()): $query->the_post();
             get_template_part('templates/content-product');
           endwhile;
        echo '</div>';
          endif;
     wp_reset_postdata();
     die();
  }