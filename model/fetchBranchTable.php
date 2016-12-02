<?php 
$conn = new mysqli('localhost', 'root', '', 'restaurent');
if ($conn->connect_error) {
	die("Connection error: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM branch");
if ($result->num_rows > 0) {
		
	while ($row = $result->fetch_assoc()) {
		echo '<tr>';
			echo '<td>'.$row['branch'] . '</td>';
		echo '</tr>';
	}
}
?>
