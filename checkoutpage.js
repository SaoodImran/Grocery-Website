
function totalcost()
{
	var total = 0;
	var qty[];
	var price[];
	var i;
	var tb = document.getElementById('checkouttable');
	for (i = 1; i < tb.rows.length - 3; i++)
	{
		qty[i] = tb.rows[i].cells.item(1).innerHTML;
		price[i] = tb.rows[i].cells.item(2).innerHTML;
		qty[i] = parseFloat(qty[i]);
		price[i] = parseFloat(price[i]);

		total = total + qty[i]*price[i];

	}
	return total;
}
function final()
{
	console.log("work");
	var total = totalcost();
	console.log(totalcost);
	var tax = total*0.13;
	var final = total + tax;
	document.getElementById("totalcost").innerHTML = "Total: $" + total.toFixed(2);
	document.getElementById("taxcost").innerHTML = "Tax: $" + tax.toFixed(2);
	document.getElementById("totalcost").innerHTML = "Total: $" + final.toFixed(2);

}
