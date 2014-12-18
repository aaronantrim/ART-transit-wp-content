<header id="desktop-header-bar-map" class="header desktop-only" role="banner">
 
					<div id="inner-header" class="wrap cf">
				
						<div id="top-blue-link-banner">
							<div id="logo"><a href="<?php echo get_site_url(); ?>"></a></div>
							<div id="transit-name" class="blue-border linked-div" rel="<?php echo get_site_url(); ?>" >Anaheim Resort Transportation</div>
							<div id="desktop-main-links">
								<ul>
									<li id="get-passes-link" class="blue-border linked-div" rel="https://anaheim-transportation-network.myshopify.com">  
										<i></i>
										<a href="https://anaheim-transportation-network.myshopify.com">Get Passes</a>
									</li>
									<li id="how-to-ride-link" class="blue-border">
										<i></i>
										<a href="<?php echo get_site_url();?>/how-to-ride">How to Ride</a>
									</li>
									<li id="routes-and-schedules-link" class="blue-border">
									
										<i class="menu"></i>Routes &amp; Schedules
										<ul class="panel">
										
										
										<!--<li id="routes-overview-dropdown-link">
<span style="color: #a5c5e1">--------------------</span> &nbsp;Routes Overview &nbsp;<span style="color: #a5c5e1">--------------------</span>
											</li>-->
											
										<?php
										$query = new WP_Query(array(
											
											"post_type"=>"route_line",
											'orderby' => 'meta_value_num', 
											'meta_key' => 'route_line_id',
											"order" => "ASC",
											'posts_per_page' => '7',
											'page' => '0',

								

											));

						
												
												if ( $query->have_posts() ) {
													?>
													<ul id="routes-panel-left">
													
													<?php
														$route_line_count = 0;
														while ( $query->have_posts() ) {
															$query->the_post();

															?>
																<li rel="<?php echo get_the_permalink();?>" class="linked-div " >
																	
																	<?php 
																	$routes = explode(',',get_field('route_line_routes'));
																	foreach($routes as &$route) {
																	?>
																	
																	<i id="icon-sml-<?php echo $route ?>" class="route-icon route-icon-sml" > </i>
																	
																	<?php } 
																	
																	
																	the_title(); ?>
																</li>
																
														<?php
														
															$route_line_count ++;
														}
														?>
														</ul>
														<?php
													}  
											wp_reset_postdata();
											
											
											$query = new WP_Query(array(
											
											"post_type"=>"route_line",
											'orderby' => 'meta_value_num', 
											'meta_key' => 'route_line_id',
											"order" => "ASC",
											'posts_per_page' => '7',
											'offset' => '7',

								

											));

						
												 
												if ( $query->have_posts() ) {
													?>
													<ul id="routes-panel-right">
													
													<?php
														$route_line_count = 0;
														while ( $query->have_posts() ) {
															$query->the_post();
															
															?>
																<li rel="<?php echo get_the_permalink();?>" class="linked-div " >
																	
																	<?php 
																	$routes = explode(',',get_field('route_line_routes'));
																	foreach($routes as &$route) {
																	?>
																	
																	<i id="icon-sml-<?php echo $route ?>" class="route-icon route-icon-sml" > </i>
																	
																	<?php } 
																	
																	
																	the_title(); ?>
																</li>
														<?php
														
															$route_line_count ++;
														}
														?>
														</ul>
														<?php
													}  
											wp_reset_postdata();
											?>
										
										
										
										
										
											
										</ul>
									</li>
								</ul>
							</div><!-- end #desktop-main-links -->
							<div id="phone-number"><a href="tel:7145635287">Info: (714) 563-5287</a></div>
						</div><!-- end top-blue-link-banner -->
					</div>
		</header>