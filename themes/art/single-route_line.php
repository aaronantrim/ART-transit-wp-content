<?php
/*
Template Name: route_individual_page_hardcoded
*/
 get_header(); 
 
 // get route_line description
 
include get_template_directory().'/library/php/simple_html_dom.php';
 
 
 
 $url = 'http://archive.oregon-gtfs.com/gtfs-api/stops/by-feed/'.get_gtfs_name().'/nearest-to-lat-lon/33.8541276642152/-117.840476632118/within/1000/meters';
$content = file_get_contents($url);
$stop_json = json_decode($content, true);


 //echo get_local_base_path();
 
 $route_desc = "";
 $route_color = "";
 $route_text_color = "";
  $route_freq = "";
 $routes = explode(",",get_field('route_line_routes'));
 
 $route_posts =  array();
 
 
 $route_ids_for_query = array();
 
 foreach($routes as &$route) {
 	 $route_ids_for_query[] = $route;
 }
 
$query = new WP_Query(array(
								'post_type' => 'route',
							'meta_key' => 'route_short_name',
							'meta_value' => $route_ids_for_query,

							));

						
						
								if ( $query->have_posts() ) {
									?>
									
									
									<?php
									
										while ( $query->have_posts() ) {
											$query->the_post();
											
										$route_desc = get_field('route_desc');
										$route_color = get_field('route_color');
										$route_text_color = get_field('route_text_color');
										$route_freq = get_field('route_frequency');
										$route_posts[] = $post;
												
										}
										
										
										?>

										
										<?php
										
									}  
							wp_reset_postdata();
							

							$route_freq_only = explode('*',$route_freq)[0];
							$route_first_bus = explode('*',$route_freq)[1];
							$route_last_bus = explode('*',$route_freq)[2];
							
							?>
 
 

			<div id="content">

				<div id="inner-content" class="wrap cf">
				
				<?php 
//				print_r($route_posts);
				//foreach($route_posts as &$route_post) {  echo  get_post_meta( $route_post->ID, 'route_id', true);} 
				$time_query_base = "";
				$route_post_count = 0;
				foreach($route_posts as &$route_post)  {  
					$time_query_base .= get_post_meta( $route_post->ID, 'route_id', true);
					if($route_post_count < sizeof($route_posts)-1) {
						$time_query_base .= ",";
					}
				
					$route_post_count ++;
				 }
				 $json_query_url = 'http://archive.oregon-gtfs.com/gtfs-api/earliest-route-span/by-feed/anaheim-new-ca-us/route-id/'.$time_query_base;
				// echo $json_query_url;
				$bus_times_raw = file_get_contents($json_query_url);
				$bus_times_json = json_decode($bus_times_raw);
				
				
				//  for each bus id, iterate all json routes, upon find match, make that time the earliert
				
				
				?>
				
			
<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
<?php the_breadcrumb() ?>
<div id="generic-wide-container-top"></div>
<div id="generic-wide-container">

<div id="route-icons-and-header">
<?php

	
	
		$routes = explode(",",get_field('route_line_routes'));
		
		$route_count = 0;
		foreach($routes as &$route) {
			$first = false;
			$last = false;
			
		
			if($route_count == 0) {
				$first = true;
			} 
			if($route_count == sizeof($routes)-1) {
				$last = true;
			}
			$spacer = "";
			if(!$last) {
			 $spacer = "bubble-spacer";
			}
		?>
			
			<i id="icon-lrg-<?php echo $route;?>" class="route-icon-large <?php echo $spacer.' '; if($first) echo ' first'; if($last) echo ' last';?>"></i>
		
		<?php
			$route_count++;
		}
		
		?>
	
<!--<i class="route-1-icon-large route-icon-large first"></i>-->
	
	<h2 id="route-title" class="<?php if($route_desc=="") echo "no-route-desc"; ?>"><?php the_title(); ?> <br /><span class="street-desc"><?php echo $route_desc ;?></span></h2>
	<br style="clear:both;" />
	<div class="route-quicklinks">Jump to: <a href="#map">Map</a> &nbsp;<a href="#stop-table">Stop Table</a></div>
