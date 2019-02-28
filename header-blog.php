<?php
/**
 * The custom Header
 *
 */
?>
<!DOCTYPE html>

<html  <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php bloginfo( 'name' ); ?> <?php wp_title('|');?></title>
    <meta name="Description" content="<?php bloginfo( 'Description' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<section class="header-wrapper">
    <div class="container-fluid">
         <div class="row">
          <div class="col-xs-12 col-sm-4 call-us">
               <?php _e('CALL US: +639150480717');?>
        </div>

       <div class="col-xs-6 col-sm-4">
               <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name') ); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo" width="HERE" height="HERE" />
                </a>    
       </div>

       <div class="col-xs-6 col-sm-4">
            <div class="social">
                    <ul class="social-items">
                        <li><a href="https://www.facebook.com/jaz.balase" class="dashicons dashicons-facebook-alt"></a></li>
                    
                        <li><a href="https://www.facebook.com/jaz.balase" class="dashicons dashicons-twitter"></a></li>
                
                        <li><a href="https://www.facebook.com/jaz.balase" class="dashicons dashicons-share-alt"></a></li>
                    
                        <li><a href="https://www.facebook.com/jaz.balase" class="dashicons dashicons-video-alt3"></a></li>
                    </ul>  
                </div>
            <a id="menu-menu" class="btn btn-default dashicons dashicons-menu"></a>
      </div>  
</div>

<div class="menu-container" style="display:none;float:right">
                    <?php $menu_1=array(
                        //'theme_location'=>'primary',
                        'container'=>false,
                        'walker'=>new Walker_Nav_Primary(),
                        );
                    ?>   
                    <?php wp_nav_menu($menu_1);?> 
                       <span class="search-container"><?php //get_search_form();?></span>
                </div>
</section>

             




     

	