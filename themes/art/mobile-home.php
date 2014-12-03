 
		
		<h3 id="estimated-arrivals-title" class="mobile-padded" >Estimated Next arrivals for your current location 
at [stop name]:</h2>
		<div id="mobile-map-link" class="mobile-padded linked-div" rel="<?php echo get_permalink(71); ?>" >
		<i></i>
			Open a full-screen interactive map
		</div><!-- end #mobile-map-link -->
		<div id="route-quick-select" class="mobile-padded" >
			<select>
				<option>Select a bus route</option>
				<option>Route 1</option>
				<option>Route 2</option>
				<option>Route 3</option>
				<option>Route 4</option>
			</select>
		</div><!-- end #route-quick-select -->
		<?php if(get_alertCount() > 0) { ?>
		<h1 id="mobile-alerts-drawer" class="mobile-drawer-header"><i></i>Alerts</h1>
		<div class="mobile-drawer" style="display: none;">
			
		</div>
		<?php } else {
		?>
		<div id="no-alerts-text" class="mobile-padded">
		- No service alerts at this time - 
		</div><!-- end #no-alerts-text -->
		<?php } ?>
		<?php
							
								
							$query = new WP_Query(array(
							'category_name' => 'home-page-featured-category',

							));

						
						
								if ( $query->have_posts() ) {
									?>
									<h1 id="mobile-alerts-drawer" class="mobile-drawer-header promo"><i></i><?php the_title() ?></h1>
									
									<?php
									
										while ( $query->have_posts() ) {
											$query->the_post();
											
										
										
												if( has_post_thumbnail()) { ?>
								
											
									
												
												<div class="mobile-drawer promo" style="display: none;">
													<h3 class="mobile-padded"><?php the_field('home_promo_subtitle');?></h3>
													<img class="slide-image large linked-div" style="width: 100%" rel="<?php the_permalink(); ?>" src="
													<?php
										
														$thumb_id = get_post_thumbnail_id();
														$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
														echo $thumb_url_array[0];
										
													?>
													">
											
													<?php } ?>
													<div class="mobile-padded"><?php the_excerpt(); ?>
													<a href="<?php echo get_permalink() ?>">Read more >></a></div><!-- end .mobile-padded -->
												</div>
											
										<?php
										}
										?>

											
										<?php
										
									}  
							wp_reset_postdata();
							?>
		
		
		<h1 id="mobile-alerts-drawer" class="mobile-drawer-header"><i></i>Info</h1>
		<div class="mobile-drawer" style="display: none;">
			<h3>How to Ride</h3>
			
			<nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => '',                              // remove nav container
    					'container_class' => 'mobile-info-1 cf',         // class of container (should you choose to use it)
    					'menu' => __( 'mobile-info-1', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'mobile-info-2',             // where it's located in the theme
    					'before' => '',                                 // before the menu
        			'after' => '',                                  // after the menu
        			'link_before' => '',                            // before each link
        			'link_after' => '',                             // after each link
        			'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>
			
			<h3>Customer Service</h3>
				<nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => '',                              // remove nav container
    					'container_class' => 'mobile-info-2 cf',         // class of container (should you choose to use it)
    					'menu' => __( 'mobile-info-2', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'mobile-info-2',             // where it's located in the theme
    					'before' => '',                                 // before the menu
        			'after' => '',                                  // after the menu
        			'link_before' => '',                            // before each link
        			'link_after' => '',                             // after each link
        			'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>
			<h3>About ART</h3>	
			<nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => '',                              // remove nav container
    					'container_class' => 'mobile-info-3 cf',         // class of container (should you choose to use it)
    					'menu' => __( 'mobile-info-3', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'mobile-info-3',             // where it's located in the theme
    					'before' => '',                                 // before the menu
        			'after' => '',                                  // after the menu
        			'link_before' => '',                            // before each link
        			'link_after' => '',                             // after each link
        			'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>
			
			
		
		</div>
		
		<h1 id="mobile-alerts-drawer" class="mobile-drawer-header"><i></i>News</h1>
		<div class="mobile-drawer" style="display: none;">
		</div>