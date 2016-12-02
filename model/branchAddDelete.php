<?php

	$connection = mysql_connect("localhost", "root", "");
	$db = mysql_select_db("restaurent", $connection);

if(isset($_POST['add']))
{
	$branch = $_POST['branch'];

	$res = mysql_query("INSERT INTO `branch` (`branch`) VALUES('$branch')", $connection);
	
	if( mysql_errno() == 1062) 
	{
		echo('Branch Already Exists...!');
    } 
	else 
	{
    	if($res)
		{
			echo 'Branch Added..!';
		}
	}		
}

if(isset($_POST['delete']))
{
	$branch = $_POST['branch'];

	$res = mysql_query("DELETE FROM `branch` where branch = '$branch' ", $connection);
	
    if($res > 0)
	{
		echo 'Branch Deleted..!';
	}
	else
	{
		echo 'Branch Did not match..!';
	}
			
}

?>
