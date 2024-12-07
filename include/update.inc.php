<?php
	if(isset($_POST['btnUpdate']))
	{
		require 'db.handler.inc.php';

		$uname = $_POST['uname'];
		$email = $_POST['email'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$address = $_POST['address'];
		$contactnumber = $_POST['contactnumber'];
		$id = $_POST['userid']; 		

		$sql = "UPDATE user_tbl SET username=? , email=?, firstname=?, lastname=?, address=?, contactnumber=? WHERE userid = ?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql))
		{
			header("location: ../update.php?error=sqlerror");
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt,"ssssssi", $uname, $email, $fname, $lname, $address, $contactnumber,$id);
			mysqli_stmt_execute($stmt);
			header("location: ../admincustomer.php?update=success");
		}
	}
	else
	{
		echo "Forbidden!";
	}


?>