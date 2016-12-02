<?php

	$conn = new mysqli('localhost', 'root', '', 'restaurent');
	if ($conn->connect_error) {
		die("Connection error: " . $conn->connect_error);
	}
			
	$uname;
	$pass ;
	$branch;
	$accountType;
			
	if(isset($_POST['approve']))
	{
		$result = $conn->query("SELECT * FROM accountrequest where id = '".$_POST['id']."'");
		
		while ($row = $result->fetch_assoc()) {
			$uname = $row['uname'];
			$pass = $row['pass'];
			$branch = $row['branch'];
			$accountType = $row['type'];
		}
		
		if($accountType == 'Salesman')
		{
			$result = $conn->query("INSERT INTO user values('$uname','$pass','$branch')");
		}
		else
		{
			$result = $conn->query("INSERT INTO admin values('$uname','$pass','$branch')");
		}
		
		$result2 = $conn->query("DELETE FROM accountrequest where id = '".$_POST['id']."'");			
	}
	else if(isset($_POST['discard']))
	{

		$result2 = $conn->query("DELETE FROM accountrequest where id = '".$_POST['id']."'");					
	}

	else
	{
		header("Location: /project/controller/error.php");
	}

?>