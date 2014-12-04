<header class="header desktop-only" role="banner">
 
					<div id="inner-header" class="wrap cf">
				
						<div id="top-blue-link-banner">
							<div id="logo"><a href="<?php echo get_site_url(); ?>"></a></div>
							<div id="transit-name" class="blue-border">Anaheim Resort Transit</div>
							<div id="desktop-main-links">
								<ul>
									<li id="get-passes-link" class="blue-border">  
										<i></i>
										<a href="#">Get Passes</a>
									</li>
									<li id="how-to-ride-link" class="blue-border">
										<i></i>
										<a href="#">How to Ride</a>
									</li>
									<li id="routes-and-schedules-link" class="blue-border">
										<i></i>
										<a href="#">Routes &amp; Schedules</a>
										<ul>
										
										
										<li id="routes-overview-dropdown-link">
												Routes Overview
											</li>
											
										<?php
										$query = new WP_Query(array(
											'posts_per_page' => -1,
											"post_type"=>"route_line",
											'orderby' => 'meta_value', 
											"order" => "ASC"
								

											));

						
												
												if ( $query->have_posts() ) {
													?>
													<ul>
													
													<?php
														$route_line_count = 0;
														while ( $query->have_posts() ) {
															$query->the_post();
											
															?>
																<li class="<?php if ($route_line_count < 8) { echo 'dropdown-left-col';} else { echo 'dropdown-right-col'; } ?>" >
																	
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
							<div id="phone-number"><a href="tel:7145635287">(714) 563-5287</a></div>
						</div><!-- end top-blue-link-banner -->
					</div>
		</header>