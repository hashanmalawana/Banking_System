 <?php

session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['userSession2'])) {
include_once("logout.php");
exit;
}

$user_id = $_SESSION["userSession2"] ;

$query = $DBcon->query("SELECT * FROM user where user_id= '$user_id'");
$userRow=$query->fetch_array();
        
     
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
            
if(isset($_GET["trn"]))
        {
header("location:cash_tran_transection.php");
        }
   
if(isset($_GET["trs"]))
        {
header("location:cash_tran_totaltra.php");
        }
        
        
$DBcon->close();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/styl.css" >     
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Cash  :<?php echo  $userRow['user_id']; ?></title>
</head>
<body>
<div  class="modal">
<div class="opacity"> 
<form class="modal-content " method="get" action="cash_tran_home.php">
<header>
<h3>Cash</h3>
<h2 ><center>Account Details</center></h2></header>
<div class="container">
 <input type="submit" accesskey="1" value="Transection" name="trn" />
   
 <input type="submit" accesskey="2" value="All Transection" name="trs" />   
</div>
<div class="container"> 

<h4>Name : <?php   echo  $customerRow['name'].' '.$customerRow['name1'].' '.$customerRow['name2'];?><br>
	Account Number : <?php echo $id ;?><br>
    Your  balance is : Rs. <?php echo $formattedNum3 ;?>
    
</h4>   


<table>
<tr>
<td>  </td>
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
</body>

</div>
<footer>

<input type="button" accesskey="b" value="Back" name="back"ONCLICK="window.location.href='cash_customer_acc.php' ""/>
</footer>
</form>
</div>
</div>
</html>
