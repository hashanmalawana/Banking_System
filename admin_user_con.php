<?php
session_start();
require_once 'dbconnect.php';



if (isset($_POST['btn-access'])) {
 
 $user_id = strip_tags($_POST['user_id']);
 $password = strip_tags($_POST['password']);
 
 $user_id = $DBcon->real_escape_string($user_id);
 $password = $DBcon->real_escape_string($password);
 

//select admin

 $query = $DBcon->query("SELECT user_id, email, password,position FROM user WHERE user_id='$user_id' and position='admin'");
 $row=$query->fetch_array();
 
 $count = $query->num_rows; // if id/password are correct returns must be 1 row
 
 if (password_verify($password, $row['password']) && $count==1) {
  $_SESSION['userSession'] = $row['user_id'];

 header("Location: admin_user_menu.php");


}
 else {

echo "<script>alert('Required Admin Access'); window.location='admin_ser.php'</script>";

 }
 $DBcon->close();
}
?>

<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl2.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<title>Access Authoritation</title>

<body>
<div  class="modal"> 

<form class="modal1-content " method="post" >
<header>      
<h2 ><center><font color="white">Admin Authentification</font></center></h2>
  
<h3><font color="red">*restricted data</font> </h3>
</header>

<div class="container">
<font color="#004b66"> 
<label for="user_id"><b>User Id</b></label><br>
<input type="text"   placeholder="User Id" name="user_id" required />

<label for="password"><b>Password</b></label>
<input type="password"  placeholder="Password" name="password" required />
</div>
</font>

<div class= "modal-footer">
<button type="submit" accesskey="o"  name="btn-access" id="btn-access"> Okay</button> 
<input type="button" accesskey="c" value="Cancel" ONCLICK="window.location.href='admin_ser.php' ""/>
</div>
</form>
</div>

</body>
</html>