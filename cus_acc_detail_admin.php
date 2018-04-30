<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin </title>
<body>
<div  class="modal">
<div class="opacity"> 
<form class="modal-content " method="post" >

<header>
<h3>Admin</h3>
<h2><center>Customer Account Details</center></h2>
</header>
<div class="container">
<?php

session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession'])) {
   include_once("logout.php");
   exit;
}

$user_id = $_SESSION["userSession"] ;

$query = $DBcon->query("SELECT * FROM user where user_id= '$user_id'");
$userRow=$query->fetch_array();


$query = $DBcon->query("SELECT * FROM account WHERE  cust_id =".$_SESSION['customerSession']);


if($query->num_rows > 0){

$rows=$query->fetch_assoc();

          echo "<b>"."Customer ID   :". $rows['cust_id']."<b>"."</br>"."</br>";
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

</div>
<footer>

<input type="button" value="Back" accesskey="b" onclick="window.location.href='admin_ser.php?back'" />
</footer>
</form>
</div>
</div>            
</body>
</html>