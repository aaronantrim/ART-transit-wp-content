<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(' | '); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png?v4">
		<link href='http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/jquery.csv-0.71.min.js"></script>

		<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>
			<script src="<?php echo get_template_directory_uri(); ?>/library/js/art.js"></script>
			<script src="<?php echo get_template_directory_uri(); ?>/library/js/planner.js"></script>
		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>
		
		
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/interactive-map.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/sml_interactive-map.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/route-icons.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/single-route.css">   
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/kern-transit.css">  
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/dar.css"> 
		
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/library/fonts/MyFontsWebfontsKit.css"> 


<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.css' rel='stylesheet' />

		
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53349417-1', 'auto');
  ga('send', 'pageview');

</script>


		<script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.2/Leaflet.fullscreen.min.js'></script>
<link href='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.2/leaflet.fullscreen.css' rel='stylesheet' />



<meta name="google-translate-customization" content="f25af25643c7b829-5e44eb73351882d9-gcc7ef8ab8e200b71-13"></meta>
        
        <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-19485598-1', 'auto');
  ga('send', 'pageview');

</script>
	</head>

	<body <?php body_class(); ?>>

		<div id="container">
	<?php if(!is_home()) { 
			
			
			
			 get_template_part( 'desktop-header-bar' ); 
		
		
		
		
	 } ?>
		
		<div class="mobile" style="display: none;"> 
		
			<header class="header" role="banner">

						<div id="inner-header" class="wrap cf">
				
							<div id="top-blue-link-banner">
								<div id="logo" class="linked-div" rel="<?php echo get_site_url(); ?>"><a href="<?php echo get_site_url(); ?>"></a></div>
								<div id="transit-name">Anaheim Resort Transportation</div>
								<div id="transit-motto">Public Transportation in the Anaheim Resort and Disneyland Area</div>
							
								<div id="phone-number"><a href="tel:7145635287"><i></i></a></div>
						
							</div><!-- end top-blue-link-banner -->
							<div id="mobile-top-bar-links">
									<ul>
										<li id="get-passes-link" class="blue-border">
											<div class="mobile-icon-holder"><i></i></div>
											<a href="#">Get Passes</a>
										</li>
										<li id="how-to-ride-link" class="blue-border">
											<div class="mobile-icon-holder"><i></i></div>
											<a href="#">How to Ride</a>
										</li>
										<li id="quicklinks-link" class="blue-border">
											<div class="mobile-icon-holder"><i></i></div>
											<a href="#">Quicklinks</a>
											<ul>
												<li>
													Routes &amp; Schedules
												</li>
												<li>
													Another Thing	
												</li>
												<li>
													Another Thing
												</li>
											</ul>
										
										</li>
									</ul>
									<br style="clear: both;" />
								</div><!-- end #mobile-top-bar-links -->

						</div>
			</header>
		
		
		</div>
