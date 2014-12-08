<div id="planner">
	<h2 class="Dense-Regular">Find a Bus Route</h2>
	<div id="inner-planner">
	<h3 id="from-header">From</h3>
	<div id="from-items-container" class="items-container open">
		<ul>
			<li>
				<div class="tab-holder"><a href="javascript:void(0)">Attractions</a></div>
				<div class="place-pannel">
					<div class="next-button"> 
						<i class="upper-arrow"></i>
						<div class="more">More</div>
						<i class="lower-arrow"></i>
					</div><!-- end #next-button -->
					<div class="panel-tab panel-tab-0"> 
						<div class="place-col-1">
							<ul>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
						
							</ul>
						</div><!-- end #place-col-1 -->
						<div class="place-col-2">
							<ul>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
						
							</ul>
						</div><!-- end #place-col-2 -->
					</div><!-- end .panel-tab -->
					<div class="panel-tab panel-tab-1">
						<div class="place-col-1">
							<ul>
								<li>
									 Attraction2
								</li>
								<li>
									 Attraction2
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
						
							</ul>
						</div><!-- end #place-col-1 -->
						<div class="place-col-2">
							<ul>
								<li>
									 Attraction2
								</li>
								<li>
									 Attraction2
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
						
							</ul>
						</div><!-- end #place-col-2 -->
					</div><!-- end .panel-tab -->
				</div><!-- end place-pannel -->
			</li>
			<li class="active"> 
				<div class="tab-holder"><a href="javascript:void(0)">Hotels</a></div>
				<div class="place-pannel" rel="0">
				<div class="next-button"> 
						<i class="upper-arrow"></i>
						<div class="more">More</div>
						<i class="lower-arrow"></i>
					</div><!-- end #next-button -->
					<div class="panel-tab panel-tab-0 showing"> 
					
					
					<?php $args = array(
        'order'                  => 'ASC',
        'orderby'                => 'menu_order',
        'post_type'              => 'nav_menu_item',
        'post_status'            => 'publish',
        'output'                 => ARRAY_A,
        'output_key'             => 'menu_order',
        'nopaging'               => true,
        'update_post_term_cache' => false ); 
        
         $hotel_items = wp_get_nav_menu_items( 'hotel_planner_menu', $args ); 
         
        
	
	?>
					
						<div class="place-col-1">
							<ul>
							<?php
								 foreach ( (array) $hotel_items as $key => $menu_item ) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			$menu_list .= '<li>'.$title . '</li>';
			
		}
		echo $menu_list;
		
		?>
						
							</ul>
						</div><!-- end #place-col-1 -->
						<div class="place-col-2">
							<ul>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
						
							</ul>
						</div><!-- end #place-col-2 -->
					</div><!-- end .panel-tab -->
					<div class="panel-tab panel-tab-1" style="display: none;">
						<div class="place-col-1">
							<ul>
								<li>
									 Attraction2
								</li>
								<li>
									 Attraction2
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
						
							</ul>
						</div><!-- end #place-col-1 -->
						<div class="place-col-2">
							<ul>
								<li>
									 Attraction2
								</li>
								<li>
									 Attraction2
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
								<li>
									 Attraction
								</li>
						
							</ul>
						</div><!-- end #place-col-2 -->
					</div><!-- end .panel-tab -->
				</div><!-- end place-pannel -->
			</li>
			<li>
				<div class="tab-holder"><a href="javascript:void(0)">Restaurants</a></div>
				<div class="place-pannel">
				<div class="next-button"> 
						<i class="upper-arrow"></i>
						<div class="more">More</div>
						<i class="lower-arrow"></i>
					</div><!-- end #next-button -->
					<div class="place-col-1">
						<ul>
							<li>
								 Restaurant
							</li>
							<li>
								 Restaurant
							</li>
							<li>
								 Restaurant
							</li>
							<li>
								 Restaurant
							</li>
							<li>
								 Restaurant
							</li>
							<li>
								 Restaurant
							</li>
							<li>
								 Restaurant
							</li>
						
						</ul>
					</div><!-- end #place-col-1 -->
					<div class="place-col-2">
						<ul>
							<li>
								 Restaurant
							</li>
							<li>
								 Restaurant
							</li>
							<li>
								 Restaurant
							</li>
							<li>
								 Restaurant
							</li>
							<li>
								 Restaurant
							</li>
							<li>
								 Restaurant
							</li>
							<li>
								 Restaurant
							</li>
						</ul>
					</div><!-- end #place-col-2 -->
				</div><!-- end place-pannel -->
			</li>
		
		</ul>
		
	</div><!-- end #from-items-container -->
	<form>
	<input class="loc-input" type="text" name="from-loc" placeholder= "Or enter a starting address">
	
	<h3 id="to-header">TO</h3>
	<div id="to-items-container" class="items-container" class="">
		<ul>
			<li>
				<div class="tab-holder"><a href="javascript:void(0)">Attractions</a></div>
				<div class="place-pannel">
					<div class="next-button"> 
						<i class="upper-arrow"></i>
						<div class="more">More</div>
						<i class="lower-arrow"></i>
					</div><!-- end #next-button -->
					<div class="place-col-1">
						<ul>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
						
						</ul>
					</div><!-- end #place-col-1 -->
					<div class="place-col-2">
						<ul>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
						
						</ul>
					</div><!-- end #place-col-2 -->
				</div><!-- end place-pannel -->
			</li>
			<li >
				<div class="tab-holder"><a href="javascript:void(0)">Hotels</a></div>
				<div class="place-pannel">
				<div class="next-button"> 
						<i class="upper-arrow"></i>
						<div class="more">More</div>
						<i class="lower-arrow"></i>
					</div><!-- end #next-button -->
					<div class="place-col-1">
						<ul>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
						
						</ul>
					</div><!-- end #place-col-1 -->
					<div class="place-col-2">
						<ul>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
						
						</ul>
					</div><!-- end #place-col-2 -->
				</div><!-- end place-pannel -->
			</li>
			<li>
				<div class="tab-holder"><a href="javascript:void(0)">Restaurants</a></div>
				<div class="place-pannel">
				<div class="next-button"> 
						<i class="upper-arrow"></i>
						<div class="more">More</div>
						<i class="lower-arrow"></i>
					</div><!-- end #next-button -->
					<div class="place-col-1">
						<ul>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
						
						</ul>
					</div><!-- end #place-col-1 -->
					<div class="place-col-2">
						<ul>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
							<li>
								 Attraction
							</li>
						
						</ul>
					</div><!-- end #place-col-2 -->
				</div><!-- end place-pannel -->
			</li>
		
		</ul>
		
	</div><!-- end #to-items-container -->
	<input type="text" name="from-loc" placeholder= "Or enter your destination's address">
	<input type="submit" value="Show Travel Plan" >
	</form>
	<br style="clear:both;">
	</div><!-- end #inner-planner -->
</div>