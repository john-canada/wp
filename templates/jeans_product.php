<?php if(!defined('ABSPATH')) exit; // prevent direct access

/*
** template name: Jeans Product
*/

get_header();
?>

<div class="container">
    <?php
     global $product;
  

   $args = array(
    'post_type'     => 'product',
    'post_status'   => 'publish',
    'posts_per_page'=>2,
    'paged'=>1,

    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => array( 'jeans'), 
        ),
    )
);

         $query = new wp_query($args); 
         ?>  
      
       <?php if($query->have_posts()): ?>
          <ul class="my-post the_post_data">
              <?php while($query->have_posts()): $query->the_post();?>
                   <li>
                    <div class="the_thumbnail_ajax"><?php  the_post_thumbnail(array(300,300));?></div>
                    <div class="the_title_ajax"><?php  the_title();?></div>
                  </li>
              <?php endwhile;?>
        </ul> 
    <?php  endif;?>  

    <div class="loading" style="display:none">Loading...</div>
</div><!-- .container -->


<script>
   jQuery(document).ready(function($){
       var ajaxurl = "<?php echo admin_url('admin-ajax.php')?>";
       var page = 2;
       $(window).scroll(function(){
          // variable declearation
           var postTop = $(window).scrollTop();
           var doc_height=$(document).height();
           var window_height=$(window).height();
           var diftotal=doc_height-window_height;
            
           console.log('scroll ' + postTop + '=' + diftotal);

           if(postTop==diftotal){
        
              var data={
                      'action':'load_more_post_by_ajax',
                      'page':page,
                      'security':'<?php echo wp_create_nonce("load_more_posts")?>'
                    };

                   $.ajax({
                        type: 'post',
                        url: ajaxurl,
                        data: data,

                        error: function(response) {
                            console.log(response);
                        },

                        beforeSend: function(response) {
                       //  $('.loading').css({ "display": "block" });
                        },

                        success: function(response) {
                    
                            if(response!=0){
                                $('.the_post_data').append(response);
                              //  $('.loading').css({ "display": "none" });
                                page = page + 1;
                               // return false;
                                }else{
                                $('.the_post_data').append('<h4> No more post to load </h4>');
                                $('.my-post').removeClass('the_post_data');
                              //  $('loading').removeClass();
                               // return false;
                            }

                        }

                    });// endof ajax
     

           }
      
       });// end of scroll

   });// end of jQuery function
</script>

<?php get_footer();?>


