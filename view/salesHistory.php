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
		<script type="text/javascript" src="jquery.js"></script>
		<title>Sales History</title>
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
				top: calc(5%);
				left: calc(15% - 140px);
				background: #2f4f4f;
				width: 1200px;
				
				padding-top: 0px;
				padding-right: 20px;
				padding-bottom: 20px;
				padding-left: 20px;
				
				border: 2px solid white;
				}
			.insert input[type=text]{
				width: 450px;
				height: 22px;
				margin-left: 22px;
				}
			.insert input[type=button]{
				width: 100px;
				height: 26px;
				font-size:14px;
				border:1px solid white;
				}
				
			.insert input[type=button]:hover{
				opacity: 0.8;
			}
			
			.insert input[type=button]:active{
				opacity: 0.6;
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
				width:1150px;

			}
			.insert th {
				height: 50px;
				width:200px;
			}
			
			.insert ul {
				list-style-type: none;
				padding-left:450px;
				overflow: hidden;
				background-color: #333;
			}
			
			.insert ul {
				list-style-type: none;
				padding-left:260px;
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
		
	</head>
	
	<body onload ="loadSales()" >
	
	


		<div class="insert">
		
		<ul>
			<li><a href="/project/view/manageProducts.php">Manage Product</a></li>
			<li><a href="/project/view/manageAccountRequests.php">Account Requests</a></li>
			<li><a href="/project/view/billing.php">Billing</a></li>
			<li><a href="/project/view/salesHistory.php">Sales History</a></li>
			<li><a href="/project/view/adminPanel.php">Admin Panel</a></li>
			<li><a href="/project/controller/logout.php">Logout</a></li>
		</ul>
			<center>
				<h2>Sales History</h2>
			</center><br>
			
			<input type="text" placeholder=" Search By  Product-ID/Name/Category/Price/Date/Time/Branch/Salesman"  name="searchText"  id="searchText"><br><br>
			
			<center>
				
				<table name="salesTable" id ="salesTable" ></table>
			</center>
			
		</div>	
			
		<script type="text/javascript">

			function loadSales()
			{
				$(document).ready(function() {
						$('#salesTable').load('/project/model/fetchSales.php')
				});
							
			}			
			
		$(document).ready(function(){  
				$('#searchText').keyup(function(){  
					var searchText = $(this).val();  
				if(searchText != '')  
				{  
					$.ajax({  
							url:"/project/model/fetchSales.php",  
							type:"post",  
							data:{
									'search'     : 1,
									'searchText' : searchText					 
								},  
							success:function(data)
							{  
								$('#salesTable').html(data);  
							}  
						});  
				}  
				else  
				{  
					loadSales();
				}  
			});  
		}); 
			
		</script>

		
	</body>

</html>