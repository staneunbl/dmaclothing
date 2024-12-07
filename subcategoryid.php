<?php

require './include/db.handler.inc.php';

header("Content-Type: application/json");

session_start();

if (!isset($_SESSION['id'])) {
    echo "User not logged in";
    exit();
}

$categoryId = $_GET['categoryId'];

// Check if the product already exists in the cart
$sql = "SELECT subCategoryID, subCategory from subcategory where categoryId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $categoryId);
$stmt->execute();
$result = $stmt->get_result();

$final = array();
$content = "";

$responseArr = array();
while($row = mysqli_fetch_array($result))
{
      $content = "{\"key\":". $row['subCategoryID']. ",". "\"text\":". "\"". $row['subCategory'] . "\"" ."}";
      array_push($final, $content);
}
echo "[". implode(",", $final). "]";
exit();

?>