<?php 


function themer_posted_meta(){
  $posted_on = human_time_diff(get_the_time('U'),current_time('timestamp'));
  $categories = get_the_category();
  $separator = ',';
  $output    ='';
  $i=1;
  
  if(!empty($categories)): 
   foreach($categories as $category):
   if($i>1) $output .= $separator;
   $output .= '<a href="'.  esc_url(get_the_permalink()) .'" alt="'. esc_attr( ' View all post in%s ', $category->name) . '">' . esc_html($category->name) . '</a>';
   $i++; 
  endforeach;
  endif;  

  return '<span class="posted-on">Posted:<a href="'. esc_url(get_the_permalink()) . '">'. $posted_on .'</a>ago</span>  Category :<span class="posted-in">'.$output.'</span>';
}