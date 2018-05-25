<?php  
$servername="localhost";
$username="root";
$password="";
$database="project";

$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn)
{
	die("Connection failed".mysqli_connect_error());
}


$sql="CREATE TABLE IF NOT EXISTS users
	(id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
     firstname VARCHAR(30),
     lastname VARCHAR(30),
     password VARCHAR(30),
     email VARCHAR(30),
     salt VARCHAR(100),
     reg_date TIMESTAMP
 )";
if(mysqli_query($conn,$sql))
{
	
}
else
{
	$error_message = mysqli_error($conn);
}

?>