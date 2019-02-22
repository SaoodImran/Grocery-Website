<?php


$url = $_POST['url'];
echo $url;
header('Location:'.$url);
session_start();
$link = mysqli_connect('localhost','guest','123', 'finalproject');

if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

 $sql = "SELECT name, qty, price FROM fooditems";
 $result = $link->query($sql);

	$cnt = $result->num_rows;
	echo $cnt;

// Attempt insert query execution
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$id = 1;

while ($id <= $cnt) 
{
	$sql = "UPDATE `fooditems` SET `guest` = '$name',`address`= '$address',`phone`= '$phone' WHERE $id";
	$id = $id + 1;
	echo $id;
}


if(mysqli_query($link, $sql))
{
    echo "Records inserted successfully.";
} 
else
{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


$sql2 = "INSERT INTO guest SELECT * from fooditems";

if ($link->query($sql2) === TRUE) {
    echo " copied gud,";
} else {
    echo "Error filling table: " . $link->error;
}

$sql3 = "TRUNCATE TABLE fooditems";

if ($link->query($sql3) === TRUE) {
    echo " table cleard";
} else {
    echo "Error clearing table: " . $link->error;
}
 
// Close connection
mysqli_close($link);

?>