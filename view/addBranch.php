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
		<div class="body"></div>
		<title>Add Branch</title>
		<style>
			.body{
				position: fixed; 
				overflow-y: scroll;
				overflow-x: scroll;
				width: 100%;
				top: -20px;
				left: -20px;
				right: -40px;
				bottom: -40px;
				width: auto;
				height: auto;
				background-image: url("Background.jpg");
				background-size: cover;  
			}
			.insert{
				position: absolute;
				top: calc(3%);
				left: calc(21% - 140px);
				background: #2f4f4f;
				width: 1000px;
				
				padding-top: 0px;
				padding-right: 20px;
				padding-bottom: 30px;
				padding-left: 40px;
				
				border: 2px solid white;
				}
			.insert input[type=text]{
				width: 250px;
				height: 20px;
				}
			.insert input[type=button]{
				width: 120px;
				height: 26px;
				font-size:14px;
				border:1px solid white;
				}
				
			.insert div{
				font-size: 18px;
				color: #fffafa;
				}
				
			.insert h2{
				color: #fffafa;
				}					
			
			.insert table, td, th {
				border: 1px solid white;
				color: white;
				text-align: center;
				
			}
			.insert table {
				border-collapse: collapse;
				width:500px;
			}
			.insert th {
				height: 40px;
				width:200px;
			}
			.insert input[type=button]:active{
				opacity: 0.6;
			}
			.insert input[type=button]:hover{
				opacity: 0.8;
			}	
			
			.insert ul {
				list-style-type: none;
				padding-left:170px;
				overflow: hidden;
				background-color: #333;
			}

			li {
				float: left;
			}

			li a {
				display: block;
				color: white;
				text-align: center;
				padding-left: 200px;
				padding: 14px 16px;
				text-decoration: none;
			}

			li a:hover {
				background-color: #111;
			}
				
		</style>
		<script type="text/javascript" src="jquery.js"></script>
	</head>
	
	<body onload ="loadBranchess()" >
	
		<div class="insert">
		
		<ul>
			<li><a href="/project/view/manageProducts.php">Manage Product</a></li>
			<li><a href="/project/view/manageAccountRequests.php">Account Requests</a></li>
			<li><a href="/project/view/billing.php">Billing</a></li>
			<li><a href="/project/view/salesHistory.php">Sales History</a></li>
			<li><a href="/project/view/adminPanel.php">Admin Panel</a></li>
			<li><a href="/project/controller/logout.php">Logout</a></li>
		</ul><br><br>
	
			<div>Add / Delete Branch</div><br>
			<input type="text" placeholder="Branch Name"  name="branch"  id="branch"> 
			<input type="button" value="Add" onclick = "addBranch()" > 
			<input type="button" value="Delete" onclick = "deleteBranch()" >
			
		<center>
			<h2>Branches</h2>
			<table name="branches" id ="branches" ></table>
			
		</center>
			
		</div>	
			
		<script type="text/javascript">
			
			
			function loadBranchess()
			{
				$(document).ready(function() {
						$('#branches').load('/project/model/fetchBranchTable.php')
				});
			}
						
			function addBranch()
			{
				var branch = $('#branch').val();
					
				branch = branch.replace(/^\s+/, '').replace(/\s+$/, '');
					
				if(branch === '')
				{
					alert("Invalid Branch");
					document.getElementById("branch").value=null;	
				}
				else
				{
					$.ajax({
						url     : '/project/model/branchAddDelete.php',
						type    : 'POST',
						async   : true,
						data    : {
								'add': 1,
								'branch'       : branch
								},
						success : function(re){	
							alert(re);
							loadBranchess();	
							document.getElementById("branch").value='';							
						}
					});	
				}
						
		
			}	
			
			function deleteBranch()
			{
				var branch = $('#branch').val();
					
				branch = branch.replace(/^\s+/, '').replace(/\s+$/, '');
					
				if(branch === '')
				{
					alert("Invalid Branch");
					document.getElementById("branch").value=null;	
				}
				else
				{
					$.ajax({
						url     : '/project/model/branchAddDelete.php',
						type    : 'POST',
						async   : true,
						data    : {
								'delete': 1,
								'branch'       : branch
								},
						success : function(re){	
							alert(re);
							loadBranchess();	
							document.getElementById("branch").value='';							
						}
					});	
				}	
			}			
			
		</script>
		
	</body>

</html>