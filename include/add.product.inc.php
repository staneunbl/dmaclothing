<?php
	if(isset($_POST['btnreg']))
	{

		$categoryId = 1
		$productId = 1
		$subcategoryId = 1
		$productImage = "test.jpg"
		$productStock = 9
		$productName = $_POST['productName'];
		$productBrand = $_POST['productBrand'];
		$productSize = $_POST['productSize'];
		$productQty = $_POST['productQty'];
		
		require 'db.handler.inc.php';

		$sql = "INSERT INTO product (categoryid, productid, subcategoryid,
			productImage, productName,productBrand, productSize, productStock) VALUES (?,?,?,?,?,?,?,?);";

		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql))
		{
			header("location: ../registration.php?error=sqlerror");
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt,"ssssssss",
				$categoryId, $productId, $subcategoryId, $productImage, $productName, $productBrand, $productSize, 
				$productStock);
			mysqli_stmt_execute($stmt);
			header("location: ../registration.php?registration=success");
		}

	} else
	{
		echo "Forbidden!";
	}
	
?>