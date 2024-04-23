<?php
// Database connection
$servername = "sql201.infinityfree.com";
$user = "if0_36400948";
$pass = "5f48url9Y5HSfK";
$dbname = "if0_36400948_coffeeshop_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch feedback data
try {
    $query = "SELECT * FROM tblfeedback";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $feedbackData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($feedbackData);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>