<?php


$url = $_GET['url'];
echo $url;
header('Location:'.$url);
session_start();
$link = mysqli_connect('localhost','root','123', 'finalproject');

if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

 $sql = "SELECT id, name, qty, price FROM fooditems";

// Attempt insert query execution

$add = $_GET['add'];
echo $add;
if($add == 1)
{
	$row = $_GET['prownum'];
}
else{
	$row = $_GET['nrownum'];
}

$query = mysqli_query($link,"SELECT * FROM fooditems WHERE id = $row");
$qty = mysqli_fetch_array($query);

$current=$qty[5];
echo $current;

if ($add == 1) {
	$current = $current + 1;
}
else
{
	if($current >= 1){
	$current = $current - 1;
}
	else
	{
		$current = $current;
	}
}

echo $current;


$sql = "UPDATE fooditems SET qty = '$current' WHERE id = $row";


if(mysqli_query($link, $sql))
{
    echo "Records inserted successfully.";
} 
else
{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

 
// Close connection
mysqli_close($link);

?>