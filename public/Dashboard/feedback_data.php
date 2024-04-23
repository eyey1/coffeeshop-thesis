<?php
// Database connection
$servername = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "dbcoffee_shop";

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