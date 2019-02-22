<?php

session_start();
$link = mysqli_connect('localhost','root','123', 'finalproject');

 if($link === false)
 {
    die("ERROR: Could not connect. " . mysqli_connect_error());
 }

 $sql = "SELECT id, name, qty, price FROM fooditems";
 $result = $link->query($sql);
?>


<script>
function totalcost()
{
    var total = 0;
    var qty = [];
    var price = [];
    var i = 0;
    var tb = document.getElementById('checkouttable');
    for (i = 1; i < tb.rows.length - 3; i++)
    {
        qty[i] = tb.rows[i].cells.item(2).innerHTML;
        price[i] = tb.rows[i].cells.item(3).innerHTML;

        qty[i] = parseFloat(qty[i]);
        console.log(qty[i]);
        price[i] = parseFloat(price[i]);
        console.log(price[i]);

        total = total + qty[i]*price[i];

    }

    return total;
}
function final()
{
    var total = totalcost();
    var tax = total*0.13;
    console.log(total);
    console.log(tax);
    var final = total + tax;
    console.log(final)
    document.getElementById("totalcost").innerHTML = "Total: $" + total.toFixed(2);
    document.getElementById("taxcost").innerHTML = "Tax: $" + tax.toFixed(2);
    document.getElementById("finalcost").innerHTML = "Total: $" + final.toFixed(2);

}</script>
<html>
<link rel="stylesheet" type="text/css" href="innerPage.css">
<head>
    <title>checkout</title>
    <div class="header">
        <h1 class="webTitle">Checkout</h1>
        <div class="links">
            <a class="link1" href="homepage.html">Home Page</a>
            <a class="link1" href="dairy.html">Dairy</a>
            <a class="link1" href="fruits.html">Fruits</a>
            <a class="link1" href="meats.html">Meats</a>
            <a class="link1" href="checkoutpage.php">Cart</a>
        </div>
    </div>
</head>
<body>
    <br><br>
<table id = "checkouttable">
    <thead>
        <tr>
            <th>Id</th>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price ($) ea</th>
            <th>Add/Drop?</th>
        </tr>
    </thead>
    <tbody>
        <!--Use a while loop to make a table row for every DB row-->
        <?php while( $row = $result->fetch_assoc()): ?>
        <tr>
            <!--Each table column is echoed in to a td cell-->
            <td ><?php echo $row['id'] ?></td>
            <td ><?php echo $row['name']; ?></td>
            <td ><?php echo $row['qty']; ?></td>
            <td><?php echo $row['price']; ?> ea. </td>
            <td>
                <form id = "addndrop" action = "adddrop.php" method="GET"><input type="hidden" name="url" value="checkoutpage.php"><input type="submit" name="addbtn" value="+"><input type="hidden" name="add" value = "1"><input type="hidden" name="prownum" value = <?php echo $row['id'] ?> ></form> <form id = "addndrop" action = "adddrop.php" method="GET"><input type="hidden" name="url" value="checkoutpage.php"><input type="submit" name="dropbtn" value = "-"><input type="hidden" name="add" value="-1"><input type="hidden" name="nrownum" value = <?php echo $row['id'] ?> ></form></td>
            
        </tr>

        <?php endwhile ?>
    </tbody>
    <tr>
        <td class = "invis"></td>
        <td class = "invis"></td>
        <td class = "invis"></td>
        <td id = "totalcost"></td>
    </tr>
    <tr>
        <td class = "invis"></td>
        <td class = "invis"></td>
        <td class = "invis"></td>
        <td id = "taxcost"></td>
    </tr>
    <tr>
        <td class = "invis"></td>
        <td class = "invis"></td>
        <td class = "invis"></td>
        <td id = "finalcost"></td>
    </tr>
    
    <script>final();</script>

</table>

<table>
    <form id = "customerInfo" action="customerInfo.php" method="POST">
    <tr>
        <td>Name: <input id = "name" type="name" name = "name" ></td>
        <td>Address: <input id = "address" type="Address" name="address"></td>
        <td>Phone Number: <input id = "phone" type="Phone" name="phone"> <input type="hidden" name="url" value="checkoutpage.php"></td>

    </tr>
    <tr>
        <td><input type="Submit" name="submit" value = "Submit"></td>
    </tr>
    </form>
</table>

</body>
</html>