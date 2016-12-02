<?php
session_start();
	$connection = mysql_connect("localhost", "root", "");
	$db = mysql_select_db("restaurent", $connection);

if(isset($_POST['saverecord']))
{
	$pid = $_POST['pid'];
	$category = $_POST['category'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	$branch = $_SESSION['branch'];

	$res = mysql_query("INSERT INTO `product` (`pid`,`category`,`name`,`price`,`branch`) VALUES('$pid','$category','$name','$price','$branch')", $connection);
	if( mysql_errno() == 1062) {
		echo('Product Id Already Exists...!');
    } 
	else {
    	if($res)
		{
			echo '0';
			exit();
		}
	}		
}

if(isset($_POST['update']))
{
	$pid = $_POST['pid'];
	$pidUpdate = $_POST['pidUpdate'];
	$categoryUpdate = $_POST['categoryUpdate'];
	$nameUpdate = $_POST['nameUpdate'];
	$priceUpdate = $_POST['priceUpdate'];

	$res = mysql_query("UPDATE `product` SET `pid`= '$pidUpdate',`category`='$categoryUpdate',`name`='$nameUpdate',`price`='$priceUpdate' WHERE `pid`= '$pid'", $connection);
	if( mysql_errno() == 1062) {
		echo('Product Id Already Exists...!');
    } 
	else {
    	if($res)
		{
			echo '0';
			exit();
		}
	}		
}

if(isset($_POST['saveBill']))
{
	session_start();
	$conn = new mysqli('localhost', 'root', '', 'restaurent');
	if ($conn->connect_error) {
		die("Connection error: " . $conn->connect_error);
	}
	
	$pid = $_POST['pid'];
	$quantity = $_POST['quantity'];
	$branch = $_SESSION['branch'];
	$result = $conn->query("SELECT * FROM product where pid = '".$pid."'");

	if ($result->num_rows > 0) 
	{
		while ($row = $result->fetch_assoc()) 
		{
			$price = $row['price'];
			$category = $row['category']; 
			$name = $row['name'];
			$unitPrice = (float)$price;
			$unit = (int)$quantity;
			$subtotal = $unitPrice * $unit;
		}
		$res = mysql_query("INSERT INTO `bill`(`pid`,`category`,`name`,`price`,`quantity`,`subtotal`,`time`,`date`,`branch`) VALUES('$pid','$category','$name','$price','$quantity','$subtotal',CURRENT_TIME,CURRENT_DATE,'$branch')", $connection);

	}
	else
	{
		echo'0';
	}	
}


?>