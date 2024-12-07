<?php

require './include/db.handler.inc.php';

session_start();

if(isset($_POST['cart_items']))
{
    echo count($_POST['cartID']);
    exit();
}


if (!isset($_SESSION['id'])) {
    echo "User not logged in";
    exit();
}

$productName = $_POST['productName'];
$productPrice = $_POST['productPrice'];
$productID = $_POST['productID'];
$productStock = $_POST['productStock'];
$userId = $_SESSION['id'];

// Check if the product already exists in the cart
$stmt = $conn->prepare("SELECT COUNT(*) FROM cart WHERE userId = ? AND productId = ?");
$stmt->bind_param("ii", $userId, $productID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->fetch_assoc()['COUNT(*)'] > 0) {
    echo "Product already exists in cart";
} else {
    $stmt = $conn->prepare("INSERT INTO cart (userId, productId, productName, productStock, productPrice) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisid", $userId, $productID, $productName, $productStock, $productPrice);
    $stmt->execute();

    $_SESSION['name'][] = $productName;
    $_SESSION['price'][] = $productPrice;
    echo count($_SESSION['name']);
    header("location: ./productspage.php?alert=succesful");
    exit();
}

?>