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
$DBcon->close();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/styl3.css" >
<title><?php echo $userRow['position']." :". $userRow['user_id']; ?></title>

</head>
<body>

<div  class="modal"> 	
<div class="opacity">
<form class="modal-content ">
<header>
<h3>Admin</h3>

<h2><center>Branch Details</center></h2>
</header>
<br>
<div class="container">
<center>
<input type="button" accesskey="1" value="Branch Summary" onclick="window.location.href='branch_summary.php'" />
<input type="button" accesskey="2" value="Branch Open/Close" onclick="window.location.href='branch_open.php'" />
<input type="button" accesskey="3" value="Summary - Charts" onclick="window.location.href='chart_balance.php'" />

</center></div>


<footer>


<input type="button" accesskey="c" value="Cancel" onclick="window.location.href='admin_ser.php?back'" />
 
</footer>    
</form> </div>
</div>
</body>


</html>