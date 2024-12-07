<?php
    session_start();
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="icon" type="image/x-icon" href="https://i.ibb.co/6ZSj6HC/2.png"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
	<title>Dashboard</title>
</head>
<body>
<!--Nav Bar lodi-->
<div class="topnav">
	<a href="admin.php" style="all: revert;"><img src='https://i.imgur.com/BLFzvT3.png' style ='height:100px; margin-right:20px;'></a>
	<a href="admin.php">Dashboard</a>
	<a href="admininquiry.php">Inquiries</a>
	<a href="addproducts.php">Add Products</a>
	<a href="products.php">Products</a>
	<?php
    echo "HELLO ".$_SESSION['user']."!";
  ?>
	<div class="search-container">
		<form action="/search">
			<input class="search-input"type="text" placeholder="Search..." name="search">
			</div>
			<button class="search-button" type="submit" style = 'background: linear-gradient(to right, #3498db, #1abc9c); color: #fff;'>Search</button>
			<button class="nav-logout" onclick="window.location.href='include/logout.inc.php'" type="button" style ='background: linear-gradient(to right, #3498db, #e74c3c); color: #fff; margin-right: 10px;'>logout</button>
		</form>
</div>

<!--Header-->
<br>
<div class = 'title_container'>

	<center>
	<h1 style="background: linear-gradient(to bottom, #3498db, #263994); color: #fff; height: 100px; width: 1000px; width-right:-50px; text-align: center; line-height: 100px; color:white; border-radius: 10px;"> <b> User Profiles </b></h1>
	</center>
</div>
<table id="test" class="test">
	<thead>
		<tr>
			<th>User ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Username</th>
			<th>Address</th>
			<th>Cellphone No.</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
		require 'include/db.handler.inc.php';
		$sql = "SELECT userid,firstname,lastname FROM user_tbl";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql))
		{
			header("location: ../login.php?error=sqlerror");
			exit();
		}
		else
		{
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			while($row = mysqli_fetch_assoc($result))
			{ 
	?>
				<tr>
					<td><?php echo $row['userid']; ?></td>
					<td><?php echo $row['firstname']; ?></td>
					<td><?php echo $row['lastname']; ?></td>
					<td><button style ="background: linear-gradient(to right, #3498db, #1abc9c);cursor: pointer; color: #fff; padding: 7px;  border-radius: 6px; text-decoration: none;width: 80px;" onclick="window.location.href='cartadmin.php?id=<?php echo $row['username']; ?>';">Cart</button>
						<button style ="background: linear-gradient(to right, #3498db, #1abc9c);cursor: pointer; color: #fff; padding: 7px;  border-radius: 6px; text-decoration: none;width: 80px;" onclick="window.location.href='updateuser.php?id=<?php echo $row['userid']; ?>';">Update</button>
						
					</td>
				</tr>


				
	<?php
			}
		}
	?>
</tbody>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"  ></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#test').DataTable();
	});
</script>

</body>
</html>