</div><!-- end #route-icons-and-header -->
<div class="route-divider"></div>

<div id="frequency-and-times">
	<ul>
		<li class="first item-num-0">
			<?php if($route_freq_only == "0") {
				?>
				<i id="clock-icon"></i>Frequency: See <a href="#stop-table">stop tables</a> below
				<?php
			} else { ?>
			<i id="clock-icon"></i>Frequency: Every <?php echo $route_freq_only;?> minutes
			<?php } ?>
			
		</li>
		<li class="item-num-1">
			First bus today: <?php echo $route_first_bus; ?>
		</li>
		<li class="last item-num-2">
			Last bus today: <?php echo $route_last_bus; ?>
		</li>
	</ul>
</div><!-- #end frequency-and-times -->

<div class="route-divider"></div>

<?php  

// check if there is an alert for route-#... and System-wide

 $alert_zones = array();
 
 foreach($routes as &$route_indiv) {
 	$alert_zones[] = 'route_'.$route_indiv;
 }

 $alert_zones[] = 'all-routes';

								
								
								$alertCount = 0;
								$alert_query = new WP_Query(array(
								"post_type"=>array("alert", 'news'), 
								'tax_query' => 
								array(
									array(
										'taxonomy' => 'alert-zone',
										'field' => 'slug',
										'terms' => $alert_zones,	
									)
								),
								

							) );

						
						
								if ( $alert_query->have_posts() ) { ?>

								<div id="route-alerts"  style="clear:both;"><ul>
								<?

										while ( $alert_query->have_posts() ) {
											$alert_query->the_post();
											?>
												<li  class="minimized">
												<h3 class="route-alert-header <?php if($alertCount > 0) echo 'not-first'; ?>"><i id="alert-icon-black"></i>Service Alert: <?php the_title() ;?><span id="alert-click-message">Click to Expand</span></h3>  
												<div id="alert-content" style="display:none;">
												<?php the_content(); ?>
												<div id="route-alert-link">
													<a href="<?php the_permalink();?>">Go to Alert Page >></a>
												</div><!-- end #route-alert-link -->
												
												</div><!-- end #alert-content -->
												</li>
												<?php
												$alertCount ++;
										}
										echo '</ul></div><!-- end #route-alerts -->';
									}  
							wp_reset_postdata();
							
							
 

?>

										
											
												
											
									
									
									
<?php 

if(false) { ?>
<div id="route-arrivals">
<div id="arrival-text">

<h3>Next estimated arrivals at your current location: </h3>
<?php
if(sizeof($stop_json)>0) {

	?>
	<ul id="route_nearest_stops">
	<?php
	foreach($stop_json as &$stop) {
		echo '<li>';
		echo 'Bus Stop: ';
		echo $stop['stop_name'].' route id: ';
		$routes = $stop['routes'];
		echo $routes[0]['route_id'];
		
		echo ' Direction: disneybound Arrival time: 234234</li>';
	}
	?>
	</ul> <!-- end route_nearest_stops" -->
	<?php
}
?>


&nbsp; <strong>Disneybound: 3:35 PM</strong>, &nbsp;<strong>Outbound: 3:42 PM</strong> </div>
<div id="estimated-location-text">Estimated Location:  Hampton Inn, Anaheim</div>
</div><!-- end #route-arrivals -->
<div class="route-divider"></div>
<div id="list-related-attractions">
<ul>
	<li>
	<span class="attraction-header">Attractions served include:</span> Disneyland, Anaheim Convention Center Grand Plaza 
	</li>
	<li>
	<span class="attraction-header">Hotels served include:</span> Days Inn Anaheim, Best Western Raffles, Red Lion Hotel,  Hyatt House (2015), 
Stanford Inn & Suites 
	</li>
	<li>
		<span class="attraction-header">Featured restaurants/shopping:</span>  Target, Morton’s the Steakhouse, Ruth Chris Steakhouse,Roscoes Chicken & Waffles, IHOP, Dolphin's Cove
	</li>
</ul>

<br style="clear: both;" />
</div><!-- end #list-related-attractions -->

<?php } ?>

