<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Authenticator;

$db = App::resolve('Core\Database');

$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$errors = [];

if (!Validator::email($email)) {
  $errors['email'] = "Please provide a valid email.";
}

if (!Validator::string($password, 7, 255)) {
  $errors['password'] = "Please provide a password of at least 7 characters.";
}

if (!empty($errors)) {
  return view('/register', [
    'heading' => 'Register',
    'errors' => $errors,
  ]);
}

$user = $db->query("SELECT * FROM tblemployees where email = :email", ['email' => $email])->find();

if ($user) {
  // User already exists
  echo "<script>
            alert('Registration Failed: User with this email already exists.');
            window.location.href = '/'; // Redirect to index page
          </script>";
} else {
  // Register the user
  $db->query("INSERT INTO tblemployees(firstname, lastname, email, username, password) VALUES(:firstname, :lastname, :email, :username, :password)", [
    'firstname' => $first_name,
    'lastname' => $last_name,
    'email' => $email,
    'username' => $username,
    'password' => password_hash($password, PASSWORD_BCRYPT),
  ]);

  // No need to authenticate user here since this is registration, not login

  echo "<script>
            alert('Registration Successful: You have successfully registered.');
            window.location.href = '/'; // Redirect to login page
          </script>";
}
