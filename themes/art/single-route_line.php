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
				 echo $json_query_url;
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

$stop_table_url =  get_site_url().'/wp-content/transit-data/timetables/'.strtolower (str_replace(".", "",str_replace(" ", "_",get_the_title()))).'.html';
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


<script>


var route_ids_array = [<?php 
$id_count = 0;
foreach($route_ids as &$_route_id) {
echo $_route_id;
if($id_count < sizeof($route_ids)-1) {echo',';} 
$id_count ++;
}
 ?>]; 
 
var ZoomLevelThreshhold = 13;
var system_map = false;
console.log('just starting script');
var map_files_base = "<?php echo get_site_url() ?>/wp-content/themes/art/";
//console.log('just starting script');
L.mapbox.accessToken = 'pk.eyJ1IjoidHJpbGxpdW10cmFuc2l0IiwiYSI6ImVUQ2x0blUifQ.2-Z9TGHmyjRzy5GC1J9BTw';
var map = L.mapbox.map('route-map', 'trilliumtransit.e8e8e512', { zoomControl: false });
   
  map.scrollWheelZoom.disable();
   
   new L.Control.Zoom({ position: 'bottomright' }).addTo(map);
   
function load_data(url, dataType) {
			dataType = typeof dataType !== 'undefined' ? dataType : "json";
			var returned_data = null;
			$.ajax({
				'async': false,
				'global': false,
				'url': url,
				'dataType': dataType,
				'success': function (data) {
					returned_data = data;
				}
			});
			return returned_data;
		}
function load_data_async(url, dataType, baseUrl, successResponse) {
    dataType = typeof dataType !== 'undefined' ? dataType : null;
    baseUrl = typeof baseUrl !== 'undefined' ? baseUrl : null;
    dataType = dataType !== null ? dataType : "json";
    baseUrl = baseUrl !== null ? baseUrl : map_app_base;
    var returned_data = null;
    successResponse = successResponse !== null ? successResponse : function(data){
        returned_data = data;
    };
    //console.log(baseUrl + url);
    $.ajax({
        'global': false,
        'url': baseUrl + url,
        'dataType': dataType,
        'success': successResponse
    });
    return returned_data;
}
if (route_ids_array.length == 1) {route_ids_list = route_ids_array[0];}
else {var route_ids_list = route_ids_array.join();}
var stops_layer_group = L.featureGroup();
var stops = Array();
var StopIcons = Array();
var route_colors = Array();
var stop_markers = Array();
var default_icon_color = '575757';
var routes = Array();
var route_feature_group = new L.FeatureGroup();
var routes_active = Array();
var route_styles = Array();
var route_layers = Array();
// define the StopIcon
var StopIcon = L.Icon.extend({
    options: {
        iconSize: [12, 12],
        iconAnchor: [6, 6],
        popupAnchor: [0, 0]
    }
});
var api_base_url = 'http://archive.oregon-gtfs.com/gtfs-api/';
// Load an object with the routes
function load_routes() {
	var load_data_url = generate_proxy_url(api_base_url+'routes/by-feed/anaheim-new-ca-us/route-id/'+route_ids_list);
	
	//console.log(load_data_url);
	//console.log('just before load_data (load routes)');
    routes = load_data(load_data_url);
	//console.log('routes: '+routes);
}
// old junk, but i am keeping this note around for now -- alternative way of getting an array with unique values
// from http://stackoverflow.com/questions/1960473/unique-values-in-an-array
function isInArray(value, array) {
  return array.indexOf(value) > -1;
}
// go back to this
function stop_icons() {
	
	//console.log("doin' the stop_icons thing");
	
    for (var i = 0; i < routes.length; i++) {
    	if (!isInArray(routes[i].route_color,route_colors)) {
    		route_colors.push(routes[i].route_color);
		    }
        }
		StopIcons[default_icon_color] = new StopIcon({iconUrl:map_files_base+"create_image.php?r=12&bw=3&&bc=ffffff&fg="+default_icon_color});
        for (var i = 0; i < route_colors.length; i++) {
                StopIcons[route_colors[i]] = new StopIcon({iconUrl:map_files_base+"create_image.php?r=12&bc=ffffff&fg="+route_colors[i]});
            }
	
	//console.log('route_colors: '+route_colors);
	
	}
function get_route_color_for_id(route_id_lookup) {
var result = get_route_info_for_id(route_id_lookup).route_color;
return result;
}
function get_route_info_for_id(route_id_lookup) {
var result;
for(var route_i = 0; route_i < routes.length; route_i++) {
    if( routes[route_i].route_id === route_id_lookup ) {
        result = routes[route_i];
        break;
    }
}
return result;
}
function generate_proxy_url(url) {
    return url;
	} 
