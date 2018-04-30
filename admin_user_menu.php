
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
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<title><?php echo $userRow['position']." :". $userRow['user_id']; ?></title>
<body>

<div  class="modal"> 
<div class="opacity">	
<form class="modal-content ">
<header>
<h3><b>Admin</b></h3>	
<h2><center>User Details</center></h2>
</header>
<div class="container"><center>
<input type="button"  accesskey="1" value="Add User" onclick="window.location.href='add_user.php'" />
<input type="button" accesskey="2" value="User Details" onclick="window.location.href='user_detail.php'" />
<input type="button" accesskey="3" value="Update User" onclick="window.location.href='update_user_find.php'" />
<input type="button" accesskey="4" value="Delete User" onclick="window.location.href='delete_user.php'" />
<input type="button" accesskey="5" value="Reset passwords" onclick="window.location.href='reset_admin.php'" />
</div></center>
<footer>
<input type="button" accesskey="b" value="Back" onclick="window.location.href='admin_ser.php?back'" />
 </footer>      
</form> 
</div>
</div>
</body>
</html>