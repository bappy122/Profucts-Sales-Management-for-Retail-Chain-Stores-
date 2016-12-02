<?php

checkUser();

function checkUser()
{

	$connection = mysql_connect("localhost", "root", "");
	$db = mysql_select_db("restaurent", $connection);
	$flag = 0;
	$Check = 0;
	
	if(isset($_POST['login']))
	{
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		$branch = $_POST['branch'];
		
		$query = mysql_query("select * from user where uname='$username' AND pass='$pass' AND branch= '$branch'" , $connection);
		$rows = mysql_num_rows($query);	
		
		if($rows > 0)
		{	
			if( !isset($_SESSION) ) 
			{
				session_start();
			}
			$_SESSION['user'] = "basicUser";
			$_SESSION['username'] = $username;
			$_SESSION['branch'] = $branch;
			$Check = 1;
			echo "user";
			$flag=1;
		}
		
		if($Check == 0)
		{		
			$username = $_POST['username'];
			$pass = $_POST['pass'];
			$branch = $_POST['branch'];
		
			$query2 = mysql_query("select * from admin where uname='$username' AND pass='$pass' AND branch= '$branch'", $connection);//for admin & Managers
			$rows2 = mysql_num_rows($query2);//for admin	
		
			if($rows2 > 0)
			{
				if( !isset($_SESSION) ) 
				{
					session_start();
				}
			
				$_SESSION['user'] = "admin";
				if($branch == 'admin')
				{
					$_SESSION['username'] = "ADMIN";
					$_SESSION['branch'] = "ADMIN";
				}
				else
				{
					$_SESSION['username'] = $username;
					$_SESSION['branch'] = $branch;
				}
				//header('Location: /project/view/adminPanel.php');
				echo 'admin';
				$Check = 1;
				$flag = 1;
			}
		}
		
		if($Check == 0)
		{
			$query = mysql_query("select `uname` from user where uname='$username'", $connection);//for user
			$rows = mysql_num_rows($query);//for user
			
			$query2 = mysql_query("select `uname` from admin where uname='$username'", $connection);//for admin & Managers
			$rows2 = mysql_num_rows($query2);//for admin	
			if($rows2 > 0)
			{
				echo '1';
			}
			else if($rows > 0)
			{
				echo '1';
			}
			else
			{
				echo '0';
			}
			
			$flag=1;
		}
	}
	mysql_close($connection);
}
?>