/*pushing items into array each by each and then add markers*/
// console.log('just before defining load_stop_markers');
function load_stop_markers() {
    // if the map has the stops_layer_group, get rid of it
    if (map.hasLayer(stops_layer_group)) {
        map.removeLayer(stops_layer_group);
    }
    // clear out the current stops array
    // stops_layer_group = L.layerGroup();
		
	var load_data_url = generate_proxy_url(api_base_url+'stops/by-feed/anaheim-new-ca-us/route-id/'+route_ids_list);
	//console.log('just before load_data');
    //  async approach
    load_data_async(load_data_url, null,'', function(data){
    
    //console.log(data);
	
	stop_icons();
	
		//console.log('load_data_was_fired');
        stops = data;
        //console.log(stops);
        if (stops !== null) {
            for (var i = 0; i < stops.length; i++) {
					
					if (stops[i].routes.length > 1) {
						stops[i].color ='575757';
					}
					else {
						//console.log(stops[i].routes[0].route_id);
						stops[i].color = get_route_color_for_id(stops[i].routes[0].route_id);
						//console.log('stops['+i+'].color: '+stops[i].color);
					}
                    
                
                var LamMarker = new L.marker([stops[i].geojson.coordinates[1], stops[i].geojson.coordinates[0]], {
                    icon: StopIcons[stops[i].color]
                }).bindPopup('', {maxWidth: 400});
                
                
                LamMarker.stop_id = stops[i].stop_id;
                LamMarker.marker_id = i;
                LamMarker.stop_name = stops[i].stop_name;
                LamMarker.stop_code = stops[i].stop_code;
                LamMarker.on('click', update_stop_info);
                LamMarker.on('popupclose', close_popup_update_map);
				
				//console.log(LamMarker);
				
				//console.log(LamMarker.getLatLng());
                stop_markers.push(LamMarker);
                stops_layer_group.addLayer(stop_markers[i]);
            }
        }
        map.addLayer(stops_layer_group);
        
        if (system_map) {
			 map.fitBounds([
				[33.797984, -117.924412],
				[33.813340, -117.909644]
			]);
        }
        else {
	        map.fitBounds(stops_layer_group.getBounds());
	        }
        
    });
}
function encapsulate_in_array(variable) {
	if (Array.isArray(variable)) {return variable;}
	else {
		var new_array = Array();
		new_array.push(variable);
		return new_array;
		}
	}	
