<?php 
$conn = new mysqli('localhost', 'root', '', 'restaurent');
if ($conn->connect_error) {
	die("Connection error: " . $conn->connect_error);
}

session_start();

if(isset($_POST['search']))
{

if(isset($_POST['search']) && $_SESSION['branch'] == 'ADMIN')
{

	
	$result = $conn->query("SELECT * FROM centralbill where `subtotal` LIKE '%". $_POST['searchText']."%' OR `branch` LIKE '%". $_POST['searchText']."%' OR `billman` LIKE '%". $_POST['searchText']."%' OR `date` LIKE '%". $_POST['searchText']."%' OR `time` LIKE '%". $_POST['searchText']."%' OR `pid` LIKE '%". $_POST['searchText']."%' OR `name` LIKE '%". $_POST['searchText']."%' OR `category` LIKE '%". $_POST['searchText']."%' OR `price` LIKE '%". $_POST['searchText']."%' ");

	//managers, who can see only their branch
	//$result = $conn->query("SELECT * FROM `centralbill` where `subtotal` LIKE '%". $_POST['searchText']."%' OR `billman` LIKE '%". $_POST['searchText']."%' OR `date` LIKE '%". $_POST['searchText']."%' OR `time` LIKE '%". $_POST['searchText']."%' OR `pid` LIKE '%". $_POST['searchText']."%' OR `name` LIKE '%". $_POST['searchText']."%' OR `category` LIKE '%". $_POST['searchText']."%' OR `price` LIKE '%". $_POST['searchText']."%' AND `branch` LIKE '".$_SESSION['branch']."'");



	//$result = $conn->query("select * from centralbill");
	if ($result->num_rows > 0) 
	{
		echo'<tr>';
			echo'<th>Product ID</th>';
			echo'<th>Category</th>';
			echo'<th>Name</th>';
			echo'<th>Price</th>';
			echo'<th>Quantity</th>';
			echo'<th>Sub-total</th>';
			echo'<th>Time</th>';
			echo'<th>Date</th>';
			echo'<th>Branch</th>';
			echo'<th>Salesman</th>';

		echo'</tr>';
	
		while ($row = $result->fetch_assoc()) {
			echo '<tr>';
			echo '<td>'.$row['pid'] . '</td>';
			echo '<td>'.$row['category'] . '</td>';
			echo '<td>'.$row['name'] . '</td>';
			echo '<td>'.$row['price'] . '</td>';
			echo '<td>'.$row['quantity'] . '</td>';
			echo '<td>'.$row['subtotal'] . '</td>';
			echo '<td>'.$row['time'] . '</td>';
			echo '<td>'.$row['date'] . '</td>';
			echo '<td>'.$row['branch'] . '</td>';
			echo '<td>'.$row['billman'] . '</td>';
			echo '</tr>';
		}
	}
	else
	{
		echo"No Products Found";
	}
}


else if(isset($_POST['search']) && $_SESSION['branch'] != 'ADMIN')
{
	$result = $conn->query("SELECT * FROM centralbill where (`subtotal` LIKE '%". $_POST['searchText']."%' OR `billman` LIKE '%". $_POST['searchText']."%' OR `date` LIKE '%". $_POST['searchText']."%' OR `time` LIKE '%". $_POST['searchText']."%' OR `pid` LIKE '%". $_POST['searchText']."%' OR `name` LIKE '%". $_POST['searchText']."%' OR `category` LIKE '%". $_POST['searchText']."%' OR `price` LIKE '%". $_POST['searchText']."%') AND `branch`='".$_SESSION['branch']."'");

	if ($result->num_rows > 0) 
	{
		echo'<tr>';
			echo'<th>Product ID</th>';
			echo'<th>Category</th>';
			echo'<th>Name</th>';
			echo'<th>Price</th>';
			echo'<th>Quantity</th>';
			echo'<th>Sub-total</th>';
			echo'<th>Time</th>';
			echo'<th>Date</th>';
			echo'<th>Branch</th>';
			echo'<th>Salesman</th>';

		echo'</tr>';
	
		while ($row = $result->fetch_assoc()) {
			echo '<tr>';
			echo '<td>'.$row['pid'] . '</td>';
			echo '<td>'.$row['category'] . '</td>';
			echo '<td>'.$row['name'] . '</td>';
			echo '<td>'.$row['price'] . '</td>';
			echo '<td>'.$row['quantity'] . '</td>';
			echo '<td>'.$row['subtotal'] . '</td>';
			echo '<td>'.$row['time'] . '</td>';
			echo '<td>'.$row['date'] . '</td>';
			echo '<td>'.$row['branch'] . '</td>';
			echo '<td>'.$row['billman'] . '</td>';
			echo '</tr>';
		}
	}
	else
	{
		echo"No Products Found";
	}	
}
}

else if($_SESSION['branch']=='ADMIN')
{
	$result = $conn->query("SELECT * FROM centralbill");

	if ($result->num_rows > 0) 
	{
		echo'<tr>';
			echo'<th>Product ID</th>';
			echo'<th>Category</th>';
			echo'<th>Name</th>';
			echo'<th>Price</th>';
			echo'<th>Quantity</th>';
			echo'<th>Sub-total</th>';
			echo'<th>Time</th>';
			echo'<th>Date</th>';
			echo'<th>Branch</th>';
			echo'<th>Salesman</th>';
		echo'</tr>';
	
		while ($row = $result->fetch_assoc()) {
			echo '<tr>';
			echo '<td>'.$row['pid'] . '</td>';
			echo '<td>'.$row['category'] . '</td>';
			echo '<td>'.$row['name'] . '</td>';
			echo '<td>'.$row['price'] . '</td>';
			echo '<td>'.$row['quantity'] . '</td>';
			echo '<td>'.$row['subtotal'] . '</td>';
			echo '<td>'.$row['time'] . '</td>';
			echo '<td>'.$row['date'] . '</td>';
			echo '<td>'.$row['branch'] . '</td>';
			echo '<td>'.$row['billman'] . '</td>';
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
	$result = $conn->query("SELECT * FROM centralbill where branch = '".$_SESSION['branch']."'");

	if ($result->num_rows > 0) 
	{
		echo'<tr>';
			echo'<th>Product ID</th>';
			echo'<th>Category</th>';
			echo'<th>Name</th>';
			echo'<th>Price</th>';
			echo'<th>Quantity</th>';
			echo'<th>Sub-total</th>';
			echo'<th>Time</th>';
			echo'<th>Date</th>';
			echo'<th>Branch</th>';
			echo'<th>Salesman</th>';
		echo'</tr>';
	
		while ($row = $result->fetch_assoc()) {
			echo '<tr>';
			echo '<td>'.$row['pid'] . '</td>';
			echo '<td>'.$row['category'] . '</td>';
			echo '<td>'.$row['name'] . '</td>';
			echo '<td>'.$row['price'] . '</td>';
			echo '<td>'.$row['quantity'] . '</td>';
			echo '<td>'.$row['subtotal'] . '</td>';
			echo '<td>'.$row['time'] . '</td>';
			echo '<td>'.$row['date'] . '</td>';
			echo '<td>'.$row['branch'] . '</td>';
			echo '<td>'.$row['billman'] . '</td>';
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
