<?php
	include("checkSession.php");
	
	session_unset();
	session_destroy();
	
	header("Location: /project/view/login.php");
?>