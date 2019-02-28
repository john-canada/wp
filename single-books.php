<?php
/*
** single.php
** mk_build_main_wrapper : builds the main divisions that contains the content. Located in framework/helpers/global.php
** mk_get_view gets the parts of the pages, modules and components. Function located in framework/helpers/global.php
*/
get_header();?>

<div class="container"> 
 
 <?php   
 
   if(have_posts()): 
         
          while(have_posts()): the_post();   ?> 
         
                
  <article id="post-<?php the_ID(); ?>" <?php post_class(array('card')); ?>>
    
    <header>

    <?php if(has_post_thumbnail()):?>  
          <?php $featured_image= wp_get_attachment_url(get_post_thumbnail_id(get_the_id())); ?>
          <div class="featured-image background-image" style="background-image:url(<?php echo $featured_image ?>)" ></div>
      <?php endif;?>
      
    <div class="the-title single-page" style="margin-top:20px;margin-bottom:-12px"><a href="<?php the_permalink();?>"><h1><?php the_title();?></h1></a></div>
    <div class="meta-tag">
        <?php 
      
              $posted_on = human_time_diff(get_the_time('U'),current_time('timestamp'));
              $categories = get_the_category();
              $separator = ',';
              $output=''; 
              $i=1;
              
              if(!empty($categories)): 
              foreach($categories as $category):
              if($i>1) $output .= $separator;
              $output .= '<a href="'.  esc_url(get_the_permalink()) .'" alt="'. esc_attr( ' View all post in%s ', $category->name) . '">' . esc_html($category->name) . '</a>';
              $i++; 
              endforeach;
              endif;  
            
            echo '<span class="posted-on">Posted: <a href="'. esc_url(get_the_permalink()) . '">'. $posted_on .'</a> ago </span>  Category :<span class="posted-in"> '.$output.'</span>';
      
        ?>
    </div>
    <!-- <small>Posted on : <?php //the_time('F j, Y');?> at <?php //the_time('g:i a');?><span class="category"><?php //the_category();?></span></small> -->
     
    <header>
     
    
     <div class="the-content"><?php the_content();?></div>
      <!-- <div class="btn-read-more-container">
         <a href="<?php //the_permalink(); ?>" id="btn-read-more" class="button buttom-primary"><?php //_e('Read more')?></a>
      </div> -->

    <footer>
       <?php 
       
       $comments_num=get_comments_number();
       if(comments_open()){
         if($comments_num==0){
          $comments=__('No comments');
         }elseif($comments_num >1){
          $comments=$comments_num . _e('comments');
         }else{
          $comments=__('1 Comment');
         }
         $comments = '<a href="' . get_comments_link() . '">'.$comments.'<span class="dashicons dashicons-admin-comments"></span></a>';
       }else{
        $comments=__('Comments are closed');
       }
        
        echo '<div class="post-footer-container">
                <div class="row"><div class="col-xs-12 col-sm-6">'.get_the_tag_list('<div class="tag-list"><span class="dashicons dashicons-tag"></span>',' ','</div>').'</div>
                <div id="comments" class="col-xs-12 col-sm-6">'.$comments.'</div>
                </div>   
              </div>';
       
       ?>

   </footer>

 </article>

            
  <?php endwhile; endif;?>

    
    <?php //get_sidebar();?>

 <div class="comments">
   <?php if(comments_open()){
        comments_template();
       }
    ?>
 </div>

<h2>This is single.php in jupiter child</h2>

</div>
<?php
get_footer();

