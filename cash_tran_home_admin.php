<?php
session_start();
require_once 'dbconnect.php';
if(!isset($_SESSION['user1'])) {
include_once("logout.php");
exit;
}
$id=$_SESSION['user1']; 

$joinquery = $DBcon->query("SELECT  account.*,customer.* FROM  customer INNER JOIN account ON customer.customer_id=account.cust_id WHERE account.acc_number =".$id);
 
if($joinquery->num_rows > 0){

$customerRow=$joinquery->fetch_assoc();

}
     
$z=$DBcon->query("SELECT ((SELECT COALESCE(SUM(amt),0) FROM `transaction` WHERE tratype = 'deposit' AND acc_no ='$id') - (SELECT COALESCE( SUM( amt ),0) FROM `transaction` WHERE tratype = 'withdraw' AND acc_no ='$id' )) AS tbalance ");
          
$row = $z->fetch_array();
$tbalance=$row["tbalance"]; 
$formattedNum3 = number_format($tbalance, 2);
$_SESSION['z']=$row["tbalance"];


$DBcon->close();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/styl.css" >
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Admin</title>
</head>
<body>
<div  class="modal">
<div class="opacity"> 
<form class="modal-content " method="post" action="cash_tran_home_admin.php">
<header>
<h3>Admin</h3>
<h2 ><center>Account Details</center></h2>
</header>
<div class="container">
<input type="button" value="All Transection" name="back"ONCLICK="window.location.href='cash_tran_totaltra_admin.php' ""/>
</div>

<div class="container"> 

<b>Account Number :<?php echo $id; ?></br>
Balance Rs. :<?php echo $formattedNum3; ?></b>
</div>
<div class="container"> 
<table>
<tr>
<td>Name   </td>
<td> <?php   echo  $customerRow['name'].' '.$customerRow['name1'].' '.$customerRow['name2'];?> </td>
</tr>
<tr>
<td>Address  </td>
<td> <?php   echo  $customerRow['address'].' '.$customerRow['address1'].' '.$customerRow['address2'].' '.$customerRow['address3'];?> </td>
</tr>
<tr>
<td>NIC No  </td>
<td> <?php   echo  $customerRow['nic'];?> </td>
</tr>
<tr>
<td>Birthday  </td>
<td> <?php   echo  $customerRow['birthday'];?> </td>
</tr>
<tr>
<td>E-Mail Address  </td>
<td> <?php   echo  $customerRow['email'];?> </td>
</tr>
</table>
</div>
</body>
<footer>

<input type="button" accesskey="b" value="Back" name="back"ONCLICK="window.location.href='cash_customer_acc_admin.php' ""/>

</footer>
</form> 
</div>
</div>
</html>
