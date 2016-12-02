<?php
session_start();
function checkUserValidity()
{
    
	if( !isset($_SESSION) ) 
	{
		header('Location: /project/view/login.php');
	}
	else
	{
		if($_SESSION['user'] == 'admin')
		{
			return true;
		}
		else
		{
			header('Location: /project/view/login.php');
		}
	}	
}

function checkBillingValidity()
{
    
	if( !isset($_SESSION) ) 
	{
		header('Location: /project/view/login.php');
	}
	else
	{
		if($_SESSION['user'] == 'admin' || $_SESSION['user'] == 'basicUser')
		{
			return true;
		}
		else
		{
			header('Location: /project/view/login.php');
		}
	}	
}

?>