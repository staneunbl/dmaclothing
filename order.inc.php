<?php
require './include/db.handler.inc.php';
session_start();

// Get user details
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// Get monetary value details
$subtotal = $_POST['subtotal'];
$shippingFee = $_POST['shippfee'];
$paymentOptions = $_POST['Cpayment'];
$total = $_POST['total'];

// Get order key details
$orderNumber = $_POST['NumberDisplay'];
$deliverstatus = "placed order (processing)";
$paymentstat = "Unpaid";
$date = date('Y-m-d H:i:s');

// Get product details
$quantity = $_POST['quantity'];

// Get user ID for connection
$userId = $_POST['userID'];

// Retrieve cart IDs from session
$cartID = $_POST['cartID'];

// Insert order details into order_tbl
$stmt = $conn->prepare("INSERT INTO order_tbl (
    userid, cartID, firstname, lastname, phone, address, paymentoptions, total, orderdate, ordernumber, 
    shippingfee, subtotal, delivery_status, productName, productStock, productID, quantity, paymentstatus)
VALUES (
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Initialize response array
$response = array(
    'success' => true,
    'message' => "Order placed successfully"
);

// Loop through cart IDs and bind params for each cart item
for ($i = 0; $i < count($cartID); $i++) {
    // Retrieve product details based on cart ID
    $stmt2 = $conn->prepare("SELECT productID, productName, productStock FROM cart WHERE cartID = ?");
    $stmt2->bind_param("i", $cartID[$i]);
    $stmt2->execute();
    $result = $stmt2->get_result();

    while ($row = $result->fetch_assoc()) {
        $productID = $row['productID'];
        $productName = $row['productName'];
        $productStock = $row['productStock'];

        $stmt->bind_param("iississisiiissiiis", 
            $userId, $cartID[$i], $firstname, $lastname, $phone, 
            $address, $paymentOptions, $total, $date, $orderNumber, 
            $shippingFee, $subtotal, $deliverstatus, $productName, 
            $productStock, $productID, $quantity[$i], $paymentstat);

        if (!$stmt->execute()) {
            $response = array(
                'success' => false,
                'message' => "Failed to insert order details for product with ID " . $productID
            );
            // Exit the loop and output the response immediately on error
            echo json_encode($response);
            exit();
        } else {
            // Update product stock
            $newStock = $productStock - $quantity[$i];
            if ($newStock >= 0 && $productStock > 0) {
                $stmt3 = $conn->prepare("UPDATE product SET productStock = ? WHERE productID = ?");
                $stmt3->bind_param("ii", $newStock, $productID);
                if (!$stmt3->execute()) {
                    $response = array(
                        'success' => false,
                        'message' => "Failed to update product stock for product with ID " . $productID
                    );
                    // Exit the loop and output the response immediately on error
                    echo json_encode($response);
                    exit();
                }
            } else {  $response = array(
                // continue from previous code block
                'success' => false,
                'message' => "Insufficient stock for product with ID " . $productID
                );
                // Exit the loop and output the response immediately on error
                echo json_encode($response);
                exit();
                }
                }
                }
                }

                // Output the response if no errors occurred during the loop
                echo json_encode($response);

                // Clear cart items from session
                unset($_SESSION['cart']);
                $stmt4 = $conn->prepare("DELETE FROM cart WHERE userid = ?");
                $stmt4->bind_param("i", $userId);
                if (!$stmt4->execute()) {
                    $response = array(
                        'success' => false,
                        'message' => "Failed to delete cart items"
                    );
                    echo json_encode($response);
                    exit();
                }
                $stmt4->close();
                // Close database connection
                $stmt->close();
                $stmt2->close();
                $conn->close();
?>
        