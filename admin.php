
<?php 
session_start();
include_once 'dbconnect.php';

 if(!isset($_SESSION['userSession'])) {
   include_once("logout.php");
   exit;
}

$user_id = $_SESSION["userSession"] ;

$query = $DBcon->query("SELECT * FROM user WHERE user_id =".$_SESSION['userSession3']);
$userRow=$query->fetch_array();
$DBcon->close();

?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin :<?php echo  $_SESSION["userSession"]; ?></title>
</head>
<body>

<div  class="modal"> 
<div class="opacity"> 
<form class="modal-content">
<header>
<h3>Admin</h3>  
<h2 ><center>User Details</center></h2>
</header>	

<div class="container">

<table>
<tr>
<td><font color="#004b66">User ID</font></td>
<td><?php echo ":". $userRow['user_id']; ?></td>
</tr>

<tr>
<td><font color="#004b66">User Name</font></td>
<td><?php echo ":". $userRow['name']."&nbsp". $userRow['name1']; ?></td>
</tr>

<tr>
<td><font color="#004b66">E-Mail</font></td>
<td><?php echo ":". $userRow['email']; ?></td>
</tr>

<tr>
<td><font color="#004b66">Position</font></td>
<td><?php echo ":". $userRow['position']; ?></td>
</tr>
</table>
</div>

<footer>
<input type="button" accesskey="b" value="Back" onclick="window.location.href='admin_user_menu.php?back'" />
</footer>

</form>         
</div>        
</body>
</html>