function highlight_route_alignment(route_ids) {
		
		route_ids = encapsulate_in_array(route_ids);
		console.log('highlight_route_alignment. route_ids: '.route_ids);
		
		if (system_map) {add_route_alignment(route_ids);}
	    for (var i = 0, len = route_ids.length; i < len; i++) {
			console.log('highlight this alignment: '+route_ids[i]);
			var route_id = parseInt(route_ids[i]);
	    	if (routes_active.indexOf(route_id) > -1) {
				route_layers[route_id].bringToFront();
				route_layers[route_id].setStyle(route_styles[route_id][1]);
		    }
	    }
}
function unhighlight_route_alignment(route_ids) {
		route_ids = encapsulate_in_array(route_ids);
		
		if (system_map) {remove_route_alignment(route_ids);}
	    for (var i = 0, len = route_ids.length; i < len; i++) {
	    	var route_id = parseInt(route_ids[i]);
		    route_layers[route_id].setStyle(route_styles[route_id][0]);
	    }
}
function update_stop_info(e) {
var popup_content = '<h3 class="stop_name">'+e.target.stop_name+'</h3>';
if (e.target.stop_code != '') {
	popup_content = popup_content+ '<p>text2go code: '+e.target.stop_code+'</p>';
}
var route_ids_array = get_routes_for_stop_id(e.target.stop_id);
highlight_route_alignment(route_ids_array);
console.log(routes);
console.log(route_ids_array);
for (var i = 0, len = route_ids_array.length; i < len; i++) {
	// console.log(route_ids_array[i]);
	
	var route_info = get_route_info_for_id(route_ids_array[i]);
	console.log(route_info);
	popup_content = popup_content + '<div class="route_short_name" style="display:inline-block;margin-right:8px;padding:3px;margin:3px;font-weight:bold;font-size:14pt;color:'+route_info.route_text_color+';background-color:#'+route_info.route_color+'">'+route_info.route_short_name+'</div>';
	
}
e.target.setPopupContent(popup_content);
}
function close_popup_update_map(e) {
var route_ids_array = get_routes_for_stop_id(e.target.stop_id);
unhighlight_route_alignment(route_ids_array);
}
load_routes();
//console.log('just before calling load_stop_markers');
load_stop_markers();
// Adding alignments
function get_routes_array_index_from_id(id) {
    var index = -1;
    for (var i = 0, len = routes.length; i < len; i++) {
        if (routes[i].route_id == id) {
            index = i;
            // console.log(index);
            break;
        }
    }
    return index;
}
function get_stops_array_index_from_id(id) {
    var index = -1;
    for (var i = 0, len = stops.length; i < len; i++) {
        if (stops[i].stop_id == id) {
            index = i;
            // console.log(index);
            break;
        }
    }
    return index;
}
function get_routes_for_stop_id(stop_id) {
	
	var stops_array_index = get_stops_array_index_from_id(stop_id);
	var specific_routes = stops[stops_array_index].routes;
	var route_ids_array = Array();
	
    for (var i = 0, len = specific_routes.length; i < len; i++) {
       route_ids_array.push(specific_routes[i].route_id);
    }
    return route_ids_array;
}
var unhighlighted_weight = 5;
var highlighted_weight = 10;
function add_route_alignment(ids) {
		
	    for (var i = 0, len = ids.length; i < len; i++) {
	    	var id = ids[i];
	    if (typeof route_layers[id] == 'undefined' || route_layers[id] == null) {
	    
			var index = get_routes_array_index_from_id(id);
			var geojson = routes[index].shared_arcs_geojson;
					route_styles[id] = [];
					
					
					route_styles[id][0] = {
						"color": '#' + routes[index].route_color,
						"weight": unhighlighted_weight,
						"opacity": 1,
						// "dashArray": [10,10],
						"clickable": true
					};
					
					route_styles[id][1] = {
						"color": '#' + routes[index].route_color,
						"weight": highlighted_weight,
						"opacity": 1,
						// "dashArray": [10,10],
						"clickable": true
					};
					route_layers[id] = L.geoJson(geojson, {
						style: route_styles[id][0]
					});
	    }
	        route_layers[id].addTo(map);
	    if (routes_active.indexOf(parseInt(id)) == -1) {
	        routes_active.push(parseInt(id));
	        // console.log('adding route_id '+id+' to routes_active');
	    }
	}
}
function remove_route_alignment(ids) {
	ids = encapsulate_in_array(ids);
   for (var i = 0, len = ids.length; i < len; i++) {
	   	var id = ids[i];
    map.removeLayer(route_layers[id]);
    remove_from_array(id, routes_active);
}
}
function get_index(value, array) {
	var index = array.indexOf(parseInt(value));
	return index;
}
function remove_from_array(value, array) {
    var index = get_index(value, array);
    if (index > -1) {
        array.splice(index, 1);
    }
}
var topPane;
var topLayer;
var route_alignments_tiles = 'trilliumtransit.fbf63437';
var tile_layer = new Array();
tile_layer[0] = new L.tileLayer('http://{s}.tiles.mapbox.com/v3/' + route_alignments_tiles + '/{z}/{x}/{y}.png');
// tile_layer[1] = new L.tileLayer('http://{s}.tiles.mapbox.com/v3/'+map_id_labels+'/{z}/{x}/{y}.png');
function add_tile_layer(layer_id,z_index) {
	if (typeof (tile_layer[layer_id]) != "undefined") {
		//console.log(tile_layer[layer_id]);
		topLayer = tile_layer[layer_id].addTo(map);
//		topPane.appendChild(topLayer.getContainer());
		topLayer.setZIndex(z_index);
	}
}
if (system_map) {
	add_tile_layer(0,5);
}
else {add_route_alignment(route_ids_array);}
var landmarks = Array();
var landmark_icons = Array();
// var landmarks_csv;
// var icons_csv;
function get_icon_index_for_icon(icon_id) {
var result;
for(var i = 0; i < landmark_icons.length; i++) {
    if( landmark_icons[i].id === icon_id ) {
        result = i;
        break;
    }
}
return result;
}
$.ajax({
    url: map_files_base+"icons.csv",
    async: false,
    success: function (csvd) {
        landmark_icons =  $.csv.toObjects(csvd);
    },
    dataType: "text"
});
var landmark_markers = Array();
var zoom_icon_scale = Array();
zoom_icon_scale[12] = .25;
zoom_icon_scale[13] = .3;
zoom_icon_scale[14] = .35;
zoom_icon_scale[15] = .6;
zoom_icon_scale[16] = 1;
zoom_icon_scale[17] = 1;
zoom_icon_scale[18] = 1;
zoom_icon_scale[19] = 1;
$.ajax({
    url: map_files_base+ "landmarks.csv",
    async: true,
    success: function (csvd) {
        
        var landmarks_array_temp =  $.csv.toObjects(csvd);
        
        console.log(landmarks_array_temp);
        
        for (var i = 0, len = landmarks_array_temp.length; i < len; i++) {
        
        console.log(landmarks_array_temp[i].landmark_id);
        
        landmarks[landmarks_array_temp[i].landmark_id] = {};
        
        landmarks[landmarks_array_temp[i].landmark_id].landmark_name = landmarks_array_temp[i].landmark_name;
        landmarks[landmarks_array_temp[i].landmark_id].category_name = landmarks_array_temp[i].category_name;
        landmarks[landmarks_array_temp[i].landmark_id].landmark_url = landmarks_array_temp[i].landmark_url;
		var landmark_lat_temp = landmarks_array_temp[i].lat;
        landmarks[landmarks_array_temp[i].landmark_id].lat = landmark_lat_temp;
		var landmark_lon_temp = landmarks_array_temp[i].lon;
        landmarks[landmarks_array_temp[i].landmark_id].lon = landmark_lon_temp;
        landmarks[landmarks_array_temp[i].landmark_id].icon_id = landmarks_array_temp[i].icon_id;
        
        var icon_index = get_icon_index_for_icon(landmarks_array_temp[i].icon_id);
        
        if (typeof icon_index !== 'undefined') {
        
        landmarks[landmarks_array_temp[i].landmark_id].icon_index = icon_index;
		console.log(icon_index);
        var width = landmark_icons[icon_index].width;
        var height = landmark_icons[icon_index].height;
        var filename = landmark_icons[icon_index].filename;
        var landmark_id = landmarks_array_temp[i].landmark_id;     
        
        // var current_zoom = map.getZoom();
		console.log('current_zoom: '+map.getZoom());
        
        create_landmark_marker(i,width,height,landmark_id,icon_index,landmark_lat_temp,landmark_lon_temp,filename);
        
        }
        
		
		}
		
		},
    dataType: "text"
		
});
function create_landmark_marker(i,width,height,landmark_id,icon_index,landmark_lat,landmark_lon,filename) {
console.log('icon_index: '+icon_index);
var zoom_level_icon = landmark_icon(width,height,icon_index,filename);
		landmark_markers[i] = L.marker([landmark_lat, landmark_lon], {icon: zoom_level_icon});
		landmark_markers[i].landmark_id = landmark_id;
		landmark_markers[i].addTo(map);
}
function landmark_icon(width,height,icon_index,filename) {
	var current_zoom = map.getZoom();
	if(typeof current_zoom == 'undefined'){current_zoom = 15;}
	console.log('current_zoom: '+current_zoom);
	
	if (typeof landmark_icons[icon_index].icons == 'undefined') {
		landmark_icons[icon_index].icons = [];
		}
	
	if (typeof landmark_icons[icon_index].icons[current_zoom] == 'undefined') {
	
	landmark_icons[icon_index].icons[current_zoom] = {};
	
	console.log('height: '+height);
	console.log('width: '+width);
	var scaled_width = zoom_icon_scale[current_zoom] * width;
	var scaled_height = zoom_icon_scale[current_zoom] * height;
	console.log('scaled_width: '+scaled_width);
	console.log('scaled_height: '+scaled_height);
	landmark_icons[icon_index].icons[current_zoom] = new L.Icon({ 
		iconUrl: map_files_base+'map_icons/'+filename,
		iconSize: [scaled_width, scaled_height],
		iconAnchor: [scaled_width/2, scaled_height/2]
		});
		
	}
	console.log(landmark_icons[icon_index].icons[current_zoom]);
	
	return landmark_icons[icon_index].icons[current_zoom];
}
function change_landmark_sizes() {
	
	console.log('change_landmark_sizes happened.');
    for (var i = 0; i < landmark_markers.length; i++) {
    	if (typeof landmark_markers[i] !== 'undefined') {
			var landmark_id = landmark_markers[i].landmark_id;
			var icon_index = landmarks[landmark_id].icon_index;
			console.log ('icon_index: '+icon_index);
			var height = landmark_icons[icon_index].height;
			console.log ('height: '+height);
			var width = landmark_icons[icon_index].width;
			var filename = landmark_icons[icon_index].filename;
			landmark_markers[i].setIcon(landmark_icon(width,height,icon_index,filename));
    	}
    }
}
function toggle_stop_visibility() {
    if (map.getZoom() < ZoomLevelThreshhold && map.hasLayer(stops_layer_group)) {
        map.removeLayer(stops_layer_group);
    }
    if (map.getZoom() >= ZoomLevelThreshhold && map.hasLayer(stops_layer_group) == false) {
        load_stop_markers();
    }
}
map.on('load',  function() {
map.on('zoomend', function() {
	console.log('zoomend happened.');
    change_landmark_sizes();
    toggle_stop_visibility();
});
});
     	
     	// http://jsfiddle.net/7go98fe4/
     	   
 
// Object
// height: "184"
// id: "downtown_disney_district"
// landmark_id: ""
// width: "190"
// x: "248"
// y: "16"
// __proto__: Object

</script>
<?php get_footer(); 




?>