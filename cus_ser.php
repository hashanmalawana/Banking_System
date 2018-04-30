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
$DBcon->close();
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/styl.css" >
<head>
<title>Customer Service  :<?php echo  $userRow['user_id']; ?></title>
</head>
<body>

<div  class="modal">
<div class="opacity"> 	
<form class="modal-content ">
<header>
<h3><b>Customer Service Officer</b></h3>
<h2> <?php echo " Name  : ".$userRow['name']."</br>"; ?></h2>
</header>
<div class="container"><center>
<input type="button"   accesskey="1" value="Add Customer" onclick="window.location.href='add_cus.php'" />
<input type="button"  accesskey="2" value="Customer Details" onclick="window.location.href='show_cus_cid1.php'" />
<input type="button"  accesskey="3" value="Account Details" onclick="window.location.href='show_cus_acc.php'" />
</center>
</div>
</body>
<footer>

<div class="container">
<a href="logout.php?logout" style="text-decoration: none;" accesskey="l" >&nbsp; Logout</a><br>
<a href="shortcut_key.html" target="_blank" style="text-decoration: none;" accesskey="h">&nbsp; Help</a><br>
<a href="change_cus.php" style="text-decoration: none;" accesskey="p" >&nbsp; Change password</a>
</div>
</footer>            
</form>
</div>
</div>
</body>
</html>