<?php

$arrival_date = '';
$one_day_adult = '';
$one_day_child = '';
$three_day_adult = '';
$three_day_child = '';
$five_day_adult = '';
$five_day_child = '';
$one_day_disabled = '';
$three_day_disabled = '';
$five_day_disabled = '';
$delivery_select = '';

function greater_than_zero($n) {
	$return_value = false;
	if (is_numeric($n)) {
		if ($n > 0) {$return_value = true;}	
	}
	return $return_value;
}

$products_array = Array();

if (isset($_POST['arrival_date'])) {$arrival_date=$_POST['arrival_date'];}
if (isset($_POST['one_day_adult'])) {$one_day_adult=$_POST['one_day_adult'];}
if (isset($_POST['one_day_child'])) {$one_day_child=$_POST['one_day_child'];}
if (isset($_POST['three_day_adult'])) {$three_day_adult=$_POST['three_day_adult'];}
if (isset($_POST['three_day_child'])) {$three_day_child=$_POST['three_day_child'];}
if (isset($_POST['five_day_adult'])) {$five_day_adult=$_POST['five_day_adult'];}
if (isset($_POST['five_day_child'])) {$five_day_child=$_POST['five_day_child'];}
if (isset($_POST['one_day_disabled'])) {$one_day_disabled=$_POST['one_day_disabled'];}
if (isset($_POST['three_day_disabled'])) {$three_day_disabled=$_POST['three_day_disabled'];}
if (isset($_POST['five_day_disabled'])) {$five_day_disabled=$_POST['five_day_disabled'];}
if (isset($_POST['delivery_select'])) {$delivery_select=$_POST['delivery_select'];}

// echo $arrival_date;
// echo $one_day_adult;
// echo $one_day_child;
// echo $three_day_adult;
// echo $three_day_child;
// echo $five_day_adult;
// echo $five_day_child;
// echo $one_day_disabled;
// echo $three_day_disabled;
// echo $five_day_disabled;
// echo $delivery_select;

if (greater_than_zero($one_day_adult)) { array_push($products_array, '1055131168' . ':' . $one_day_adult);}
if (greater_than_zero($one_day_child)) { array_push($products_array, '1056671696' . ':' . $one_day_child);}
if (greater_than_zero($three_day_adult)) { array_push($products_array, '1055144832' . ':' . $three_day_adult);}
if (greater_than_zero($three_day_child)) { array_push($products_array, '1055145744' . ':' . $three_day_child);}
if (greater_than_zero($five_day_adult)) { array_push($products_array, '1055157840' . ':' . $five_day_adult);}
if (greater_than_zero($five_day_child)) { array_push($products_array, '1055157844' . ':' . $five_day_child);}
if (greater_than_zero($one_day_disabled)) { array_push($products_array, '1056706348' . ':' . $one_day_disabled);}
if (greater_than_zero($three_day_disabled)) { array_push($products_array, '1056707076' . ':' . $three_day_disabled);}
if (greater_than_zero($five_day_disabled)) { array_push($products_array, '1056707744' . ':' . $five_day_disabled);}

if ($delivery_select != 0) { array_push($products_array,$delivery_select.':1');}

$cart_redirect = 'http://store.rideart.org/cart/' . implode(",",$products_array);
if ($arrival_date) { $cart_redirect .= '?attributes[arrival-date]='.$arrival_date;}

// var_export($products_array);

// echo $cart_redirect;

header("Location: $cart_redirect");
// die();

?>