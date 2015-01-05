
function greater_than_zero(n) {
 var return_value = false;
 if (!isNaN(n)) {
   if (n > 0) {return_value = true;}	
 }
return return_value;
}
var products_array = Array();
var cart_redirect;
var one_day_adult_quantity;
var one_day_child_quantity;
var three_day_adult_quantity;
var three_day_child_quantity;
var five_day_adult_quantity;
var five_day_child_quantity;
var one_day_disabled_quantity;
var three_day_disabled_quantity;
var five_day_disabled_quantity;
$(document).ready(function(){
    $('.addtocart').click(function(e) {
products_array = [];
one_day_adult_quantity = $('#one_day_adult').val();
one_day_child_quantity = $("#one_day_child").val();
three_day_adult_quantity = $("#three_day_adult").val();
three_day_child_quantity = $("#three_day_child").val();
five_day_adult_quantity = $("#five_day_adult").val();
five_day_child_quantity = $("#five_day_child").val();
one_day_disabled_quantity = $("#one_day_disabled").val();
three_day_disabled_quantity = $("#three_day_disabled").val();
five_day_disabled_quantity = $("#five_day_disabled").val();
if (greater_than_zero(one_day_adult_quantity)) { products_array.push( '1055131168' + ':' + one_day_adult_quantity);}
if (greater_than_zero(one_day_child_quantity)) { products_array.push( '1056671696' + ':' + one_day_child_quantity);}
if (greater_than_zero(three_day_adult_quantity)) { products_array.push( '1055144832' + ':' + three_day_adult_quantity);}
if (greater_than_zero(three_day_child_quantity)) { products_array.push( '1055145744' + ':' + three_day_child_quantity);}
if (greater_than_zero(five_day_adult_quantity)) { products_array.push( '1055157840' + ':' + five_day_adult_quantity);}
if (greater_than_zero(five_day_child_quantity)) { products_array.push( '1055157844' + ':' + five_day_child_quantity);}
if (greater_than_zero(one_day_disabled_quantity)) { products_array.push( '1056706348' + ':' + one_day_disabled_quantity);}
if (greater_than_zero(three_day_disabled_quantity)) { products_array.push( '1056707076' + ':' + three_day_disabled_quantity);}
if (greater_than_zero(five_day_disabled_quantity)) { products_array.push( '1056707744' + ':' + five_day_disabled_quantity);}
if ($("#delivery-select") !== 0) { products_array.push( $("#delivery-select") );}
cart_redirect = 'http://store.rideart.org/cart/' + products_array.join();
console.log(cart_redirect);
if ($("#arrival_date") !== '') { cart_redirect += '?attributes[arrival_date]='+$("#arrival_date");}
// window.location.replace(cart_redirect);
});
});
