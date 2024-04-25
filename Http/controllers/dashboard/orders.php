<?php
include "connect.php";
// Database connection
// $servername = "localhost";
// $user = "root";
// $pass = "";
// $dbname = "coffeeshop_db";


// // Create a database connection
// $conn = new mysqli($servername, $user, $pass, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

//for pdo
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


// complete order button 
if (isset($_POST['finish_order'])) {
    $orderitemID = $_POST['finish_order'];

    // Construct the SQL query for updating the record
    $update_sql = "UPDATE tblorderitem
                   SET status = 'completed'
                   WHERE tblorderitem.orderitem_id= $orderitemID";

    if ($conn->query($update_sql) === TRUE) {
        //add user log [complete an order]
        $DateTime = new DateTime();
        $philippinesTimeZone = new DateTimeZone('Asia/Manila'); // Set to the Philippines time zone
        $DateTime->setTimeZone($philippinesTimeZone);

        $currentDateTime = $DateTime->format('Y-m-d H:i:s');
        $employeeid = $_SESSION['employeeID'];
        $loginfo = $_SESSION['username'] . ' has completed an order.';

        try {
            $sqlLogAdd = "INSERT INTO tbluserlogs (log_datetime, loginfo, employeeid) VALUES (:currentDateTime, :loginfo, :employeeid)";
            $statementLogAdd = $pdo->prepare($sqlLogAdd);
            $statementLogAdd->bindParam(':loginfo', $loginfo);
            $statementLogAdd->bindParam(':employeeid', $employeeid);
            $statementLogAdd->bindParam(':currentDateTime', $currentDateTime);
            $statementLogAdd->execute();
        } catch (PDOException $e) {
            // Handle the exception/error
            echo "Error: " . $e->getMessage();
        }

        // Handle a successful update (you can redirect or show a success message)
        header('Location: /admin_dashboard/orders'); // Use Location: to specify the redirect location
        exit(); // Exit to prevent further execution
    } else {
        // Handle the update errors
        echo "Error: " . $conn->error;
    }
}

// ended order button 
if (isset($_POST['ended_order'])) {
    $orderitemID = $_POST['ended_order'];

    // Construct the SQL query for updating the record
    $endorder_sql = "UPDATE tblorderitem
                   SET status = 'ended'
                   WHERE tblorderitem.orderitem_id = $orderitemID";

    if ($conn->query($endorder_sql) === TRUE) {

        //add user log [archived an order]
        $DateTime = new DateTime();
        $philippinesTimeZone = new DateTimeZone('Asia/Manila'); // Set to the Philippines time zone
        $DateTime->setTimeZone($philippinesTimeZone);

        $currentDateTime = $DateTime->format('Y-m-d H:i:s');
        $employeeid = $_SESSION['employeeID'];
        $loginfo = $_SESSION['username'] . ' has archived an order.';

        try {
            $sqlLogAdd = "INSERT INTO tbluserlogs (log_datetime, loginfo, employeeid) VALUES (:currentDateTime, :loginfo, :employeeid)";
            $statementLogAdd = $pdo->prepare($sqlLogAdd);
            $statementLogAdd->bindParam(':loginfo', $loginfo);
            $statementLogAdd->bindParam(':employeeid', $employeeid);
            $statementLogAdd->bindParam(':currentDateTime', $currentDateTime);
            $statementLogAdd->execute();
        } catch (PDOException $e) {
            // Handle the exception/error
            echo "Error: " . $e->getMessage();
        }

        // Handle a successful update (you can redirect or show a success message)
        header('Location: /admin_dashboard/orders'); // Use Location: to specify the redirect location
        exit(); // Exit to prevent further execution
    } else {
        // Handle the update errors
        echo "Error: " . $conn->error;
    }
}


// Unarchive button 
if (isset($_POST['unarchive_order'])) {
    $orderitemID = $_POST['unarchive_order'];

    // Construct the SQL query for updating the record
    $update_sql = "UPDATE tblorderitem
                   SET status = 'active'
                   WHERE tblorderitem.orderitem_id = $orderitemID";

    if ($conn->query($update_sql) === TRUE) {
        //add user log [unarchived an order]
        $DateTime = new DateTime();
        $philippinesTimeZone = new DateTimeZone('Asia/Manila'); // Set to the Philippines time zone
        $DateTime->setTimeZone($philippinesTimeZone);

        $currentDateTime = $DateTime->format('Y-m-d H:i:s');
        $employeeid = $_SESSION['employeeID'];
        $loginfo = $_SESSION['username'] . ' has unarchived an order.';

        try {
            $sqlLogAdd = "INSERT INTO tbluserlogs (log_datetime, loginfo, employeeid) VALUES (:currentDateTime, :loginfo, :employeeid)";
            $statementLogAdd = $pdo->prepare($sqlLogAdd);
            $statementLogAdd->bindParam(':loginfo', $loginfo);
            $statementLogAdd->bindParam(':employeeid', $employeeid);
            $statementLogAdd->bindParam(':currentDateTime', $currentDateTime);
            $statementLogAdd->execute();
        } catch (PDOException $e) {
            // Handle the exception/error
            echo "Error: " . $e->getMessage();
        }
        // Handle a successful update (you can redirect or show a success message)
        header('Location: /admin_dashboard/orders'); // Use Location: to specify the redirect location
        exit(); // Exit to prevent further execution
    } else {
        // Handle the update errors
        echo "Error: " . $conn->error;
    }
}

view('dashboard/orders.view.php');
