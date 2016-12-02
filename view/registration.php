<!DOCTYPE html>
<html>

<head>

  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="registrationStyle.css">
   
</head>

<body onload = "loadBranches()">

  <div class="body"></div>		
	
		<form>
			<div class="registration">
			
				<div>Registration</div><br>
				
				<input type="text" placeholder="First Name" name="fname" id="fname"><br>
				<input type="text" placeholder="Last Name" name="lname" id="lname"><br>
				<input type="text" placeholder="Email" name="email" id="email"><br><br>
				
				<select name="accountType" id = "accountType"> 
					<option>Select Account Type</option>
					<option>Salesman</option>
					<option>Manager</option>
				</select><br><br>

				<select name="branches" id = "branches"> </select><br>
				
				<input type="text" placeholder="Username" name="uname" id="uname"><br>
				<input type="password" placeholder="Password" name="pass" id="pass"><br>
				<input type="button" onclick = "validateForm()" value="Register"><input type="button" name = "back" id ="back" onclick = "backButton()" value="Back"/>
			</div>
		</form>	
		
		<style type="text/css">     
			select {
				width:190px;
				height:30px;
				font-size: 14px;
			}
		</style>
		
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript">
		
			var usernameNotExist = true;
			function loadBranches()
			{
				$(document).ready(function() {
						$('#branches').load('/project/model/fetchBranch.php')
				});
			}
			function backButton()
			{
				window.open("/project/view/login.php","_self", false);
			}
			
			function register()
			{
				var fname = document.getElementById("fname").value;
				var lname = document.getElementById("lname").value;
				var email = document.getElementById("email").value;
				
				var e = document.getElementById("branches");
				var branches = e.options[e.selectedIndex].text;
				
				var e = document.getElementById("accountType");
				var accountType = e.options[e.selectedIndex].text;
				
				var uname = document.getElementById("uname").value;
				var pass = document.getElementById("pass").value;
	
				$.ajax({
					url     : '/project/model/accountRequest.php',
					type    : 'POST',
					async   : true,
					data    : {
							'accountrequest': 1,
							'fname'         : fname,
							'lname'         : lname,
							'email'         : email,
							'branches'      : branches,
							'accountType'   : accountType,
							'uname'         : uname,
							'pass'          : pass
						},
					success : function(re){
						if(re == '1')
						{
							alert("An Account Request has been sent to Admin For approval.\nAfter approval you can Login.");
							window.open('/project/view/login.php','_self', false);
						}
					}
				});
				
			}
			
			function validateForm()
			{
				var error =[];
				
				usernameNotExist = true;

				var flag = 0;
				var fname = document.getElementById("fname").value;
				var lname = document.getElementById("lname").value;
				var password = document.getElementById("pass").value;
	
				if(fname.length == 0)
				{
					error.push("Enter First Name...!\n");
				}
				else
				{
					fname = fname.replace(/^\s+/, '').replace(/\s+$/, '');
					if(fname === '')
					{
						error.push("Invalid First Name...!\n");
						document.getElementById("fname").value = null;
					}
				}								
				
				if(lname.length == 0)
				{
					error.push("Enter Last Name...!\n");
				}
				else
				{
					lname = lname.replace(/^\s+/, '').replace(/\s+$/, '');
					if(lname === '')
					{
						error.push("Invalid Last Name...!\n");
						document.getElementById("lname").value = null;
					}
				}
				
				validateEmail(error);
				
				if(document.getElementsByName('accountType')[0].value == 'Select Account Type')
				{
					error.push("Select Account Type...!\n");
				}
				
				if(document.getElementsByName('branches')[0].value == 'Select Branch')
				{
					error.push("Select Branch...!\n");
				}
				
				
				var uname = document.getElementById("uname").value;
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
						document.getElementById("uname").value = null;
					}
				}
				if(password.length == 0)
				{
					error.push("Enter Password...!\n");
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
					register();	
				}
			}
			
			function validateEmail(error)
			{
				var mailField = document.getElementById("email").value;
	
				var atrOfPosition = mailField.search("@");
				var dotPosition = mailField.lastIndexOf(".");
				var mailLength = mailField.length;
	
				if(mailField == "" || mailField == null)
				{
					error.push("Enter Email Address!\n");
				}
				else
				{
					if(atrOfPosition > 0 && dotPosition > 0 && dotPosition < mailLength && (mailLength-dotPosition) >= 3 && atrOfPosition < mailLength && (dotPosition-atrOfPosition) > 1)
					{
						//error.push("Email Address valid");
					}
					else
					{
						error.push("Invalid Email Address\n");
						document.getElementById("email").value = null;
					}
				}
			}
		</script>
</body>
</html>