<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Customer Account Details</title>
<body>
<div  class="modal">
<div class="opacity">
<form class="modal-content " method="post" >
<header>
<h3>Cash</h3>
<h2><center>Customer Account Details</center></h2>
</header>
<div class="container">
<b>

<?php

session_start();
include_once 'dbconnect.php';



$query = $DBcon->query("SELECT * FROM account WHERE  cust_id =".$_SESSION['customerSession']);


if($query->num_rows > 0){

$rows=$query->fetch_assoc();

echo "Customer ID   :". $rows['cust_id']."</br>"."</br>";
echo "Create Date   :". $rows['date']."</br>";  
echo "Account Number  : ". $rows['acc_number']."</br>"; 
echo "Account Type  : ". $rows['acc_type']."</br>"."</br>";

while ($row = $query->fetch_assoc()) {
  
        
echo "Create Date   :". $row['date']."</br>";  
echo "Account Number  : ". $row['acc_number']."</br>"; 
echo "Account Type  : ". $row['acc_type']."</br>"."</br>";


}

}

$DBcon->close();

?>
</b>
</div>

<footer>
<input type="button" accesskey="b" value="Back" onclick="window.location.href='cash_ser.php?back'" />
</footer>
</form>
</div>
</div>            
</body>
</html>