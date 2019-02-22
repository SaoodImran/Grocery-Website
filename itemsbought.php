<?php


$url = $_POST['url'];
echo $url;
header('Location:'.$url);
session_start();
$link = mysqli_connect('localhost','root','123', 'finalproject');

if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


// Attempt insert query execution
$qty = $_POST['q'];
$text = $_POST['item1'];
$price = $_POST['price1'];
$sql = "INSERT INTO fooditems(name, qty, price) VALUES ('$text', '$qty', '$price')";
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