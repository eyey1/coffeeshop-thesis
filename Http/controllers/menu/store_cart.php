<?php 
use Core\App;
use Core\Database;
use Core\Validator;
$db = App::resolve('Core\Database');

foreach ($_SESSION['cart'] as $item) {
  $_POST = $item;

  $errors = [];

  if (empty($errors)) {
      $db->query("INSERT INTO tblorders(order_type, base_coffee_id, customer_id) VALUES(:order_type,:base_coffee_id, :customer_id)", ['order_type'=> $_POST['order_type'],'base_coffee_id' => $_POST['base_coffee_id'] ,'customer_id' => $_SESSION['user']['id']]);
    }
}

$_SESSION['cart'] = [];

  header('location: /menu');
  die();
