<?php 
$conn = new mysqli('localhost', 'root', '', 'restaurent');
if ($conn->connect_error) {
	die("Connection error: " . $conn->connect_error);
}

if(isset($_POST['mach']))
{
	$temp = '-1';
	$result = $conn->query("SELECT `pid` FROM product where pid = '". $_POST['id']."'" );
	while ($row = $result->fetch_assoc()) {
		$temp = $row['pid'];
	}	
	if($temp == '-1')
	{
		echo '1';
	}
	else
	{
		echo '0';
	}
}

if(isset($_POST['saverecord1']))
{
	$result = $conn->query("SELECT * FROM product where pid = "."'". $_POST['pid']."'" );
	if ($result->num_rows > 0) {

		while ($row = $result->fetch_assoc()) {
			echo $row['pid'];
		}
	}
}

if(isset($_POST['saverecord2']))
{
	$result = $conn->query("SELECT * FROM product where pid = "."'". $_POST['pid']."'" );
	if ($result->num_rows > 0) {

		while ($row = $result->fetch_assoc()) {
			echo $row['category'];
		}
	}
}

if(isset($_POST['saverecord3']))
{
	$result = $conn->query("SELECT * FROM product where pid = "."'". $_POST['pid']."'" );
	if ($result->num_rows > 0) {

		while ($row = $result->fetch_assoc()) {
			echo $row['name'];
		}
	}
}

if(isset($_POST['saverecord4']))
{
	$result = $conn->query("SELECT price FROM product where pid = " ."'". $_POST['pid']."'" );
	if ($result->num_rows > 0) {

		while ($row = $result->fetch_assoc()) {
			echo $row['price'];
		}
	}
}

if(isset($_POST['deletedata']))
{
	$result = $conn->query("DELETE FROM product WHERE pid = ". "'" .$_POST['pid']."'" );
	if ($result->num_rows > 0) {

		while ($row = $result->fetch_assoc()) {
		}
	}
}


?>
