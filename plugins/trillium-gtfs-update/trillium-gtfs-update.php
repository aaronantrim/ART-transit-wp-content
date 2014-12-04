<?php
/**
 * Plugin Name: Trillium Transit GTFS Site updater
 * Plugin URI: 
 * Description: Updates the sites routes, schedule information, and sets up live data updating using Clever Devices info
 * Version: 1.0
 * Author: Paul Clay
 */
 
 
 function trillium_gtfs_update_install () {
   global $wpdb;

$charset_collate = $wpdb->get_charset_collate();

$sql = "

DROP TABLE IF EXISTS
    stop_names;

CREATE TABLE stop_names (
stop_id INT(32),
stop_name MEDIUMTEXT,
latitude INT(32),
longitude INT(32),
route_ids MEDIUMTEXT,
RID int(11) NOT NULL auto_increment,
primary KEY (RID)) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}
 

// create custom plugin settings menu
add_action('admin_menu', 'trillium_gtfs_update_create_menu');

function trillium_gtfs_update_create_menu() {

	//create new top-level menu
	add_menu_page('GTFS Site Update', 'GTFS Update', 'administrator', __FILE__, 'trillium_gtfs_update_settings_page', plugins_url('trillium-gtfs-update/images/icon.png',  __FILE__));
	
}






function trillium_gtfs_update_settings_page() {
?>
<div class="wrap">
<h2>GTFS Site Update</h2>
<?php
	echo '<h2>GTFS update - uses the trillium GTFS api to sync site to live data</h2>';
	
	echo 'This pulls data from the gtfs api to update the site, only do this, while it should update smoothly, you should always make a backup before doing this. ';
	
	echo "<h3>If you want to update the site, you need to add &update=true to the end of the url.  <br/><strong>DO NOT DO THIS IF YOU ARE UNSURE YOU?RE DOING THE RIGHT THING!!</strong></h3>";
	
	if($_GET["update"] == "true") {
		
		/*echo '<br /><br />updating';
		
		echo getcwd();
		
		echo 'br/>';
		
		include get_template_directory().'/library/php/simple_html_dom.php';
		
		
		$clever_deviced_json = file_get_contents('http://96.10.227.28/art/packet/json/shelter');
		$json = json_decode($clever_deviced_json );
		
		
		foreach($json->ShelterArray as &$shelter) {
			echo '<br /><br /><br />';
			$web_label_html = str_get_html($shelter->Shelter->WebLabel);
			echo $web_label_html->find('.labelShelterArrivalRowOdd')[0];
			//echo $shelter->Shelter->WebLabel;
			//echo trim(preg_replace('/<[^>]*>/', '****',$shelter->Shelter->WebLabel));
		}
		
			//print_r($json);*/
			
			
		
		
		// load
		
		$existing_route_lines = get_posts(array(
			'numberposts' => -1,
			'post_type' => 'route_line',
		));
		
		foreach($existing_route_lines as &$route_line) {
			echo "route lines reset.<br />";
			wp_delete_post( $route_line->ID, true );
			
		}
		
	
		
		$handle = fopen(get_site_url()."/wp-content/transit-data/route_lines.ssv", "r"); 
	
		if ($handle) {
			echo 'sdf';
			$lineCount = 0;
			 while (($line = fgets($handle)) !== false) {
			
				if($lineCount > 0) {
			
					//echo $line;
					echo "<br/>.";
			
					$splitLine = explode("\\", $line);
					$route_line_id = $splitLine[0];
					$line_name = $splitLine[1];
					$street_description = $splitLine[2];
					$routes = $splitLine[3];
					$color = $splitLine[4];
					$frequency = $splitLine[5];	
					
					
					$my_post = array(
					  'post_title'    => $line_name,
					  'post_name' => $line_name,
					  'post_status'   => 'publish',
					  'post_type'      => 'route_line',
					  'post_author'   => 1
						);
	
						// Insert the post into the database
						$post_to_update_id = wp_insert_post( $my_post );
						update_field('field_547f89dd6be2a', $route_line_id, $post_to_update_id);
						update_field('field_547f8a016be2c', $street_description, $post_to_update_id );
						update_field('field_547f8a196be2d', $routes, $post_to_update_id );
						update_field('field_547f8a1e6be2e', $color, $post_to_update_id );
						update_field('field_547f8a5a6be2f', $frequency, $post_to_update_id );
				}
				$lineCount ++;
			}
		}
	
	}
?>
</div>
<?php


 } 
 
 
 
 
 ?>