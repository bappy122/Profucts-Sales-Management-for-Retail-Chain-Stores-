<?php 

$conn = new mysqli('localhost', 'root', '', 'restaurent');

if ($conn->connect_error) 
{
	die("Connection error: " . $conn->connect_error);
}

if(isset($_POST['total']))
{
	$result = $conn->query("SELECT SUM(subtotal) AS total FROM bill");
	if ($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc()) {
			echo 'Total : '.$row['total'];
		}
	}
	else
	{
		echo "Total : 0";
	}
}

else if(isset($_POST['vat']))
{
	$result = $conn->query("SELECT SUM(subtotal) AS total FROM bill");
	if ($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc()) {
			echo'Vat 15%: '.((float)$row['total']*.15);
		}
	}
	else
	{
		echo "Total : 0";
	}		
}

else if(isset($_POST['afterVat']))
{
	$result = $conn->query("SELECT SUM(subtotal) AS total FROM bill");
	if ($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc()) {
			$total = (float)$row['total'];
			echo'Total : '.($total + (float)$row['total']*0.15);
		}
	}
	else
	{
		echo "Total : 0";
	}	
}

else if(isset($_POST['removeBill']))
{
	$result = $conn->query("DELETE FROM bill where id = '".$_POST['id']."'");
}

else if(isset($_POST['clearBillTable']))
{
	$result = $conn->query("TRUNCATE TABLE bill");
}

else
{
	$result = $conn->query("SELECT `id`,`name`,`price`,`quantity`,`subtotal` FROM bill" );
		echo'<tr>';
		echo'<th>Name</th>';
		echo'<th>Price</th>';
		echo'<th>Quantity</th>';
		echo'<th>Sub-Total</th>';
		echo'<th>Action</th>';
		echo'</tr>';
		$i = 0;
		while ($row = $result->fetch_assoc()) {
			
			$i += 1;
			echo '<tr>';
			echo '<td>'.$row['name'] . '</td>';
			echo '<td>'.$row['price'] . '</td>';
			echo '<td>'.$row['quantity'] . '</td>';
			echo '<td>'.$row['subtotal'] . '</td>';
			echo '<td> <input type= "Button" onclick = "deleteFromBill(this)" name ='.$row['id'].' id='.$i.' value = "delete"> </td>';
			echo '</tr>';
		}
}

?>	