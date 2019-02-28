<?php

add_action('wp_ajax_load_more_post_by_ajax','load_more_post_by_ajax');
add_action('wp_ajax_nopriv_load_more_post_by_ajax','load_more_post_by_ajax');


function load_more_post_by_ajax(){
    check_ajax_referer('load_more_posts','security');
    $paged=$_POST['page'];

    $args=array(
        'post_type'     => 'product',
        'post_status'   => 'publish',
        'posts_per_page'=>2,
        'paged'=>$paged,

        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => array('jeans'), 
            ),
        )
    );

    $query = new wp_query($args); 
    ?>  
 
  <?php if($query->have_posts()): ?>
      
           <?php while($query->have_posts()): $query->the_post();?>
                  <li>
                    <div class="the_thumbnail_ajax"><?php  the_post_thumbnail(array(300,300));?></div>
                    <div class="the_title_ajax"><?php  the_title();?></div>
                  </li>
           <?php endwhile;?>
     
    <?php  else: echo 0;?> 
    <?php  endif;?> 

<?php die(); } ?>