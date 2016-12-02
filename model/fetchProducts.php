<?php 
session_start();
$conn = new mysqli('localhost', 'root', '', 'restaurent');
if ($conn->connect_error) {
	die("Connection error: " . $conn->connect_error);
}

if(isset($_POST['search']))
{
	if($_SESSION['branch']== "ADMIN")
	{
		$result = $conn->query("SELECT * FROM product where `pid` LIKE '%". $_POST['searchText']."%' OR `name` LIKE '%". $_POST['searchText']."%' OR `category` LIKE '%". $_POST['searchText']."%' OR `price` LIKE '%". $_POST['searchText']."%' OR `branch` LIKE '%". $_POST['searchText']."%' ");
	}
	else
	{
		$result = $conn->query("SELECT * FROM product where (`pid` LIKE '%". $_POST['searchText']."%' OR `name` LIKE '%". $_POST['searchText']."%' OR `category` LIKE '%". $_POST['searchText']."%' OR `price` LIKE '%". $_POST['searchText']."%') AND (`branch`='".$_SESSION['branch']."') ");
	}
	
	if ($result->num_rows > 0) 
	{
		echo'<tr>';
		echo'<th>Product ID</th>';
		echo'<th>Category</th>';
		echo'<th>Name</th>';
		echo'<th>Price</th>';
		
		if($_SESSION['branch']=="ADMIN")
		{
			echo'<th>Branch</th>';
		}
			
		echo'</tr>';
	
		while ($row = $result->fetch_assoc()) {
			echo '<tr>';
			echo '<td>'.$row['pid'] . '</td>';
			echo '<td>'.$row['category'] . '</td>';
			echo '<td>'.$row['name'] . '</td>';
			echo '<td>'.$row['price'] . '</td>';
			
			if($_SESSION['branch']=="ADMIN")
			{
				echo '<td>'.$row['branch'] . '</td>';
			}
			
			echo '</tr>';
		}
	}
	else
	{
		echo"No Products Found";
	}
}
else
{
	
	if($_SESSION['branch']=="ADMIN")
	{
		$result = $conn->query("SELECT * FROM product");
	}
	else
	{
		$result = $conn->query("SELECT * FROM product where `branch` LIKE '".$_SESSION['branch']."'");
	}

	if ($result->num_rows > 0) 
	{
		echo'<tr>';
			echo'<th>Product ID</th>';
			echo'<th>Category</th>';
			echo'<th>Name</th>';
			echo'<th>Price</th>';
			
			if($_SESSION['branch']=="ADMIN")
			{
				echo'<th>Branch</th>';
			}
			
		echo'</tr>';
	
		while ($row = $result->fetch_assoc()) {
			echo '<tr>';
			echo '<td>'.$row['pid'] . '</td>';
			echo '<td>'.$row['category'] . '</td>';
			echo '<td>'.$row['name'] . '</td>';
			echo '<td>'.$row['price'] . '</td>';
			
			if($_SESSION['branch']=="ADMIN")
			{
				echo '<td>'.$row['branch'] . '</td>';
			}
			
			echo '</tr>';
		}
	}
	else
	{
		echo"No Products Found";
	}
}
mysqli_close($conn);
?>
