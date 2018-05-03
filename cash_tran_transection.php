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

$select_photo = $DBcon->query("SELECT * FROM account where acc_number ='$id'");
$imageRow=$select_photo->fetch_array(); 


$_SESSION['user']=$DBcon->query("SELECT ((SELECT COALESCE(SUM(amt),0) FROM `transaction` WHERE tratype = 'deposit' AND acc_no ='$id') - (SELECT COALESCE( SUM( amt ),0) FROM `transaction` WHERE tratype = 'withdraw' AND acc_no ='$id' )) AS tbalance ");

$row = $_SESSION['user']->fetch_array();
$tbalance=$row["tbalance"]; 
$formattedNum3 = number_format($tbalance, 2);

$_SESSION['user']=$formattedNum3;

// for deposit

if(isset($_GET['ds']))
            {
$enamt=$_GET['text1'];
$formattedNum = number_format($enamt, 2);
$balance = $tbalance + $enamt;
$formattedNum4 = number_format($balance, 2);
$d='deposit';

$DBcon->query("INSERT INTO transaction (`acc_no`, `tratype`, `amt`,`balance`,`user_id`) VALUES ('$id','$d','$enamt','$balance','$user_id')");
            

            
echo "<script>alert(' Cash deposit successful'); window.location='cash_customer_acc.php'</script>";
            
}

if(isset($_GET['wd'])){
                 
$enamt=$_GET['text1'];
$formattedNum = number_format($enamt, 2);
$_SESSION['user'];
$balance = $tbalance - $enamt;
$formattedNum4 = number_format($balance, 2);            
if($formattedNum3 > 0)
{
//for withdraw 


$d='withdraw';
$DBcon->query("INSERT INTO transaction(`acc_no`, `tratype`, `amt`,`balance`,`user_id`) VALUES ('$id','$d','$enamt','$balance','$user_id')");

echo "<script>alert(' Cash withdraw successful'); window.location='cash_customer_acc.php'</script>";
            
         
}else
{
                
echo '<br>No Amount Balance';
                
}
            
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

<img  class="sticky" src="./upload/<?php echo  $imageRow['name']; ?>" alt="Customer Image"  >
<body>




<div  class="modal">
<div class="opacity"> 
<form class="modal-content " method="get" action="cash_tran_transection.php">   
<header>
<h3>Cash Service Officer</h3>
<h2 ><center>Transection Details</center></h2>
</header>
<div class="container">

<h3><font color="black">Account Number :<?php echo $id ;?><br>
Balance is Rs.: <?php echo $formattedNum3 ;?>
</font></h3>
</div> 
<div class="container"> 
Amount  : 

<input type="hidden" name="user_id" value="user" />
<input type="text" name="text1" placeholder="Rs." id="text1" value="" required />
</div>
<div class="container"> 
<input type="submit" accesskey="q" value="Deposit" name="ds"> 
<input type="submit" accesskey="w" value="WithDraw" name="wd">
</div>
</body>  
 
    
<footer>

<input type="button" accesskey="b"  value="Back"  ONCLICK="window.location.href='cash_customer_acc.php' ""/>
</footer>            
</form>
</div>
</div> 
</html>
