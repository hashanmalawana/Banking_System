<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<link rel="stylesheet" href="css/styl1.css" >
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Customer Service Officer</title>
</head>

<body>
<div  class="modal" >
<div class="opacity">  
<form class="modal-content " method="post" >
<header>
<h3>Customer Service Officer </h3>
<h2><center>Total Transection</center></h2>
</header>
<?php
session_start();
require_once 'dbconnect.php';
      
$id=$_SESSION['user1']; 
             
$total=  $DBcon->query("SELECT * FROM `transaction` WHERE acc_no='$id' order by trans_id desc");

echo '<table>';
echo '<tr ><th>';
echo 'Date';
echo '</th>';
echo '<th>';
echo 'Deposit/Withdraw';
echo '</th>';
echo '<th>';
echo 'Amount';
echo '</th>';
echo '<th>';
echo 'User Id';
echo '</th>';
echo '</tr>';           
while($row= $total->fetch_array())
{
echo '<tr>';
echo '<td>';
echo $row['date'];
echo '</td>';
echo '<td>';
echo $row['tratype'];
echo '</td>';
echo '<td>';
echo $row['amt'];
echo '</td>';
echo '<td>';
echo $row['user_id'];
echo '</td>';
echo '</tr>';


}


$DBcon->close();
?>

</body>

<footer>

<input type="button" accesskey="b" value="Back"  ONCLICK="window.location.href='cash_tran_home_cus.php' ""/>
</footer>
</form>
</div>
</div>
</html>
