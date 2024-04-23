<?php 

use Core\App;
use Core\Database;
$db = App::resolve('Core\Database');

$online_orders = $db->query("SELECT * FROM tbluser JOIN tblorders ON customer_id = id JOIN tblproducts ON product_id = base_coffee_id ")->get();

view('pos/online_orders.view.php', [
   'online_orders' => $online_orders
]);