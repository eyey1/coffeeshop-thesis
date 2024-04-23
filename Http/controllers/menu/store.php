<?php 
use Core\App;
use Core\Database;
use Core\Validator;
$db = App::resolve('Core\Database');

  // dd($_POST);

  $errors = [];

  // if (! Validator::checkbox($category)) {
  //   $errors['category'] = "A body of no more than 50 characters is required.";
  // }

  // if (! empty($errors)) {
  //   return view('menu.view.php', [
  //     'errors' => $errors,
  //   ]);
  // }

// dd($_SESSION);

  if (empty($errors)) {
      $_SESSION['cart'][] = $_POST;
      //$db->query("INSERT INTO tblorders(order_type, base_coffee_id, customer_id) VALUES(:order_type,:base_coffee_id, :customer_id)", ['order_type'=> $_POST['order_type'],'base_coffee_id' => $_POST['base_coffee_id'] ,'customer_id' => $_SESSION['user']['id']]);
  }


  header('location: /menu');
  die();
