<?php 
session_start();
include_once 'dbconnect.php';

$query = $DBcon->query("SELECT * FROM user WHERE user_id =".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$DBcon->close();

?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin- Delete  </title>

</head>
<body>
<div  class="modal">
<div class="opacity">
<form class="modal-content" method="post" action="">

<header>
<h3>Admin</h3> 
<h2><center>Delete user</center></h2>
</header>          
<div class="container">         
<?php echo "User ID    :". $userRow['user_id']."</br>"; ?>
<?php echo "User Name  : ". $userRow['name']."&nbsp ".$userRow['name1']."</br>"; ?>
<?php echo "Position   :". $userRow['position']; ?>
</div>
<footer>

<center>        
<input type="button" value="Yes" accesskey="y" onclick="window.location.href='del_user.php?user_id=<?php echo $userRow["user_id"]; ?>'" />
         
<input type="button" value="Cancel" accesskey="c" onclick="window.location.href='admin_user_menu.php?back'" />       
</center>
</footer>
</form>
</div>
</div>           
</body>
</html>