
<!DOCTYPE html>
<html>
	
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="loginStyle.css">
	</head>

	<body onload = "loadBranches()">
		<div class="body"></div>
		
		<form>
			<div class="login">
				<div>Login</div><br><br>
				<input type="text" placeholder="User Name"  name="username"  id="username"><br>
				<input type="password" placeholder="Password"  name="pass"  id="pass"><br>
				
				<p> <input type="checkbox" onclick="checkboxChecked()" name="checkbox" id ="checkbox" value="admin"> I am Admin.</p>
				
				<select id = "dropdown" name = "dropdown"></select><br>	

				<input type="button" onclick = "validateForm()"  value="Login"/>
				<input type="button" onclick="goToRegistration()" value="Register"/>
			</div>
		</form>
		
		<style type="text/css">     
			select {
				width:200px;
				height:30px;
				font-size: 14px;
			}
		</style>
		
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript">
		
		function loadBranches()
		{
			$(document).ready(function() {
					$('#dropdown').load('/project/model/fetchBranch.php')
				});
		}
		
		function checkboxChecked()
		{
			if(document.getElementById("checkbox").checked)
			{
				document.getElementById("dropdown").disabled = true;
			}
			else
			{
				document.getElementById("dropdown").disabled = false;
			}
		}
		
		function loginCheck()
		{
			if(document.getElementById("checkbox").checked)
			{
				var branch = "admin";			
			}
			else
			{
				var e = document.getElementById("dropdown");
				var branch = e.options[e.selectedIndex].text;
				//alert(branch);
				//var branch =  document.getElementById("dropdown").value
			}
			
			var username  = $('#username').val();
			var pass      = $('#pass').val();
			
			$.ajax({
				url     : '/project/controller/loginCheck.php',
				type    : 'POST',
				async   : true,
				data    : {
						'login': 1,
						'username'   : username,
						'pass'       : pass,
						'branch'     : branch
				},
				success : function(re){
				//	alert(re);
					if(re == '0')
					{
						document.getElementById("pass").value = "";
						document.getElementById("username").value = "";
						alert("Username & Password doesnot mach...!");
					}
					else if(re == '1')
					{
						document.getElementById("pass").value = "";
						alert("Incorrect Password...!");
					}
					else if(re == 'admin')
					{
						window.open('/project/view/adminPanel.php','_self', false);
					}
					else if(re == 'user')
					{

						window.open('/project/view/billing.php','_self', false);
					}
					else
					{
						window.open('/project/controller/error.php','_self', false);
					}
				}
			});	
				 loadBranches();
		}
	
		function goToRegistration()
		{
			window.open('/project/view/registration.php','_self', false);
		}
		
		function validateForm()
		{
			
			var error = [];
			var uname = document.getElementById("username").value;
			var password = document.getElementById("pass").value;
	
			if(uname.length == 0)
			{
				error.push("Enter Userame...!\n");
			}
			else
			{
				uname = uname.replace(/^\s+/, '').replace(/\s+$/, '');
				if(uname === '')
				{
					error.push("Invalid Username...!\n"); 
					document.getElementById("username").value = null;
				}
			}
			if(password.length == 0)
			{
				error.push("Enter Password...!\n");
			}
			
			if(document.getElementsByName('dropdown')[0].value == 'Select Branch' && !(document.getElementById("checkbox").checked))
			{
				error.push("Select Branch...!\n");
			}
			
			if(error.length > 0)
			{
			
				var msg = 'Errors: \n\n';
				for(var i =0; i <error.length; i++ )
				{
					msg += (i+1) +". "+ error[i] + '\n';
				}
				alert(msg);
			}
			else
			{
				loginCheck();
			}			
		}	
		</script>
		
	</body>
	
</html>