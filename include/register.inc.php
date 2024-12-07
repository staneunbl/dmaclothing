<?php
	if(isset($_POST['btnreg']))
	{
		$userName = $_POST['username'];
		$passWord = $_POST['pword'];
		$email = $_POST['email'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$contactnumber = $_POST['contactnumber'];		

		require 'db.handler.inc.php';

		mysqli_real_escape_string($conn,$userName);
		mysqli_real_escape_string($conn,$passWord);
		mysqli_real_escape_string($conn,$email);
		mysqli_real_escape_string($conn,$firstname);
		mysqli_real_escape_string($conn,$lastname);
		mysqli_real_escape_string($conn,$address);
		mysqli_real_escape_string($conn,$contactnumber);				

		$sqlCheck = "SELECT username,email, address, contactnumber FROM user_tbl WHERE username = ? OR email = ? OR address = ? OR contactnumber = ?";
		$stmtCheck = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmtCheck,$sqlCheck))
		{
			header("location: ../registration.php?error=sqlerror");
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmtCheck,"ssss",$userName,$email,$address,$contactnumber);
			mysqli_stmt_execute($stmtCheck);
			mysqli_stmt_store_result($stmtCheck);
			$resultCheck = mysqli_stmt_num_rows($stmtCheck);
			if($resultCheck > 0)
			{
				header("location: ../registration.php?error=incompleteORuserexists");
				exit();
			}
			else
			{
				$sql = "INSERT INTO user_tbl (username,password,email,firstname,lastname,address,contactnumber) VALUES (?,?,?,?,?,?,?);";

				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt,$sql))
				{
					header("location: ../registration.php?error=sqlerror");
					exit();
				}
				else
				{
					$hashedPassword = password_hash($passWord, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt,"sssssss",$userName,$hashedPassword,$email,$firstname,$lastname,$address,$contactnumber);
					mysqli_stmt_execute($stmt);
					header("location: ../registration.php?registration=success");
				}

			}
		}

			

	}
	else
	{
		echo "Forbidden!";
	}
	
?>