<?php
/*
  template name: last post data
 */
 ?>         <div class="row"><!--.row 2-->

          <?php   
                   $args_cat= array(
                      'include'=>'3,22,26',
                    );
    
                    $categories=get_categories($args_cat);
    
                    foreach($categories as $category):
                      $args = array(
                        'type'                =>'post',
                        'posts_per_page'      =>1,
                        'category__in'        =>$category->term_id,
                        'category__not_in'    =>array(1),
                      );
    
                      $last_blog = new wp_query($args);

                    if($last_blog->have_posts()): while($last_blog->have_posts()): $last_blog->the_post();
                       if(has_post_thumbnail()){
                          the_post_thumbnail(array(150,150)); 
                       }
                       the_title();
                       the_category();

                     endwhile;
                    endif;

                    endforeach;
                
           ?>
    
              </div><!--.row 2-->