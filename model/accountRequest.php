<?php

	$connection = mysql_connect("localhost", "root", "");
	$db = mysql_select_db("restaurent", $connection);
	
	if(isset($_POST['accountrequest']))
	{
		$fname =  $_POST['fname'];
		$lname =  $_POST['lname'];
		$branches = $_POST['branches'];
		$email = $_POST['email'];
		$uname = $_POST['uname'];
		$pass = $_POST['pass'];
		$accountType = $_POST['accountType'];
		
		$res = mysql_query("Insert into `accountrequest` (`fname`,`lname`,`email`,`branch`,`uname`,`pass`,`type`) values('$fname','$lname','$email','$branches','$uname','$pass','$accountType')", $connection);
		echo '1';
	}
	else if(isset($_POST['checkUsername']))
	{
		$query = mysql_query("Select uname from user where uname = '".$_POST['uname']."'", $connection);
		$rows = mysql_num_rows($query);	
		
		if($rows > 0)
		{
			echo '1';
		}
		else
		{
			
			$query = mysql_query("Select uname from admin where uname = '".$_POST['uname']."'", $connection);
			
			$rows = mysql_num_rows($query);
			if($rows > 0)
			{
				echo '1';
			}
			else
			{
				echo '0';
			}
		}
	}
	else
	{
		header('Location: /project/controller/error.php');
	}
	
	mysql_close($connection);


?>