<div class="route-divider" >
<style>
table {
text-align: left;
border: 1px solid white;
margin: 10px;
background: rgba(255,255,255,.1);
}

 th, td {
   border: 1px solid #b1c2c9;
   padding: 3px;
}
.route_list a:link, a:visited{
float: left;
padding: 3px;
color: white;
}

th {
	font-weight: 600px;
}
</style>


</div>





			
<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

						
							<?php endif; ?>
</div><!-- generic-wide-container -->

</div> <!-- end #content -->
</div> <!-- end #inner-content -->
<?php
$route_ids = array();
 $routes = explode(",",get_field('route_line_routes')); 
 
foreach($routes as &$route_id_single) {

$query = new WP_Query(array(
							'posts_per_page' => -1,
							"post_type"=>"route", 
							'meta_key_num' => 'route_id',
							'meta_value' => $route_id_single
								

							));

						
						
								if ( $query->have_posts() ) {
									
									
										while ( $query->have_posts() ) {
											$query->the_post();

											
										$route_ids[] = get_field('route_id');
											
										
										}
										
									}  
							wp_reset_postdata();
							
							}
							


?>

<a name="map"></a><div id="route-map">

</div><!-- end #route-map -->

<div id="content">

<div id="inner-content" class="wrap cf">
			
<div id="generic-wide-container" style="padding-top: 20px;" >
<a name="stop-table"></a>
<h2 class="route-header" style="background: #<?php echo $route_color;?>; color: #<?php echo $route_text_color; ?>;" >Stop table for the <?php the_title();?></h2>

<?php

$stop_table_url =  get_local_base_path().'/wp-content/transit-data/timetables/'.strtolower (str_replace(".", "",str_replace(" ", "_",get_the_title()))).'.html';
$stop_table_html = str_get_html(file_get_contents ($stop_table_url));

for($ind = 1; $ind <= 21; $ind ++) {

$route_line_name = "";

$query = new WP_Query(array(
								'post_type' => 'route',
							'meta_key' => 'route_short_name',
							'meta_value' => $ind,

							));

						
						
								if ( $query->have_posts() ) {
									
									
										while ( $query->have_posts() ) {
											$query->the_post();
										
										$route_line_name = slugify(get_field('route_long_name'));
												
										}
										
										
									
										
									}  
							wp_reset_postdata();
							


	$stop_links = $stop_table_html->find('.route-'.$ind); 
	foreach($stop_links as &$stop_link) {
	
		$stop_link->id = 'icon-xsml-'.$ind;
		$stop_link->innertext = "";
		$stop_link->class = "route-icon linked-div";
		$stop_link->rel = $route_line_name;
		
	
	}

}

echo $stop_table_html;

// pull in and parse timetable.


//echo $web_label_html->find('.labelShelterArrivalRowOdd')[0];

 ?>


<br style="clear: both" />
</div> <!-- end id="content"-->

</div> <!-- id="inner-content" class="wrap cf"-->
			
</div> <!-- end id="generic-wide-container"-->



<?php

$route_js_array = "";
$id_count = 0;
foreach($route_ids as &$_route_id) {
$route_js_array .= $_route_id;
if($id_count < sizeof($route_ids)-1) {$route_js_array .= ',';} 
$id_count ++;
}
 ?>
 
<?php
					$link =  "//$_SERVER[HTTP_HOST]"; 
if (strpos($link, 'localhost') !== FALSE) { // check if on mamp/apache localhost
$link .= "/art/";
}
$link .= "/wp-content/themes/art/AnaheimMap/";
?>
 <script src="<?php echo $link; ?>generate-map-js.php?routes=<?php echo $route_js_array; ?>&system_map=false&container_id=route-map"></script>

<?php get_footer(); 




?>