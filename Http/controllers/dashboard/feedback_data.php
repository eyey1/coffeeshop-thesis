<?php

// Database connection
$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "coffeeshop_db";


try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch feedback data
try {
    $query = "SELECT * FROM tblfeedback JOIN tblemployees WHERE customerid = employeeID";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $feedbackData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    dd($feedbackData);
    echo json_encode($feedbackData);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>