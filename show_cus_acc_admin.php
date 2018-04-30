<?php
session_start();
require_once 'dbconnect.php';

include_once 'dbconnect.php';

if(!isset($_SESSION['userSession'])) {
   include_once("logout.php");
   exit;
}

$user_id = $_SESSION["userSession"] ;

$query = $DBcon->query("SELECT * FROM user where user_id= '$user_id'");
$userRow=$query->fetch_array();

if (isset($_POST['btn-view'])) {
 
 $cust_id = strip_tags($_POST['cust_id']);
 $cust_id = $DBcon->real_escape_string($cust_id);

 $query = $DBcon->query("SELECT * FROM account WHERE cust_id='$cust_id'");
 $row=$query->fetch_array();
 
 $count = $query->num_rows; 
 
 if ( $count>=1) { 
  $_SESSION['customerSession'] = $row['cust_id'];

 header("Location:cus_acc_detail_admin.php");

}
 else {
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Customer ID !
    </div>";
 }
}


 if (isset($_POST['btn-view'])) {
 
 $nic = strip_tags($_POST['nic']);
 $nic = $DBcon->real_escape_string($nic);

 $query = $DBcon->query("SELECT * FROM customer WHERE nic='$nic'");
 $row=$query->fetch_array();
 
 $count = $query->num_rows; 
 
 if ( $count==1) {
 $_SESSION['customerSession'] = $row['customer_id'];

 header("Location:cus_acc_detail_admin.php");

}
else {
echo "<script>alert('Invalied Customer Id or NIC or Account was not found!')</script>";
 }

 $DBcon->close();
}
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin :<?php echo  $userRow['user_id']; ?></title>
<body>

<div  class="modal">
<div class="opacity">  
<form class="modal-content " method="post" >

<header>
<h3>Admin</h3>     
<h2 ><center> Customer Account Details</center></h2>
</header>
        
<div class="container">
<br>
<input type="text"  placeholder="Customer ID" name="cust_id"  />
        
<h3><font color="black">OR</font></h3>

<input type="text"  placeholder="NIC Number" name="nic" >
        
</div>
 

<footer>
        
<button type="submit" class="btn btn-default" name="btn-view" id="btn-view" accesskey="e" > Enter
</button>       
<input type="button" accesskey="c" value="Cancel" onclick="window.location.href='admin_ser.php?back'" /> 
</footer>   
</form>
</div>
</div>
</body>
</html>