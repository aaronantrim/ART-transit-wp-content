<html>

<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='http://code.jquery.com/jquery-1.11.1.min.js'></script>
<script src='https://api.tiles.mapbox.com/mapbox.js/v2.0.0/mapbox.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox.js/v2.0.0/mapbox.css' rel='stylesheet' />
<style>
  body { margin:0; padding:0; }
  #map { width:100%; height: 500px;}
</style>
</head>
<body>
<div id='map'></div>
<script>


L.mapbox.accessToken = 'pk.eyJ1IjoidHJpbGxpdW10cmFuc2l0IiwiYSI6ImVUQ2x0blUifQ.2-Z9TGHmyjRzy5GC1J9BTw';
var map = L.mapbox.map('map', 'trilliumtransit.j3p18nh0', {touchZoom:false, scrollWheelZoom:false});


		// set map styles
		// var dashes = '8, 12';

		var default_style = {
			fill: true,
			clickable: true,
			fillOpacity: 0.5,
			weight:5,
			pointerEvents: null
			// dashArray: dashes
			};

		
		// is this necessary
		map._layersMinZoom=map.getZoom();

		
		
		// set up load data function
		// borrowed from stackoverflow.com/questions/2177548/load-json-into-variable
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
		

var base_json_url = 'dar-json/';


<?php 

$dar_areas_array = array (

array("Mojave Dial-A-Ride", "East Kern", "Monday thru Saturday", "7:00 AM to 6:00 PM", "dial-mojave", "e0871b", "dial-mojave.json",""),
array("Rosamond Dial-A-Ride", "East Kern", "Monday thru Saturday", "6:30 AM to 5:30 PM", "dial-rosamond", "e0871b", "dial-rosamond.json",""),
array("Tehachapi Dial-A-Ride", "East Kern", "Monday thru Saturday", "5:45 AM to 7:00 PM (Monday-Friday)\r7:30 AM to 5:30 PM (Saturday)", "dial-tehachapi", "e0871b", "dial-tehachapi.json",""),
array("Frazier Park Dial-A-Ride", "Frazier Park", "Monday thru Saturday", "7:15 AM to 5:15 PM", "dial-frazier-park", "25639e", "dial-frazier-park.json","Cuddy Valley, Pinon Pines, Gorman, Lake of the Woods, Lebec, Frazier Park"),
array("Kern River Valley Dial-A-Ride", "Kern River Valley", "Monday thru Saturday", "6:30 AM to 6:30 PM (Monday thru Friday)\r7:45 AM to 6:30 PM (Saturday)", "dial-kern-river-valley", "ed1846", "dial-kern-river-valley.json","Onyx, Riverkern/Kernville North, Kelso Valley, Hillview Acres, Southlake, Mountain Mesa, Bodfish, Lake Isabella, Wofford Heights"),
array("Lamont Dial-A-Ride", "Lamont Area", "Monday thru Sunday", "4:30 AM to 7:00 PM (Monday thru Friday)\r5:30 AM to 7:00 PM (Saturday)\r7:00 AM to 8:00 PM (Sunday)", "dial-lamont", "570961", "dial-lamont.json",""),
array("Lost Hills Dial-A-Ride", "North Kern", "Thursday and Saturday Only", "No hours provided - requires prior day reservation", "dial-lost-hills", "7c51a1", "dial-lost-hills.json","")

);

$the_dar = $_GET['dar'];

foreach ($dar_areas_array as &$value) {
	// echo $value[4];
    if ($value[4] == $the_dar) {$the_dar_info = $value;}
}



echo 'var dar_areas_array = new Array(', json_encode($the_dar_info), ');';


?>



var dar_geojson = new Array();
var dar_styles = new Array();
var dar_areas_group = new L.FeatureGroup();


var dar_areas_arrayLength = dar_areas_array.length;
for (var i = 0; i < dar_areas_arrayLength; i++) {
	 
	 dar_styles[i] = $.extend({}, default_style); // Make a simple clone (jQuery)
	 dar_styles[i].color = '#'+dar_areas_array[i][5];
	 dar_styles[i].fillColor = '#'+dar_areas_array[i][5];
	 
	 dar_geojson[i] = L.geoJson(load_data(base_json_url + dar_areas_array[i][6]), {style: dar_styles[i]}).addTo(map);
	 dar_areas_group.addLayer(dar_geojson[i]);

		
}
		
	map.fitBounds(dar_areas_group.getBounds());

	function highlight_dar(dar_id) {
	
	var highlight_style = {
		color: '#'+dar_areas_array[dar_id][5],
		fillColor: '#'+dar_areas_array[dar_id][5],
		fill: true,
		fillOpacity: 0.7,
		weight:20
		};
	
	dar_geojson[dar_id].setStyle(highlight_style);
	}
	
	function unhighlight_dar(dar_id) {
	
	dar_geojson[dar_id].setStyle(dar_styles[dar_id]);
	}


</script>

<div id="key">

</div>

<script>


$( document ).ready(function() {

for (var i = 0; i < dar_areas_arrayLength; i++) {

$('#key').append( '<div id="'+dar_areas_array[i][4]+'_key" onmouseover="highlight_dar('+i+');" onmouseout="unhighlight_dar('+i+');" class="key-item" style="margin:20px;float:left;padding:10px;width:200px;border: 5px solid #'+dar_areas_array[i][5]+'"><h3>'+dar_areas_array[i][0]+'</h3><h4>'+dar_areas_array[i][2]+'</h4><p>'+dar_areas_array[i][7]+'</p><p>'+dar_areas_array[i][3]+'</p>' );
}

});



</script>



</body>
</html>