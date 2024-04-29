<?php

use Core\App;
use Core\Database;

$db = App::resolve('Core\Database');

$online_orders = $db->query("SELECT * FROM tblemployees JOIN tblorders ON employeeID = customer_id  JOIN tblproducts ON base_coffee_id = product_id")->get();

view('pos/online_orders.view.php', [
   'online_orders' => $online_orders
]);
