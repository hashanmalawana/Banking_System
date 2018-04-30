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

if(isset($_POST['btn-signup'])) {
 
 $uname = strip_tags($_POST['name']);
 $uname1 = strip_tags($_POST['name1']);
 $email = strip_tags($_POST['email']);
 $upass = strip_tags($_POST['password']);
 $position = strip_tags($_POST['position']); 


 $uname = $DBcon->real_escape_string($uname); 
 $uname1 = $DBcon->real_escape_string($uname1); 
 $email = $DBcon->real_escape_string($email);
 $upass = $DBcon->real_escape_string($upass);
 $position = $DBcon->real_escape_string($position);

 
 $hashed_password = password_hash($upass, PASSWORD_DEFAULT); 
 
$check_email = $DBcon->query("SELECT email FROM user WHERE email='$email'");

$count=$check_email->num_rows;
 
if ($count==0) {

$query = "INSERT INTO user(name,name1,email,password,position) VALUES('$uname','$uname1','$email','$hashed_password','$position')";

  

if ($DBcon->query($query) === TRUE) {
      $last_id = $DBcon->insert_id;
    echo "<font color='green'>New user added successfully. your ID is: " . $last_id . "</font>";


}
else {
   
     echo "<script>alert('Error while registering !'); window.location='add_user.php'</script>";
}
  
} 
else {
  
echo "<script>alert('Sorry Email already taken !'); window.location='add_user.php'</script>";
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
</head>
<title>Admin :<?php echo  $userRow['user_id']; ?></title>
<body>

<div  class="modal"> 
<div class="opacity"> 
<form class="modal-content " method="post" >

<header>
<h3>Admin</h3>
<h2><center>Create User</center></h2>
</header>

<div ng-app="">
<div class="container">
<font color="#224b33">
<b>User Name : {{name}} {{name1}} </b>
<input type="text" ng-model="name" placeholder="First Name" name="name" required  />
<input type="text" ng-model="name1" placeholder="Last Name" name="name1" required  />

<b>E-mail address : </b>
<input type="email" placeholder="E-mail address" name="email" required  />
<b>Password :</b>
<input type="password"  placeholder="Password" name="password" required  />
<b>Position :</b>
<br>
<input type="radio"   name="position" value="admin" checked>Admin<br>
<input type="radio"   name="position" value="cus_ser" >Customer Service<br>
<input type="radio"   name="position" value="cash_ser" >Cash Service<br>
        
</div>
</font>
</div>

<footer> 

<button type="submit" accesskey="s" name="btn-signup">Submit </button>
<input type="button" accesskey="c" value="Cancel" onclick="window.location.href='admin_ser.php?back'" />            

</footer>                    
</form>
</div>
</div>
</body>
</html>