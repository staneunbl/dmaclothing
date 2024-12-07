<?php
	if(isset($_POST['submit-inquiry']))
	{
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$message = $_POST['message'];

		require 'db.handler.inc.php';

		mysqli_real_escape_string($conn,$fullname);
		mysqli_real_escape_string($conn,$email);
		mysqli_real_escape_string($conn,$message);


		$sql = "INSERT INTO inquiry_tbl (fullname, email, message) VALUES (?,?,?);";

		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql))
		{
			header("location: ../inquiry.php?error=sqlerror");
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt,"sss",$fullname,$email,$message);
			mysqli_stmt_execute($stmt);
			header("location: ../inquiry.php?inquiry=success");
		}

	}
	else
	{
		echo "Forbidden!";
	}
	
?>