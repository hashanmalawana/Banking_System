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

if (isset($_POST['btn-branch_open'])) {

$date = strip_tags($_POST['date']);
$date = $DBcon->real_escape_string($date);


$open_query = $DBcon->query("SELECT * FROM branch WHERE date = '$date' and states = 'Open'");
$count = $open_query->num_rows; 


if ($count==1) {

$close_query = $DBcon->query("SELECT * FROM branch WHERE date = '$date' and states = 'Close'");
$count = $close_query->num_rows; 

if ($count==0) {

header("Location: cash_customer_acc_admin.php");
	
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
 
<title><?php echo $userRow['position']." :". $userRow['user_id']; ?></title>

</head>
<body>

<div  class="modal"> 	
<div class="opacity">
<form class="modal-content " method="POST">
<header>
<h3>Admin</h3>

<h2><?php echo " Name  : ".$userRow['name']; ?> <br>  </h2>
</header>

<input type="hidden" value="<?php echo date('y/m/d');?>" name="date" />


<div class="container">
<input type="button" accesskey="1" value="Create Account" onclick="window.location.href='create_acc.php'" />
<input type="button" accesskey="2" value="Add Customer" onclick="window.location.href='add_cus1.php'" />
<input type="button" accesskey="3" value="Customer Details" onclick="window.location.href='show_cus_cid.php'" />
<input type="button" accesskey="4" value="Account Details" onclick="window.location.href='show_cus_acc_admin.php'" />
<input type="button" accesskey="5" value="User Details" onclick="window.location.href='admin_user_con.php'" />
<button type="submit" accesskey="6" class="button button1" name="btn-branch_open" style="width:13% " >Transaction
</button>
<input type="button" value="Branch Details" onclick="window.location.href='branch_details.php'" />

 </div>
<footer>

<div class="container">
<a href="logout.php?logout" style="text-decoration: none;" accesskey="l">Log out</a><br>
<a href="shortcut_key.html" target="_blank" style="text-decoration: none;" accesskey="h">Help</a><br>
<a href="change.php" style="text-decoration: none;" accesskey="p"> Change password</a><br>
</div>   
</footer>    
</form> 
</div>
</div>
</body>
</html>