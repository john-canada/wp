<!DOCTYPE html>

<html <?php echo language_attributes();?> >

<head>

    <?php wp_head(); ?>
 
	<style>
		.preloader-logo{
			top: 46% !important;
		}
		.preloader-preview-area{
			top: 40% !important; 	
		}
		
    </style>
<!-- <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">	
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">  -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<!-- Facebook Pixel Code -->
<script>
				!function(f,b,e,v,n,t,s)
				{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
				n.callMethod.apply(n,arguments):n.queue.push(arguments)};
				if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
				n.queue=[];t=b.createElement(e);t.async=!0;
				t.src=v;s=b.getElementsByTagName(e)[0];
				s.parentNode.insertBefore(t,s)}(window, document,'script',
				'https://connect.facebook.net/en_US/fbevents.js');
				fbq('init', '560646194401813');
				fbq('track', 'PageView');
			</script>
			<!-- <noscript><img height="1" width="1" style="display:none"
				src="https://www.facebook.com/tr?id=560646194401813&ev=PageView&noscript=1"
			/></noscript> -->
<!-- End Facebook Pixel Code -->

<script>
  fbq('track', 'Lead');
</script>

</head>

<body <?php body_class(mk_get_body_class(global_get_post_id())); ?> <?php echo get_schema_markup('body'); ?> data-adminbar="<?php echo is_admin_bar_showing() ?>">
	<div id="st-container" class="st-container">
	<?php
		// Hook when you need to add content right after body opening tag. to be used in child themes or customisations.
		do_action('theme_after_body_tag_start');
	?>

	<!-- Target for scroll anchors to achieve native browser bahaviour + possible enhancements like smooth scrolling -->
	<div id="top-of-page"></div>
		<div id="mk-boxed-layout">
			<div id="mk-theme-container" <?php echo is_header_transparent('class="trans-header"'); ?>>

				<?php mk_get_header_view('styles', 'header-'.get_header_style());
				 
	 