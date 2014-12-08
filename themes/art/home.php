<?php get_header(); ?>

			
			<div class="mobile" style="display: none">
			 	<?php get_template_part( 'mobile-home' ); ?>
			</div>


			<div id="content">


					<div id="interactive-map-holder">
							<img id="map-gradient-overlay" src="<?php echo get_template_directory_uri();?>/library/images/map-gradient-overlay.png"  />
					
					<?php get_template_part( 'desktop-header-bar' );  ?>
						<div id="blue-shadow"></div>
						<div id="blue-shadow2"></div>
						
					
						<div id="planner-wrapper">
							<?php get_template_part( 'planner'); ?> 
						</div><!-- end #planner-wrapper -->
				
					
						
					</div><!-- end #interactive-map-holder -->
					<script>
L.mapbox.accessToken = 'pk.eyJ1IjoidHJpbGxpdW10cmFuc2l0IiwiYSI6ImVUQ2x0blUifQ.2-Z9TGHmyjRzy5GC1J9BTw';
var map = L.mapbox.map('interactive-map-holder', 'trilliumtransit.e8e8e512', { zoomControl: false })
   .setView([33.8044,-117.9181], 13);
   
   map.scrollWheelZoom.disable();
   
   new L.Control.Zoom({ position: 'bottomright' }).addTo(map);
</script>
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
								
											<img class="slide-image large linked-div" rel="<?php echo get_permalink(); ?>" src="
											<?php
										
												$thumb_id = get_post_thumbnail_id();
												$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
												echo $thumb_url_array[0];
										
											?>
											">
											
											<?php } ?>
									
												
												<div id="home-image-blurb">
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
								<li><a href="<?php echo get_permalink( 1267 ); ?>" ><i id="how-to-ride-icon"></i>How to Ride Guide</a></li>
								<li><a href="<?php echo get_permalink( 1267 ); ?>" ><i id="faq-icon"></i>FAQ</a></li>
								<li><a href="<?php echo get_permalink( 1267 ); ?>" ><i id="connections-icon"></i>Travel Connections</a></li>
							<!--	<li><a href="<?php echo get_permalink( 7 ); ?>" ><i id="dial-a-ride-icon"></i>Dial-A-Ride</a></li>-->
								<li><a href="<?php echo get_permalink( 5 ); ?>" ><i id="accessibility-icon"></i>Accessibility</a></li>
								<!--<li><a href="<?php echo get_permalink( 9 ); ?>" ><i id="bikes-on-buses-icon"></i>Bikes on Buses</a></li>-->
								<li><a href="<?php echo get_permalink(11 ); ?>" ><i id="passenger-conduct-icon"></i>Policies</a></li>
							<!--	<li><a href="<?php echo get_permalink( 13 ); ?>" ><i id="mobile-and-desktop-apps-icon"></i>Mobile and Desktop Apps</a></li>-->
								<li><a href="<?php echo get_permalink( 15); ?>" ><i id="holidays-icon"></i>Holidays</a></li>
								<li><a href="<?php echo get_permalink( 15); ?>" ><i id="holidays-icon"></i>Hotel Specific Pages</a></li>
								</ul>
								
								
								
								</div><!-- end #how-to-ride-links -->
					
					
								<div id="right-secondary-links" class="secondary-col">

								<?php wp_nav_menu( array( 'theme_location' => 'secondary-link-right-menu' ) ); ?>

								<a id="home-contact-button" href="<?php echo get_permalink( 56); ?>">Contact Us</a>
								<a id="facebook-link" class="secondary-icon-link" href="<?php echo get_permalink( 56); ?>"></a>
								<a id="twitter-link" class="secondary-icon-link" href="<?php echo get_permalink( 56); ?>"></a>
								<a id="youtube-link" class="secondary-icon-link" href="<?php echo get_permalink( 56); ?>"></a>

						</div><!-- end #right-secondary-links -->
							
							</div> <!-- end #secondary-links-row -->
							<br style="clear: both;" />
							<div id="second-home-row">
								<div id="home-lower-promo-image">
										<img  src="<?php echo get_template_directory_uri(); ?>/library/images/lower-promo-image.jpg" />
										
								</div><!-- end #home-lower-promo-image -->
								<div id="home-description-of-services">
									<div id="home-quote">
										<q>“We used ART to take the whole family to Disneyland. It was great not worrying about parking!” - Sally Sue from Reno, Nevada</q>
										
									</div>
									<div id="description-text">Kern Transit provides passenger bus service between and in the rural communities of Kern County. There are 17 fixed transit routes, and Dial-A-Ride (DAR) service is available in most communities. The transit system offers intercity service between Arvin, Bakersfield, Bodfish, Boron, Buttonwillow, California City, Delano, Edwards, Frazier Park, Inyokern, Keene, Kernville, Lake Isabella, Lamont, Lebec, Lost Hills, McFarland, Mojave, Onyx, Ridgecrest, Rosamond, Shafter, Taft, Tehachapi, Wasco, Weldon, and Wofford Heights, along with local transit service. Connections to Metrolink in Lancaster are also available. Kern Transit is a division of the Kern County Roads Department.
									&nbsp;<a href="<?php echo get_permalink( 56); ?>" >More About Anaheim Resort Transit</a>
									</div><!-- end #description-text -->
								</div> <!-- end #home-description-of-services -->
							</div><!-- end #second-home-row-->
						
						</div><!-- end #home-secondary-container -->
					
<?php get_footer(); ?>
				</div>
				
				</body>

</html> <!-- end of site. what a ride! -->





