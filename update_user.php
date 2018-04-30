<?php 
session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['userSession'])) {
include_once("logout.php");
exit;
}
		
if(isset($_POST['edit']))
		{
		
$name=$_POST['name'];
$name1=$_POST['name1'];
$email=$_POST['email'];
$position=$_POST['position'];

$user_id = $_SESSION["userSession3"] ;

$query = $DBcon->query("UPDATE user set name='$name' , name1='$name1', email='$email', position='$position' WHERE user_id='$user_id'");


echo "<script>alert('Update Sucessfully'); window.location='admin_ser.php'</script>";
		
}
$user_id = $_SESSION["userSession3"] ;
$select_query = $DBcon->query("SELECT * FROM user WHERE user_id='$user_id'");
$userRow = $select_query->fetch_array();	
	
$DBcon->close();
?>
<html>
<head>
<title>Admin</title>
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
<h2><center>Update User</center></h2>
</header>
<div class="container">
<h4><font color="#004b66">User Id  :<?php echo $user_id; ?>
<br>Position :<?php echo $userRow['position']; ?></font></h4>
</div>
<div class="container">


<b>First Name:</b><br>
<input type="hidden" name="user_id" class="txtField" value="<?php echo $userRow['user_id']; ?>">
<input type="text" name="name" class="txtField"  value="<?php echo $userRow['name']; ?>"><br>

<b>Last Name:</b><br>
<input type="text" name="name1" class="txtField"  value="<?php echo $userRow['name1']; ?>"><br>

<b>E-mail:</b><br>
<input type="text" name="email" class="txtField"  value="<?php echo $userRow['email']; ?>"><br>

<b>Position:</b>
<br>
<input type="radio" class="txtField"  name="position" value="admin" value="<?php echo $userRow['position']; ?>" >  Admin<br>
<input type="radio" class="txtField"  name="position" value="cus_ser" value="<?php echo $userRow['position']; ?>" > Customer Service<br>
<input type="radio" class="txtField"  name="position" value="cash_ser" value="<?php echo $userRow['position']; ?>"> Cash Service<br>
</div>

<footer>
<button type="submit" accesskey="s" name="edit">
&nbsp; Submit
</button>

<input type="button" accesskey="c" value="Cancel" onclick="window.location.href='admin_user_menu.php?back'" />
</footer>
</form>         
</div>        
</div>            
</body>
</html>