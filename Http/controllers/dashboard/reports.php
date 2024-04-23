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

// Sales report 
if (isset($_GET['get_sales_data'])) {
  try {
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
    $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;

    $query = "SELECT * FROM tblpayment WHERE 1";


    if ($filter === 'cash' || $filter === 'card') {
      $query .= " AND paymenttype = :payment_type";
    }

    if ($startDate && $endDate) {
      $query .= " AND DATE(order_datetime) BETWEEN :start_date AND :end_date";
    }

    $stmt = $pdo->prepare($query);


    if ($filter === 'cash') {
      $stmt->bindParam(':payment_type', 'Cash', PDO::PARAM_STR);
    } elseif ($filter === 'card') {
      $stmt->bindParam(':payment_type', 'Credit Card', PDO::PARAM_STR);
    }

    if ($startDate && $endDate) {
      $stmt->bindParam(':start_date', $startDate, PDO::PARAM_STR);
      $stmt->bindParam(':end_date', $endDate, PDO::PARAM_STR);
    }

    $stmt->execute();
    $salesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($salesData);
    exit();
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

// Inventory report 
if (isset($_GET['get_inventory_data'])) {
  try {
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

    $query = "SELECT * FROM tblinventory WHERE 1";

    switch ($filter) {
      case 'low':
        $query .= " AND quantity < 10 ORDER BY quantity ASC";
        break;
      case 'high':
        $query .= " AND quantity >= 10 ORDER BY quantity DESC";
        break;

      default:
        break;
    }

    $stmt = $pdo->prepare($query);

    $stmt->execute();
    $inventoryData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($inventoryData);
    exit();
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

// Feedback report 
if (isset($_GET['get_feedback_data'])) {
  try {
    $query = "SELECT * FROM tblfeedback";
    $stmt = $pdo->prepare($query);

    $stmt->execute();
    $feedbackData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($feedbackData);
    exit();
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

view('dashboard/reports.view.php');