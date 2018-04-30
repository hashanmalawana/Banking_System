<?php
session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['userSession'])) {
include_once("logout.php");
exit;
}



$user_id = $_SESSION["userSession"] ;

$query = $DBcon->query("SELECT * FROM user where user_id= '$user_id'");
$userRow=$query->fetch_array();


if (isset($_POST['btn-view'])) {
 
 $user_id = strip_tags($_POST['user_id']);
 $user_id = $DBcon->real_escape_string($user_id);

 $query = $DBcon->query("SELECT user_id, email, password,position FROM user WHERE user_id='$user_id' ");
 $row=$query->fetch_array();
 
 $count = $query->num_rows; 
 
 if ( $count==1) {
  $_SESSION['userSession3'] = $row['user_id'];

 header("Location: update_user.php");
}
 else {
echo "<script>alert('Invalied User Id ')</script>";
 }
 $DBcon->close();
}
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin :<?php echo  $userRow['user_id']; ?></title>

<body>

<title>Admin :<?php echo  $userRow['user_id']; ?></title>
<div  class="modal">
<div class="opacity">     
<form class="modal-content" method="post" id="view-form">
<header>
<h3>Admin</h3> 
<h2><center>Update User Id</center></h2>
</header>

<div class="container">
<b>User Id:</b>
<input type="text"  placeholder="User Id" name="user_id" required />
      
</div>

 <footer>       
<button type="submit" accesskey="e"  name="btn-view" id="btn-view">
&nbsp; Enter
</button> 
<input type="button" accesskey="c" value="Cancel" onclick="window.location.href='admin_user_menu.php?back'" />
</footer>
</form>  
</div>
</div>
</body>
</html>