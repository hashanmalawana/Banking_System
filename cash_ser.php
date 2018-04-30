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

if (isset($_POST['btn-branch_open'])) {

$date = strip_tags($_POST['date']);
$date = $DBcon->real_escape_string($date);


$open_query = $DBcon->query("SELECT * FROM branch WHERE date = '$date' and states = 'Open'");
$count = $open_query->num_rows; 


if ($count==1) {

$close_query = $DBcon->query("SELECT * FROM branch WHERE date = '$date' and states = 'Close'");
$count = $close_query->num_rows; 

if ($count==0) {

header("Location: cash_customer_acc.php");
	
}else{

echo "<script>alert('Branch is closed. ')</script>";
}

}
else{

echo "<script>alert('Branch is not Opened. ')</script>";
}
}

$DBcon->close();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/styl.css" >
<title>Cash  :<?php echo  $userRow['user_id']; ?></title>
</head>
<body>

<div  class="modal">
<div class="opacity"> 	
<form class="modal-content " method="POST">
<header>
<h3><b>Cash Officer</b></h3>
<h2> <?php echo " Name  : ".$userRow['name']."</br>"; ?></h2>
</header>

<div class="container"><center>

<input type="hidden" value="<?php  date_default_timezone_set("Asia/Calcutta");
  echo date('y/m/d');?>" name="date" />
<button type="submit" class="button button1"   accesskey="1" name="btn-branch_open" >Til Transaction
</button>
<input type="button" value="Account Details"  accesskey="2" onclick="window.location.href='show_cus_acc_cash.php'" />
<input type="button" value="My Transaction"  accesskey="3" onclick="window.location.href='cash_tran_total_user.php'" />
</center></div>
</body>

<footer>
<div class="container">
<a href="logout.php?logout" style="text-decoration: none;"  accesskey="l" >Logout</a><br>
<a href="shortcut_key.html" target="_blank" style="text-decoration: none;" accesskey="h">Help</a><br>
<a href="change_cash.php" style="text-decoration: none;" accesskey="p" > Change password</a>
</div>
</footer>
</form>
</div>
</div>
</html>

