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
 $uname2 = strip_tags($_POST['name2']);
 $address = strip_tags($_POST['address']);
 $address1 = strip_tags($_POST['address1']);
 $address2 = strip_tags($_POST['address2']);
 $address3 = strip_tags($_POST['address3']);
 $nic = strip_tags($_POST['nic']);
 $birthday = strip_tags($_POST['birthday']); 
 $phone = strip_tags($_POST['phone']); 
 $email = strip_tags($_POST['email']); 



 $uname = $DBcon->real_escape_string($uname); 
 $uname1 = $DBcon->real_escape_string($uname1);
 $uname2 = $DBcon->real_escape_string($uname2);
 $address = $DBcon->real_escape_string($address);
 $address1 = $DBcon->real_escape_string($address1);
 $address2 = $DBcon->real_escape_string($address2);
 $address3 = $DBcon->real_escape_string($address3);
 $nic = $DBcon->real_escape_string($nic);
 $birthday = $DBcon->real_escape_string($birthday);
 $phone = $DBcon->real_escape_string($phone);
 $email = $DBcon->real_escape_string($email);
 

$check_nic = $DBcon->query("SELECT nic FROM customer WHERE nic='$nic'");

$count=$check_nic->num_rows;
 
if ($count==0) {

$query = $DBcon->query("INSERT INTO customer(name,name1,name2,address,address1,address2,address3,nic,birthday,phone,email) VALUES('$uname','$uname1','$uname2','$address','$address1','$address2','$address3','$nic','$birthday','$phone','$email')");

if ($query === TRUE) {
$last_id = $DBcon->insert_id;
echo "<font color='red'>New Customer added successfully. Customer ID is: " . $last_id . "</font>";
}

}
else {
echo "<script>alert('Same NIC ')</script>";
}
   
 

$DBcon->close();
}
?>

<!DOCTYPE html>
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="css/styl.css" >
</head>
<title><?php echo  $userRow['position'].":".$userRow['user_id']; ?></title>
<body>

<div  class="modal"> 
<div class="opacity"> 

<form class="modal-content " method="POST" >

<header>
<h3>Admin</h3>
<h2><center>Add Customer</center></h2>
</header>


<div ng-app="">        
<div class="container">
<font color="#004b66">

<b>Name: {{name}} {{name1}} {{name2}}</b>
<input type="text" ng-model="name" placeholder="First Name" name="name" required  />
<input type="text" ng-model="name1"  placeholder="Second Name" name="name1"  />
<input type="text" ng-model="name2" placeholder="Last Name" name="name2" />

<b>Address: {{address}}  {{address1}}  {{address2}}  {{address3}}   </b>
<input type="text" ng-model="address" placeholder="Address" name="address" required  />
<input type="text" ng-model="address1" placeholder="Line 1" name="address1"   />
<input type="text" ng-model="address2" placeholder="Line 2" name="address2"   />
<input type="text" ng-model="address3" placeholder="Line 3" name="address3"   /><br>

<b>NIC Number: {{nic}}  </b>
<input type="text" ng-model="nic" placeholder="NIC" name="nic"  />

<b>Birthday: </b>
<input type="date"  placeholder="Date" name="birthday" required  />

<b>E-Mail: </b>
<input type="email"  placeholder="xxx@.xxx" name="email"   />

<b>Phone Number: {{phone}}</b>
<input type="text" ng-model="phone" placeholder="0094xxxxxxx" name="phone"   />
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