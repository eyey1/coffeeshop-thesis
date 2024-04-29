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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if the necessary POST data is set
  if (isset($_POST['order_type'], $_POST['base_coffee_id'], $_POST['base_coffee'])) {
    $orderType = $_POST['order_type'];
    $baseCoffeeId = $_POST['base_coffee_id'];
    $baseCoffeeName = $_POST['base_coffee'];

    // Initialize the cart if it's not already set
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
    }

    $found = false;
    // Loop through the cart to find the product
    foreach ($_SESSION['cart'] as &$item) {
      if ($item['base_coffee_id'] == $baseCoffeeId) {
        // If the product exists, increase the quantity by one
        $item['quantity'] += 1;
        $found = true;
        break;
      }
    }

    // If the product is not found, add it to the cart with quantity 1
    if (!$found) {
      $_POST['quantity'] = 1; // Add quantity to the POST data
      $_SESSION['cart'][] = $_POST;
    }
    header('location: /menu');
    die();
  }
}

// if (empty($errors)) {
//   $_SESSION['cart'][] = $_POST;
//   // $db->query("INSERT INTO tblorders(order_type, base_coffee_id, customer_id) VALUES(:order_type,:base_coffee_id, :customer_id)", ['order_type'=> $_POST['order_type'],'base_coffee_id' => $_POST['base_coffee_id'] ,'customer_id' => $_SESSION['user']['id']]);
// }
