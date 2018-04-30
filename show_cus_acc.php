<?php
session_start();
require_once 'dbconnect.php';  
     

if(!isset($_SESSION['userSession1'])) {
include_once("logout.php");
exit;
}

$user_id = $_SESSION["userSession1"] ;

$query = $DBcon->query("SELECT * FROM user where user_id= '$user_id'");
$userRow=$query->fetch_array();
        
if(isset($_GET['lgn']))
{
if((isset($_GET['acc_number']))=='')
{
echo '<br>Plz Enter Value  <br> ';  
 } 
      
 else {

$acc_number=$_GET['acc_number'];
           
$_SESSION['login']=$acc_number; 
            
$acc=$DBcon->query("SELECT * FROM `account` WHERE acc_number='$acc_number' ");

$count1=$acc->num_rows;

$Amt1=$DBcon->query("SELECT acc_number FROM account where acc_number='$acc_number'");
 while($row=  $Amt1->fetch_array())
{
 
echo '<br>',$row['acc_number'];
       
$_SESSION['user1']=$row['acc_number'];

} 
            
if($count1>0)
{
    
header('location:cash_tran_home_cus.php');
                
} 
else   
{
echo "<script>alert(' Invalied Account Number')</script>";
}
        
}
}

$DBcon->close();

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/styl.css" >
<title>Customer Service :<?php echo  $userRow['user_id']; ?></title>
</head>
<body>
<div  class="modal">
<div class="opacity">
<form  class="modal-content "  action="show_cus_acc.php">

<header>        
<h3>Customer Service Officer</h3>
<h2><center>Customer  Account Details</center></h2>
</header>
       
<div class="container">      
<h2><font color="black">Account Number:</font></h2>
<input type="text" name="acc_number" placeholder="Account Number" value="" required="" />
</div>

<footer>
<button type="submit" accesskey="e"  name="lgn" >&nbsp; Enter
</button> 
<input type="button" accesskey="c" value="Cancel" ONCLICK="window.location.href='cus_ser.php' ""/>
</footer>        
</form>
</div>      
</div>        
</body>
</html>
