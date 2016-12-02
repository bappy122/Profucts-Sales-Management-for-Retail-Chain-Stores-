<?php
include('C:\xampp\htdocs\project\controller\checkSession.php');
if(!checkBillingValidity())
{
	header("Location: /project/view/login.php");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<div class="body">
			<div>
				<ul>
				<li><a href="/project/view/manageProducts.php">Manage Product</a></li>
				<li><a href="/project/view/manageAccountRequests.php">Account Requests</a></li>
				<li><a href="/project/view/billing.php">Billing</a></li>
				<li><a href="/project/view/salesHistory.php">Sales History</a></li>
				<li><a href="/project/view/adminPanel.php">Admin Panel</a></li>
				<li><a href="/project/controller/logout.php">Logout</a></li>
				</ul><br>
			</div>
		</div>
		<script type="text/javascript" src="jquery.js"></script>
		<title>Billing</title>
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
			.body div {
				position: absolute;
				top: calc(5%);
				left: calc(2.1%);
				background: #6e7b8b;
				width: 1338px;
				border: 2px solid white;
				}
			.insert{
				position: absolute;
				top: calc(14%);
				left: calc(11% - 140px);
				background: #2f4f4f;
				width: 650px;
				padding-top: 50px;
				padding-right: 45px;
				padding-bottom: 30px;
				padding-left: 40px;
				
				border: 2px solid white;
				}
				
			.insert div[name=bill]{
				position: absolute;
				top: -2px;
				left: calc(97%);
				background: #483d8b;
				width: 578px;
				
				padding-top: 30px;
				padding-right: 20px;
				padding-bottom: 20px;
				padding-left: 0px;
				
				border: 2px solid white;
				}
				
			.insert input[type=text]{
				width: 200px;
				height: 22px;
				margin-left:25px;
				}
				
			.insert input[type=button]{
				width: 100px;
				height: 26px;
				font-size:14px;
				border:1px solid white;
				margin-left:25px;
				}
				
			.insert input[name=search]{
				margin-left:253px;
				}	
				
			.insert input[name=searchText]{
				margin-left:70px;
				width: 300px;
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
			.insert div{
				font-size: 18px;
				color: #fffafa;
				margin-left:25px;
				}
				
			.insert h2{
				color: #fffafa;
				}					

			.insert table[name = productTable]{
				margin-left:20px;
			}
			
			.insert table td, th {
				border: 1px solid white;
				color: white;
				text-align: center;
			}

			.insert table[name = productTable], {
				border-collapse: collapse;
				overflow-y: auto;  
				width:600px;			
			}
			
			.insert table[name = billTable], {
				border-collapse: collapse;
				width:300px;	
			}
			
			.insert th {
				height: 40px;
				width:200px;
			}
			
			.insert div th {
				height: 30px;
				width:155px;
			}
			.body ul {
				list-style-type: none;
				padding-left:330px;
				overflow: hidden;
				background-color: #333;
			}

			.body div li {
				float: left;
			}

			.body div li a {
				display: block;
				color: white;
				text-align: center;
				padding-left: 200px;
				padding: 14px 16px;
				text-decoration: none;
			}

			.body div a:hover {
				background-color: #111;
			}

			
		</style>
		
	</head>
	
	<body onload ="loadProducts()" >

		<div class="insert">
								
			<div>Add to Bill&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
							&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
							&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
							&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
							&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
				Search Product
			</div>

			<input type="text" placeholder=" Enter Product ID" name="id"  id="id">
			<input type="text" placeholder=" Enter Product-ID / Name / Category / Price"  name="searchText"  id="searchText"><br><br>
			<input type="button" onclick = "validate()" name = 'add' id = 'add'  value="Add"/> 	
	
			<center>	
				<h2>Product List</h2>
			</center>
			
			<center><table name = "productTable" id = "productTable" ></table></center>
			
			<div name = "bill">
				
				<center>
					<div>Details Bill</div></br>
					<div name="billTable" id ="billTable" >No Product Added</div><br>
					<p id = "total" name = "total">Total : 0</p>
					<p id = "vat" name = "vat">Vat 15%: 0</p>
					<p id = "afterVat" name = "afterVat">Total : 0</p>
					<input type="button" onclick = "printBill()" value="Print Bill"/>
					<input type="button" onclick = "clearBillTable()" value="New Bill"/>
					
				</center>
			</div>
			
		</div>	
			
		<script type="text/javascript">
		
			var stop;
			function deleteFromBill(elem)
			{
				//alert(elem.name);
				$.ajax({
					url     : '/project/model/fetchBill.php',
					type    : 'POST',
					async   : true,
					data    : {
							'removeBill'	: 1,
							'id'       : elem.name
					},
					success : function(re){
						loadBill();
						loadBillDetails();
					}
				});				
			}
			
			function clearBillTable()
			{
					$.ajax({
						url     : '/project/model/fetchBill.php',
						type    : 'POST',
						async   : true,
						data    : {
								'clearBillTable'	: 1,
						},
						success : function(re){
							loadBill();
							loadBillDetails();
						}
					});			
			}
			
			function printBill()
			{
				window.open("billPDF.php");
			}
			
			function loadBill()
			{
				$(document).ready(function() {
					$('#billTable').load('/project/model/fetchBill.php')
				});
			}
			
			//enter key event
			$("#id").keyup(function(event){
				if(event.keyCode == 13){
				$("#add").click();
				}
			});
			
			function addToBill()
			{
				var quantity = prompt("Please enter Quantity", 1);
				var pid      = $('#id').val();
				if(!($.isNumeric(quantity)))
				{
					alert("Invalid Quantity...!");
				}
				else
				{
					$.ajax({
						url     : '/project/model/addProduct.php',
						type    : 'POST',
						async   : true,
						data    : {
								'saveBill'	: 1,
								'quantity'  : quantity,
								'pid'       : pid
						},
						success : function(re){
							if(re == '0')
							{
							   // alert(re);
								alert("Invalid Product ID");
							}
							else
							{
								document.getElementById("id").value = "";
								//alert(re);
								loadBill();
								loadBillDetails();
							}
							
						}
					});				
				}
					
			}
						
		
			function loadProducts()
			{
				$(document).ready(function() {
						$('#productTable').load('/project/model/fetchProducts.php')
				});
				loadBill();
				loadBillDetails();
				clearBillTable();
			}
			
		$(document).ready(function(){  
				$('#searchText').keyup(function(){  
					var searchText = $(this).val();  
				if(searchText != '')  
				{  
					$.ajax({  
							url:"/project/model/fetchProducts.php",  
							type:"post",  
							data:{
									'search'     : 1,
									'searchText' : searchText					 
								},  
							success:function(data)
							{  
								$('#productTable').html(data);  
							}  
						});  
				}  
				else  
				{  
					loadProducts();
				}  
			});  
		}); 
			
			function validate()
			{
				var error = [];
				var flag = 0;
				var id = document.getElementById("id").value;
				if(id.length == 0)
				{
					flag++;
					error.push("Enter Product ID...!\n");
				}
				else
				{
					id = id.replace(/^\s+/, '').replace(/\s+$/, '');
					if(id === '')
					{
						flag++;
						error.push("Invalid Product ID...!\n");
					}
				}
				if(error.length > 0)
				{
					flag = 1;
					var msg = 'Errors: \n\n';
					for(var i =0; i <error.length; i++ )
					{
						msg += (i+1) +". "+ error[i] + '\n';
					}
					alert(msg);
				}
				else
				{
					addToBill();
				}
			}	
			
			function loadBillDetails()
			{
                $.ajax({  
                     url:"/project/model/fetchBill.php",  
                     type:"post",  
                     data:{
						'total'     : 1,				 
					 },  
                     success:function(data)  
                     {  
                          $('#total').html(data);  
                     }  
                });
				
              $.ajax({  
                     url:"/project/model/fetchBill.php",  
                     type:"post",  
                     data:{
						'vat'     : 1,				 
					 },  
                     success:function(data)  
                     {  
                          $('#vat').html(data);  
                     }  
                });  
				
              $.ajax({  
                     url:"/project/model/fetchBill.php",  
                     type:"post",  
                     data:{
						'afterVat'     : 1,				 
					 },  
                     success:function(data)  
                     {  
                          $('#afterVat').html(data);  
                     }  
                });  				
			}

		</script>

		
	</body>

</html>