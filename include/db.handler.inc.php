<?php 
//MySqli
$serverName = "localhost";
$dbname = "dmaclothing";
$username = "root";
$password = "";

$conn = mysqli_connect($serverName,$username,$password,$dbname);

if(!$conn)
{
	die("Cant connect to the database");
}

?>