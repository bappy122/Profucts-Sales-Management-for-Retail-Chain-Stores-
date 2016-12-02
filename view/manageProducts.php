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
		<title>Manage Products</title>
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
				width: 180px;
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
				width:900px;
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
	
	<body onload ="loadProducts()" >
	
		<div class="insert">
		
		<ul>
			<li><a href="/project/view/manageProducts.php">Manage Product</a></li>
			<li><a href="/project/view/manageAccountRequests.php">Account Requests</a></li>
			<li><a href="/project/view/billing.php">Billing</a></li>
			<li><a href="/project/view/salesHistory.php">Sales History</a></li>
			<li><a href="/project/view/adminPanel.php">Admin Panel</a></li>
			<li><a href="/project/controller/logout.php">Logout</a></li>
		</ul><br><br>
		
			<div>Add Product</div></br>
			<input type="text" placeholder=" Product ID"  name="pid"  id="pid">
			<input type="text" placeholder=" Category"  name="category"  id="category">
			<input type="text" placeholder=" Name/Detail"  name="name"  id="name">
			<input type="text" placeholder=" Price"  name="price"  id="price">
			<input type="button" name="save" id="save" value="Add"/><br></br>

			<div>Update Product</div></br>
			<input type="text" placeholder=" Product ID"  name="pidUp"  id="pidUp">
			<input type="button" onclick="loadProductDetail()" value="Load Product"/><br>
			
			<input type="text" placeholder=" Product ID" name="pidUpdate"  id="pidUpdate">
			<input type="text" placeholder=" Category"  name="categoryUpdate"  id="categoryUpdate">
			<input type="text" placeholder=" Name/Detail"  name="nameUpdate"  id="nameUpdate">
			<input type="text" placeholder=" Price"  name="priceUpdate"  id="priceUpdate">
			<input type="button" onclick="updateProduct()" value="Update"/><br><br>

			<div>Delete Product</div></br>
			<input type="text" placeholder=" Product ID"  name="pidDel"  id="pidDel">
			<input type="button" onclick="deleteProduct()" value="Delete"/><br><br>					
		
			<center>
				<h2>Products</h2>
				<table name="productsTable" id ="productsTable" ></table>
			</center>
			
		</div>	
			
		<script type="text/javascript">
			
			var v1='';
			var v2='';
			var v3='';
			var v4='';
			var stop;
			
			function machProductID(id)
			{
				//alert("this is: "+id);
				$.ajax({
					url     : '/project/model/loadProductDetail.php',
					type    : 'POST',
					async   : true,
					data    : {
							'mach': 	1,
							'id'       : id
					},
					success : function(re){
						if(re==1)
						{
							alert("Product not found");
							stop = 1;
						}
						else if(re==0)
						{
							stop = 0;
							//alert("found");
						}
						else
						{
							stop = 0;
							alert("Unexpected error at machId");
						}
					}
				});						
			}
			
			function validateAdd()
			{
				var flag=0;
				var error = [];
				var id  = document.getElementById("pid").value;
				var category  = document.getElementById("category").value;
				var name  = document.getElementById("name").value;
				var price  = document.getElementById("price").value;
				
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

				if(category.length == 0)
				{
					flag++;
					error.push("Enter Product Category...!\n");
				}
				else
				{
					category = category.replace(/^\s+/, '').replace(/\s+$/, '');
					if(category === '')
					{
						flag++;
						error.push("Invalid Category...!\n");
					}
				}
				
				if(name.length == 0)
				{
					flag++;
					error.push("Enter Product Name...!\n");
				}
				else
				{
					name = name.replace(/^\s+/, '').replace(/\s+$/, '');
					if(name === '')
					{
						flag++;
						error.push("Invalid Name...!\n");
					}
				}
				
				if(!($.isNumeric(price)))
				{
					flag++;
					error.push("Invalid Price...!\n");
				}
				
				if(flag > 0)
				{
					var msg = 'Errors: \n\n';
					for(var i =0; i <error.length; i++ )
					{
						msg += (i+1) +". "+ error[i] + '\n';
					}
					alert(msg);	
					return false;
				}
				else
				{
					return true;
				}
				
			}
			
			function validateDelete()
			{
				var error = [];
				var flag = 0;
				var id = document.getElementById("pidDel").value;
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
			
				if(flag == 0)
				{
					return true;
				}
				else
				{
					return false;
				}				
			}		
			
			function validateUpdate()
			{
				var flag=0;
				var error = [];
				var id  = document.getElementById("pidUpdate").value;
				var category  = document.getElementById("categoryUpdate").value;
				var name  = document.getElementById("nameUpdate").value;
				var price  = document.getElementById("priceUpdate").value;
				
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

				if(category.length == 0)
				{
					flag++;
					error.push("Enter Product Category...!\n");
				}
				else
				{
					category = category.replace(/^\s+/, '').replace(/\s+$/, '');
					if(category === '')
					{
						flag++;
						error.push("Invalid Category...!\n");
					}
				}
				
				if(name.length == 0)
				{
					flag++;
					error.push("Enter Product Name...!\n");
				}
				else
				{
					name = name.replace(/^\s+/, '').replace(/\s+$/, '');
					if(name === '')
					{
						flag++;
						error.push("Invalid Name...!\n");
					}
				}
				
				if(!($.isNumeric(price)))
				{
					flag++;
					error.push("Invalid Price...!\n");
				}
				
				if(flag > 0)
				{
					var msg = 'Errors: \n\n';
					for(var i =0; i <error.length; i++ )
					{
						msg += (i+1) +". "+ error[i] + '\n';
					}
					alert(msg);	
					return false;
				}
				else
				{
					return true;
				}				
			}	
			function validateLoad()
			{
				var error = [];
				var flag = 0;
				var id = document.getElementById("pidUp").value;
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
			
				if(flag == 0)
				{
					return true;
				}
				else
				{
					return false;
				}
				
			}			
			function loadProducts()
			{
				$(document).ready(function() {
						$('#productsTable').load('/project/model/fetchProducts.php')
				});
			}
				
			function loadProductDetail()
			{
				if((validateLoad()))
				{

					loadID();
					loadCategory();
					loadName();
					loadPrice();	

					loadID();
					loadCategory();
					loadName();
					loadPrice();					
				}
			}			
						
			$(function(){
				$('#save').click(function(){
					if(!(validateAdd()))
					{
						exit();
					}
					var pid      = $('#pid').val();
					var category = $('#category').val();
					var name     = $('#name').val();
					var price    = $('#price').val();
				
					$.ajax({
						url     : '/project/model/addProduct.php',
						type    : 'POST',
						async   : true,
						data    : {
								'saverecord': 1,
								'pid'       : pid,
								'category'  : category,
								'name'      : name,
								'price'     : price
						},
						success : function(re){
							if(re==0)
							{
								loadProducts();
								alert('Data inserted Successfully...!');
								document.getElementById("pid").value = '';
				                document.getElementById("category").value = '';
								document.getElementById("name").value = '';
								document.getElementById("price").value = '';
							}
							else
							{
								alert(re);
								
								document.getElementById("pid").value = '';
				                document.getElementById("category").value = '';
								document.getElementById("name").value = '';
								document.getElementById("price").value = '';
							}
						}
					});
				});
			});
			
			function updateProduct()
			{
				var pid      	   = $('#pidUp').val();
				var pidUpdate      = $('#pidUpdate').val();
				var categoryUpdate = $('#categoryUpdate').val();
				var nameUpdate     = $('#nameUpdate').val();
				var priceUpdate    = $('#priceUpdate').val();	

				if(!(validateUpdate()))
				{
					exit();
				}
				
				$.ajax({
					url     : '/project/model/addProduct.php',
					type    : 'POST',
					async   : true,
					data    : {
							'update'         : 1,
							'pid'            : pid,
							'pidUpdate'      : pidUpdate,
							'categoryUpdate' : categoryUpdate,
							'nameUpdate'     : nameUpdate,
							'priceUpdate'    : priceUpdate
							
					},
					success : function(re){	
						if(re==0)
						{
							loadProducts();
							alert("Product Updated...!");
							
							document.getElementById("pidUpdate").value = '';
							document.getElementById("categoryUpdate").value = '';
							document.getElementById("nameUpdate").value = '';
							document.getElementById("priceUpdate").value = '';
							document.getElementById("pidUp").value = '';
						}
						else
						{
							alert(re);
						}	
					}
				});					
				
				
			}
			
			function deleteProduct()
			{
					var pid      = $('#pidDel').val();
						if(!(validateDelete()))
						{
							exit();
						}
						machProductID(pid);
					$.ajax({
						url     : '/project/model/loadProductDetail.php',
						type    : 'POST',
						async   : true,
						data    : {
								'deletedata': 1,
								'pid'       : pid
						},
						success : function(re){	
							//alert("Product Deleted");
							loadProducts();	
							document.getElementById("pidDel").value='';							
						}
					});			
			}			
			
			function loadID()
			{
					var pid      = $('#pidUp').val();
				
					$.ajax({
						url     : '/project/model/loadProductDetail.php',
						type    : 'POST',
						async   : true,
						data    : {
								'saverecord1': 1,
								'pid'       : pid
						},
						success : function(re){
							v1 = re;							
						}
					});			
			}
			function loadCategory()
			{
					var pid      = $('#pidUp').val();
					$.ajax({
						url     : '/project/model/loadProductDetail.php',
						type    : 'POST',
						async   : true,
						data    : {
								'saverecord2': 1,
								'pid'       : pid
						},
						success : function(re){
							v2 = re;							
						}
					});			
			}			
			function loadName()
			{
					var pid      = $('#pidUp').val();
			
					$.ajax({
						url     : '/project/model/loadProductDetail.php',
						type    : 'POST',
						async   : true,
						data    : {
								'saverecord3': 1,
								'pid'       : pid
						},
						success : function(re){
							v3 = re;	
						}
					});			
			}
			function loadPrice()
			{
					var pid      = $('#pidUp').val();
				
					$.ajax({
						url     : '/project/model/loadProductDetail.php',
						type    : 'POST',
						async   : true,
						data    : {
								'saverecord4': 1,
								'pid'       : pid
						},
						success : function(re){
							v4 = re;
							setValues();
						}
					});			
			}
			function setValues()
			{ 
			//	if((v1 == ""  || v2 == "" || v3 == "" || v4 = "" ) && ((v1 != "" && v2 != "" && v3 != "" && v4 != "") )    
			//	{
			//		loadProductDetail();
			//	}
				document.getElementById("pidUpdate").value = ""+v1;
				document.getElementById("categoryUpdate").value = ""+v2;
				document.getElementById("nameUpdate").value = ""+v3;
				document.getElementById("priceUpdate").value = ""+v4;
			}
				
			
		</script>
		
	</body>

</html>