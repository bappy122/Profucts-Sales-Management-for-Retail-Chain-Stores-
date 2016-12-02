<?php
	$connection = mysql_connect("localhost", "root", "");
	$db = mysql_select_db("restaurent", $connection);

session_start();
require("C:/xampp/htdocs/project/fpdf/fpdf.php");

date_default_timezone_set('Asia/Dhaka');
$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont("Arial","B",12);
$pdf->Cell(0,0,"Date : ".date("Y/m/d"),0,1);
$pdf->Cell(50,10,"Time : ".date("h:i:sa"),0,1);
$pdf->SetFont("Arial","B",16);
$pdf->Cell(0,10,"ABC Super Store",0,1,'C');
$pdf->SetFont("Arial","B",12);
$pdf->Cell(0,5,"Service By: ".$_SESSION['username'],0,1,'C');
$pdf->Cell(0,5,"Branch : ".$_SESSION['branch'],0,1,'C');
$pdf->Cell(0,5,"road: x, house: x, ".$_SESSION['branch'],0,1,'C');
$pdf->Cell(0,5,"Phone: xxxxxxxxxxx, Tel: xxxxxx",0,1,'C');
$pdf->Cell(0,5,"mail: abc@gmail.com",0,1,'C');

$pdf->Cell(0,25,"Product List",0,1,'C');


//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//------------printing the bill table----------------//
$y_axis_initial = 25;
$y_axis_initial2 = 70;

//print column titles
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetY($y_axis_initial2);
$pdf->SetX(26);
$pdf->Cell(40, 6, 'Name', 1, 0, 'L', 1);
$pdf->Cell(40, 6, 'Price', 1, 0, 'L', 1);
$pdf->Cell(40, 6, 'Quantity', 1, 0, 'L', 1);
$pdf->Cell(40, 6, 'Sub-Total', 1, 0, 'L', 1);

$y_axis = 76;//sdsfsfsds
$row_height = 0;
$y_axis = $y_axis + $row_height;
//$y_axis = $y_axis;

//Select the Products you want to show in your PDF file
$result=mysql_query('select * from bill', $connection);

//initialize counter
$i = 0;

//Set maximum rows per page
$max = 25;

//Set Row Height
$row_height = 6;
$flag = 0; 
while($row = mysql_fetch_array($result))
{
   
  //If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
        $pdf->AddPage();

        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
		
        $pdf->SetX(26);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(40, 6, 'Name', 1, 0, 'L', 1);
		$pdf->Cell(40, 6, 'Price', 1, 0, 'L', 1);
		$pdf->Cell(40, 6, 'Quantity', 1, 0, 'L', 1);
		$pdf->Cell(40, 6, 'Sub-Total', 1, 0, 'L', 1);
        
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
		$flag =1;
    }

    $name = $row['name'];
    $price = $row['price'];
    $quantity = $row['quantity'];
	$subtotal = $row['subtotal'];
	
	if($flag == 1)
	{
		$y_axis = 31;
		$pdf->SetY($y_axis);
		$flag = 0;
	}
	else
	{
		$pdf->SetY($y_axis);
	}
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetX(26);
    $pdf->Cell(40, 6, $name, 1, 0, 'L', 1);
    $pdf->Cell(40, 6, $price, 1, 0, 'L', 1);
	$pdf->Cell(40, 6, $quantity, 1, 0, 'L', 1);
    $pdf->Cell(40, 6, $subtotal, 1, 0, 'L', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}


//total
$result=mysql_query('select SUM(subtotal) as total from bill', $connection);
while($row = mysql_fetch_array($result))
{
    $total = 0;
	$total = $row['total'];
}

//vat
$result=mysql_query('select SUM(subtotal)*0.15 as vat from bill', $connection);
while($row = mysql_fetch_array($result))
{
	$vat = 0;
	$vat = $row['vat'];
}

	$payable = $total + $vat;
	$pdf->SetFont('Arial', 'B', 11);
	$pdf->SetY($y_axis+10);
	$pdf->SetX(120);
	$pdf->Cell(50,8," Total : ".round($total)." Tk.",0,1);
	$pdf->SetX(116);
	$pdf->Cell(50,8,"Vat 15% : ".round($vat)." Tk.",0,1);
	$pdf->SetX(105);
	$pdf->Cell(50,8,"Total Payable : ".round($payable)." Tk.",0,1);
	
//inserting bill detail in central database
$result=mysql_query('select * from bill', $connection);

while($row = mysql_fetch_array($result))
{
	$pid = $row['pid'];
	$category = $row['category'];
	$name = $row['name'];
	$price = $row['price'];
	$quantity = $row['quantity'];
	$subtotal = $row['subtotal'];
	$time = $row['time'];
	$date = $row['date'];
	$branch = $row['branch'];
	$username = $_SESSION['username'];
	
	$result2=mysql_query("INSERT INTO `centralbill`(`pid`,`category`,`name`,`price`,`quantity`,`subtotal`,`time`,`date`,`branch`,`billman`) values('$pid', '$category', '$name' ,'$price', '$quantity', '$subtotal', '$time','$date','$branch','$username')", $connection);
}

$pdf->output();
//clearing the bill table
$result=mysql_query('TRUNCATE TABLE bill', $connection);

mysql_close($connection);
?>