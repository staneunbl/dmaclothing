<?php

require './include/db.handler.inc.php';

session_start();

if (!isset($_SESSION['id'])) {
    echo "User not logged in";
    exit();
}

var_dump($_POST);

if(isset($_POST['buttonfinished'])){

    $ordernumber = $_POST['orderNumber'];
    $orderdeliveryStatus = $_POST['deliveryStatus'];
    $userId = $_SESSION['id'];

    // Initialize $stmt variable
    $stmt = null;

    switch ($orderdeliveryStatus) {
        case "Placed Order (Processing)":
            // Set processing status
        $stmt = $conn->prepare("UPDATE order_tbl set delivery_status = 'Placed order (processing)', paymentstatus = 'Unpaid'  where ordernumber = ?");
        $stmt->bind_param("i", $ordernumber);
        break;
        case "Delivered (Waiting to Receive)":
            // Set waiting status
        $stmt = $conn->prepare("UPDATE order_tbl set delivery_status = 'Waiting to Receive', paymentstatus = 'Processing Payment' where ordernumber = ?");
        $stmt->bind_param("i", $ordernumber);
        break;
        case "Complete":
            // Set complete status
        $stmt = $conn->prepare("UPDATE order_tbl set delivery_status = 'Complete', paymentstatus = 'Paid' where ordernumber = ?");
        $stmt->bind_param("i", $ordernumber);
        break;
        default:
            if(!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin01'){
                echo "<script>alert(\"Somehow Failed? Contact Inquiry\");window.location.href=\"../casestudy1/purchasehistory.php\";</script>";
                exit();
            }else{
                    echo "<script>alert(\"Failed\");window.location.href=\"../casestudy1/adminorders.php\";</script>";
                    exit();
            }
        }
    // Check if $stmt is not null before executing
    if ($stmt !== null) {
        $stmt->execute();
    }

    // Update payment status if value is not empty

    if(!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin01'){
        echo "<script>alert(\"Product Receive and Paid succesfully\");window.location.href=\"../casestudy1/purchasehistory.php\";</script>";
        exit();
    }
    else{
        echo "<script>alert(\"Product Delivered succesfully\");window.location.href=\"../casestudy1/adminorders.php\";</script>";
        exit();
    }
    
}
?>