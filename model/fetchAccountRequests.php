<?php 
session_start();

$conn = new mysqli('localhost', 'root', '', 'restaurent');
if ($conn->connect_error) {
	die("Connection error: " . $conn->connect_error);
}

$result = '';
$branch = $_SESSION['branch'];

if($_SESSION['branch'] == 'ADMIN')
{
	$result = $conn->query("SELECT * FROM `accountrequest` where `type` = 'Manager'");
	if($result->num_rows > 0) 
	{
		echo'<tr>';
			//echo'<th>Request ID</th>';
			echo'<th>First Name</th>';
			echo'<th>Last Name</th>';
			echo'<th>Email</th>';
			echo'<th>Branch</th>';
			echo'<th>Account Type</th>';
			echo'<th>Username</th>';
			echo'<th>Action</th>';
			echo'<th>Action</th>';
		echo'</tr>';
		$i = 0;
	
		while ($row = $result->fetch_assoc()) {
			$i += 1;
			echo '<tr>';
			//echo '<td>'.$row['id'] . '</td>';
			echo '<td>'.$row['fname'] . '</td>';
			echo '<td>'.$row['lname'] . '</td>';
			echo '<td>'.$row['email'] . '</td>';
			echo '<td>'.$row['branch'] . '</td>';
			echo '<td>'.$row['type'] . '</td>';
			echo '<td>'.$row['uname'] . '</td>';
			echo '<td><input type = "button" onclick = "approve(this)" name = "'.$row['id'].'" id = "'.i.'"  value = "approve"> </td>';
			echo'<td><input type = "button" onclick = "discard(this)" name = "'.$row['id'].'" id = "'.i.'" value = "discard"></td>';
			echo '</tr>';
		}
	}
	else
	{
		echo"No Request Found";
	}
}
else
{
	$result = $conn->query("SELECT * FROM `accountrequest` where `type` = 'Salesman' AND `branch` = '".$branch."'");
	//$result = $conn->query("SELECT * FROM `accountrequest` where `type` = 'Manager'");
	if($result->num_rows > 0) 
	{
		echo'<tr>';
			//echo'<th>Request ID</th>';
			echo'<th>First Name</th>';
			echo'<th>Last Name</th>';
			echo'<th>Email</th>';
			echo'<th>Branch</th>';
			echo'<th>Account Type</th>';
			echo'<th>Username</th>';
			echo'<th>Action</th>';
			echo'<th>Action</th>';
		echo'</tr>';
		$i = 0;
	
		while ($row = $result->fetch_assoc()) {
			$i += 1;
			echo '<tr>';
			//echo '<td>'.$row['id'] . '</td>';
			echo '<td>'.$row['fname'] . '</td>';
			echo '<td>'.$row['lname'] . '</td>';
			echo '<td>'.$row['email'] . '</td>';
			echo '<td>'.$row['branch'] . '</td>';
			echo '<td>'.$row['type'] . '</td>';
			echo '<td>'.$row['uname'] . '</td>';
			echo '<td><input type = "button" onclick = "approve(this)" name = "'.$row['id'].'" id = "'.i.'"  value = "approve"> </td>';
			echo'<td><input type = "button" onclick = "discard(this)" name = "'.$row['id'].'" id = "'.i.'" value = "discard"></td>';
			echo '</tr>';
		}
	}
	else
	{
		echo"No Request Found";
	}
}



mysqli_close($conn);
?>
