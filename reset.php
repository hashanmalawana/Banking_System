<?php 
session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['userSession'])) {
include_once("logout.php");
exit;

$u_id=$_SESSION['userSession'];
$query = $DBcon->query("SELECT * FROM user where user_id= '$u_id'");
$userRow=$query->fetch_array();

}
$user_id = $_SESSION["userSession3"] ;

if(isset($_POST['reset']))
		{
		
$new_pass=$_POST['new_pass'];
		

$hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

$user_id = $_SESSION["userSession3"] ;

$update_pwd=$DBcon->query("UPDATE user set password='$hashed_password' where user_id='$user_id'");

echo "<script>alert('Update Sucessfully'); window.location='admin_ser.php'</script>";
		
}
else
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin </title>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<div  class="modal">
<div class="opacity"> 
<form class="modal-content" method="post" action="">
<header>
<h3>Admin</h3> 
<h2><center>Reset Password</center></h2>
</header>

<h2><font color="#004b66">user id : <?php echo $user_id; ?></font></h2>

<div class="container">
		
New Password :
<input type="password" name="new_pass" placeholder="New Password..." value=""  required />
			

</div>

<footer>
<button type="submit" accesskey="s" name="reset">
&nbsp; Submit
</button>
<input type="button" accesskey="c" value="Cancel" onclick="window.location.href='admin_user_menu.php?back'" />
</footer>	
</form>
</div>
</div>
</body>
</html>