<?php get_header(); ?>

			
			<div class="mobile" style="display: none">
			 	<?php get_template_part( 'mobile-home' ); ?>
			</div>


			<div id="content">

<div id="interactive-map-holder-wrap" style="width:100%;height:100%;position: relative;">
					<div id="interactive-map-holder">
							<!--<img id="map-gradient-overlay" src="<?php echo get_template_directory_uri();?>/library/images/map-gradient-overlay.png"  />-->
					
					<?php get_template_part( 'desktop-header-bar' );  ?>
						<div id="blue-shadow"></div>
						<div id="blue-shadow2"></div>
						
					
						<div id="planner-wrapper" style="display: none;">
							<?php get_template_part( 'planner'); ?> 
						</div><!-- end #planner-wrapper -->
						<div id="full-screen-desktop" onclick="map.toggleFullscreen()"><a href="javascript:void(0)" onclick="map.toggleFullscreen()"><i></i> Go FullScreen</a></div>
						<?php 
							$alert_count = get_alertCount();
							if($alert_count > 0) {
							?>
								<div id="desktop-map-alerts" class="linked-div" rel="<?php echo get_site_url(); ?>/alerts" ><a href="<?php echo get_site_url(); ?>/alerts"><i id="alert-icon-lrg"></i>Alerts (<?php echo $alert_count; ?>)</a></div>
							<?php } else { ?>
							
							
							<div id="desktop-map-alerts">No Current Alerts</div>
							
							<?php
							
							}
							
							?>
						
						
					</div><!-- end #interactive-map-holder -->
					
					 <img id="draggingDisabled" src="<?php echo get_template_directory_uri(); ?>/AnaheimMap/images/map-gradient-overlay-copy.png" style="width: 100%; height: 100%; z-index: 100; position: absolute; top: 0; pointer-events: none;" /> 
</div> <!-- end id="interactive-map-holder-wrap" -->
					<?php
					$link =  "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
if (strpos($link, 'localhost') !== FALSE) { // check if on mamp/apache localhost
//$link .= "/art";
}
$link .= "wp-content/themes/art/AnaheimMap/";
?>
				<script src="<?php echo $link; ?>generate-map-js.php?routes=1696,1697,1698,1699,1700,1701,1702,1703,1704,1705,1706,1707,1708,1709,1710,1711,1712,1713,1714,1716&system_map=true&container_id=interactive-map-holder"></script>


