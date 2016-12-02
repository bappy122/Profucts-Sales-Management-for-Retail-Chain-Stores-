<?php
include('C:\xampp\htdocs\project\controller\checkSession.php');
if(!checkUserValidity())
{
	header("Location: /project/view/login.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="adminStyle.css">
		<title>Admin Panel</title>
	</head>
	
	<body>
		<div class="body"></div>
		
			<div class="adminOptions">
				<center>
					<div>Welcome Admin</div><br>
				
					<input type="Button" onclick = "gotoMNG()" value="Manage Products"/><br>
					<input type="Button" onclick = "salesHistory()" value="Sales History"/><br>
					<input type="Button" onclick = "gotoBilling()" value="Billing"/><br>
					<input type="Button" onclick = "gotoAccountRequest()" value="Account Requests"/>
					<input type="Button" onclick = "gotoAddBranches()" value="Add Branch"/>
					<input type="Button" onclick = "logout()" value="Logout"/><br>
					</center>
			</div>
			<script>
				function gotoMNG()
				{
					window.open('/project/view/manageProducts.php','_self',false);
				}
				
				function gotoAddBranches()
				{
					window.open('/project/view/addBranch.php','_self',false);
				}
				
				function gotoAccountRequest()
				{
					window.open('/project/view/manageAccountRequests.php','_self',false);
				}
				
				function salesHistory()
				{
					window.open('/project/view/salesHistory.php','_self',false);
				}
				
				function gotoBilling()
				{
					window.open('/project/view/billing.php','_self',false);
				}
				function logout()
				{
					window.open('/project/controller/logout.php','_self',false);
				}
			</script>
	</body>
</html>