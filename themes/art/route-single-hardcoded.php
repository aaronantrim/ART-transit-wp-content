<?php
/*
Template Name: route_individual_page_hardcoded
*/
 get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">
			
<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
<?php the_breadcrumb() ?>
<div id="generic-wide-container-top"></div>
<div id="generic-wide-container">

<div id="route-icons-and-header">
	<i class="route-1-icon-large route-icon-large first"></i>
	<i class="route-2-icon-large route-icon-large item-num-2 last"></i>
	<h2 id="route-title"><?php the_title(); ?> <br />HARBOR BLVD. LINE (via Harbor Blvd.) </h2>
	<br style="clear:both;" />
</div><!-- end #route-icons-and-header -->
<div class="route-divider"></div>
<div id="frequency-and-times">
	<ul>
		<li class="first item-num-0">
			<i id="clock-icon"></i>Frequency: Every 20 minutes
		</li>
		<li class="item-num-1">
			First bus today: 7:30 AM
		</li>
		<li class="last item-num-2">
			Last bus today: 9:30 AM
		</li>
	</ul>
</div><!-- #end frequency-and-times -->
<div class="route-divider"></div>
<div id="route-arrivals">
<div id="arrival-text">Next estimated arrivals at your current location:&nbsp; <strong>Disneybound: 3:35 PM</strong>, &nbsp;<strong>Outbound: 3:42 PM</strong> </div>
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

<div id="route-alerts"><ul>
										
											
												<li  class="minimized">
												<h3 class="route-alert-header <?php if($alertCount > 0) echo 'not-first'; ?>"><i id="alert-icon-black"></i>Service Alert: Huge Traffic Jam All At All times<span id="alert-click-message">Click to Expand</span></h3>  
												<div id="alert-content" style="display:none;">
												Not enough people taking the bus today!
												<div id="route-alert-link">
													<a href="#">Go to Alert Page >></a>
												</div><!-- end #route-alert-link -->
												
												</div><!-- end #alert-content -->
												</li>
											
									
									</ul></div><!-- end #route-alerts -->


			
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
<div id="route-map">

</div><!-- end #route-map -->

<script>
L.mapbox.accessToken = 'pk.eyJ1IjoidHJpbGxpdW10cmFuc2l0IiwiYSI6ImVUQ2x0blUifQ.2-Z9TGHmyjRzy5GC1J9BTw';
var map = L.mapbox.map('route-map', 'trilliumtransit.e8e8e512', { zoomControl: false })
   .setView([33.8044,-117.9181], 13);
   
   map.scrollWheelZoom.disable();
   
   new L.Control.Zoom({ position: 'topright' }).addTo(map);
   
   
   /*******/
      
    
   
  function load_data(url, dataType, async) {
			dataType = typeof dataType !== 'undefined' ? dataType : "json";
			async = typeof async !== 'undefined' ? async : false;

			var returned_data = null;
			$.ajax({
				'async': async,
				'global': false,
				'url': url,
				'dataType': dataType,
				'success': function (data) {
					returned_data = data;
				}
			});
			return returned_data;
		}

var geojson;
var line_style = {
			fill: true,
			color: '#fd681e',
			opacity: 1,
			fillOpacity: 0,
			weight:5,
			pointerEvents: null
			// dashArray: dashes
			};

var route_feature_group = new L.FeatureGroup();

route_geojson = L.geoJson(load_data('<?php get_site_url();?>/art/wp-content/transit-data/json/rt1-2.json'), 
	 							{style: line_style}).addTo(map);
route_feature_group.addLayer(route_geojson); 

map.fitBounds(route_feature_group.getBounds());


route_geojson = load_data('<?php get_site_url();?>/art/wp-content/transit-data/json/routes-1-2-stops.json');

var geojsonMarkerOptions = {
    radius: 5,
    fillColor: "#fff",
    color: "#fd681e",
    weight: 2,
    opacity: 1,
    fillOpacity: 1
};

L.geoJson(route_geojson, {
    pointToLayer: function (feature, latlng) {
        return L.circleMarker(latlng, geojsonMarkerOptions);
    }
}).addTo(map);
   
</script>
<?php get_footer(); 




?>