<?php
							
								
							$query = new WP_Query(array(
							'category_name' => 'home-page-featured-category',

							));

						
						
								if ( $query->have_posts() ) {
									?>
									<div id="home-slide-show">
									
									<?php
									
										while ( $query->have_posts() ) {
											$query->the_post();
											
										
										
												if( has_post_thumbnail()) { ?>
								
											<img class="slide-image large" rel="<?php echo get_permalink(); ?>" src="
											<?php
										
												$thumb_id = get_post_thumbnail_id();
												$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
												echo $thumb_url_array[0];
										
											?>
											">
											
											<?php } ?>
									
												
												<div id="home-image-blurb"  rel="<?php echo get_permalink(); ?>">
													<div id="home-image-blurb-main-text" class="Dense-Regular"> 
														<?php the_title() ?>
													</div>
													<div id="home-image-blurb-subtext">
														<?php the_field('home_promo_subtitle') ?>
													</div>
												</div>
											
										<?php
										}
										?>

											</div><!-- end #home-slide-show -->
										<?php
										
									}  
							wp_reset_postdata();
							?>



				
					
			
				
				
					

						<div id="home-secondary-container">
							<div id="secondard-links-row" >
								
							
							
						<div id="home-news-area" class="secondary-col" >
						<h2 class="Dense-Regular">News</h2>
						<?php
							
								
							$query = new WP_Query(array(
							'posts_per_page' => 3,
							"post_type"=>"news", 
								

							));

						
						
								if ( $query->have_posts() ) {
									?>
									<ul>
									<?php
									
										while ( $query->have_posts() ) {
											$query->the_post();
											
											?>
												<li class="home-news-outer" >
													 <a href="<?php the_permalink(); ?>" class="home-news-inner">
									   
														 <i></i> <?php the_title(); ?>
										 
													 </a>
												</li>	
											
										<?php
										}
										?>
										</ul>
										<?php
									}  
							wp_reset_postdata();
							?>
						
						<div id="home-more-news"><a href="./news">See More News >></a></div>
						
					</div> <!-- end #home-news-area -->
						<div id="how-to-ride-links" class="secondary-col">
								
								<ul>
								<li><a href="<?php echo get_permalink( 377 ); ?>" ><i id="how-to-ride-icon"></i>How to Ride Guide</a></li>
								<li><a href="<?php echo get_permalink( 808 ); ?>" ><i id="faq-icon"></i>FAQ</a></li>
								<li><a href="<?php echo get_permalink( 890 ); ?>" ><i id="connections-icon"></i>Transportation Connections</a></li>
								<!--<li><a href="<?php echo get_permalink( 7 ); ?>" ><i id="dial-a-ride-icon"></i>Dial-A-Ride</a></li>-->
								<!--<li><a href="<?php echo get_permalink( 5 ); ?>" ><i id="accessibility-icon"></i>Accessibility</a></li>-->
								<!--<li><a href="<?php echo get_permalink( 9 ); ?>" ><i id="bikes-on-buses-icon"></i>Bikes on Buses</a></li>-->
								<li><a href="<?php echo get_permalink( 865 ); ?>" ><i id="passenger-conduct-icon"></i>Passenger Code of Conduct</a></li>
							<!--	<li><a href="<?php echo get_permalink( 13 ); ?>" ><i id="mobile-and-desktop-apps-icon"></i>Mobile and Desktop Apps</a></li>-->
								<!--<li><a href="<?php echo get_permalink( 15); ?>" ><i id="holidays-icon"></i>Holidays</a></li>-->
								<!--<li><a href="<?php echo get_permalink( 15); ?>" ><i id="holidays-icon"></i>Hotel Specific Pages</a></li>-->
								</ul>
								
								
								
								</div><!-- end #how-to-ride-links -->
					
					
								<div id="right-secondary-links" class="secondary-col">

								<?php wp_nav_menu( array( 'theme_location' => 'secondary-link-right-menu' ) ); ?>

								<a id="home-contact-button" href="<?php echo get_permalink( 102); ?>">Contact Us</a>
								<a id="facebook-link" class="secondary-icon-link" href="https://www.facebook.com/rideart"></a>
								<a id="twitter-link" class="secondary-icon-link" href="https://twitter.com/ARTransit"></a>
								<a id="youtube-link" class="secondary-icon-link" href="https://www.youtube.com/watch?v=GgA7BeIYaDs"></a>

						</div><!-- end #right-secondary-links -->
							
							</div> <!-- end #secondary-links-row -->
							<br style="clear: both;" />
							<div id="second-home-row">
								<div id="home-lower-promo-image">
										<img  src="<?php echo get_template_directory_uri(); ?>/library/images/lower-promo-image.jpg" />
										
								</div><!-- end #home-lower-promo-image -->
								<div id="home-description-of-services">
									<div id="home-quote">
										<q>“I just spent a few days with my girls at Disneyland and we rode the ART. The buses were great and people were very professional.” <br /><span class="quote-author">- Christina from Phoenix, AZ</span></q>
										
									</div>
									<div id="description-text">Anaheim Resort Transportation (ART) is public transportation within the Anaheim Resort area of Orange County, California. The 20-route ART system provides convenient transportation that connects theme parks and other locations, including 50 hotels, more than 20 restaurants, and the ARTIC transportation center. Buses operate from early morning to late night on most days. Every year, ART buses carry more than 3 million residents, visitors, and employees in the Anaheim Resort region. ART is managed by Anaheim Transportation Network.
									&nbsp;<a href="<?php echo get_permalink( 56); ?>" >More About Anaheim Resort Transportation Network</a>
									</div><!-- end #description-text -->
								</div> <!-- end #home-description-of-services -->
							</div><!-- end #second-home-row-->
						
						</div><!-- end #home-secondary-container -->
					
<?php get_footer(); ?>
				</div>
				
				</body>

</html> <!-- end of site. what a ride! -->





