<?php
// Start the session
session_start();
require_once('include.php');
$auth = new Authentication;
if (!$auth->isLoggedOn()) {
  header('Location: login.php');
  exit();
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<title>Home</title>
<link href="styles.css" rel='stylesheet' type='text/css'>
<script>

function loadProducts() {
  // Get the list of games from the database
	var request = new XMLHttpRequest();
	var requestUrl = 'games_ajax.php'
	request.open('GET', requestUrl);
	request.responseType = 'text'; // now we're getting a string!
	request.send();

	request.onload = function() {
	  var productText = request.response; // get the string from the response
	  var productArray= JSON.parse(productText); // convert it to an object
	  processRecords(productArray);
	}
}
function changeStock(id, Current){
  // Update the stock level
  var new_stock = prompt("Enter new stock", Current);
  if (new_stock != null) {
    var formData = new FormData();
    formData.append('id', id);
    formData.append('stock', new_stock);
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function()
    {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            var status = xmlHttp.responseText;
            status = status.replace(/^\n|\n$/g, '');
            if (status == 'ok') {
              loadProducts();
            }
        }
    }
    xmlHttp.open("post", "games_update.php");
    xmlHttp.send(formData);


  }
}
function drawStock(cell, Stock, id) {
  // Draw the stock cell - including javascript for stock update
  newlink = document.createElement('a');
  newlink.setAttribute('class', 'signature');
  newlink.setAttribute('href', 'javascript:changeStock(' + id + ', '+ Stock +')');
  newlink.innerHTML=Stock;
  cell.appendChild(newlink);
}
function processRecords(dataArray) {
  // Take the products and insert into the table
  var table = document.getElementById("games");
  var rowCount = table.rows.length;
  for (var i = 0; i < rowCount; i++) {
      table.deleteRow(0);
  }
  for (i = 0; i < dataArray.length; i++) {
  	var row = table.insertRow(-1);
  	var cell1 = row.insertCell(0);
  	var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
  	cell1.innerHTML = dataArray[i]['Title'];
    cell2.innerHTML = dataArray[i]['Publisher'];
    drawStock(cell3, dataArray[i]['Stock'], dataArray[i]['ID']);
    cell4.innerHTML = dataArray[i]['Price'];
  }
}
function startup() {
  loadProducts();
  setInterval(loadProducts, 300000); // Reload stock every 5 minutes
}
</script>
</head>
<body onload="startup()">
<div class="mainContainer">
<a href="logoff.php" class="logoff">Log off</a>
<h1>Current Stock</h1>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Publisher</th>
      <th style="text-align: center;">Stock</th>
      <th style="text-align: center;">Price</th>
    </tr>
  </thead>
  <tbody ID="games">
  </tbody>
</table>
</div>
</body>
</html>
