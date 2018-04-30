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



if(isset($_POST['btn-branch'])) {
 $user_id = strip_tags($_POST['user_id']); 
 $date = strip_tags($_POST['date']);

 $states = strip_tags($_POST['states']);
 $deposit = strip_tags($_POST['deposit']);
 $withdraw = strip_tags($_POST['withdraw']); 
 $balance = strip_tags($_POST['balance']);

 
 $user_id = $DBcon->real_escape_string($user_id);
 $date = $DBcon->real_escape_string($date); 
 
 $states = $DBcon->real_escape_string($states);
 $deposit = $DBcon->real_escape_string($deposit);
 $withdraw = $DBcon->real_escape_string($withdraw);
 $balance = $DBcon->real_escape_string($balance);

 $query = "INSERT INTO branch(user_id,date,states,deposit,withdraw,balance) VALUES('$user_id','$date','$states','$deposit','$withdraw','$balance')";

if ($DBcon->query($query) === TRUE) {
$last_id = $DBcon->insert_id;

 $select_query = $DBcon->query("SELECT * FROM branch WHERE Serial_No='$last_id' and states='Open'");
 $row=$select_query->fetch_array();
 
 $count = $select_query->num_rows; 
 
 if ($count==1) {


echo "<script>alert('Branch Open successful !'); window.location='admin_ser.php'</script>";
}
else{

echo "<script>alert('Branch Close successful !'); window.location='admin_ser.php'</script>";
 }
}
else {
   
echo "<script>alert('error !'); window.location='admin_ser.php'</script>";
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
<h2><center>Branch Open/Close</center></h2>
</header>


<div class="container">
<font color="#004b66">

<input type="hidden" value="<?php echo  $userRow['user_id']; ?>"   name="user_id"  /> 
<input type="hidden" value="<?php  date_default_timezone_set("Asia/Calcutta");
 echo date('y/m/d');?>" name="date"   />

<b>States :</b>
<br>
<input type="radio"   name="states" value="Open" checked>Branch Open<br>
<input type="radio"   name="states" value="Close" >Branch Close<br>
<br><b>Total Deposit :</b><br>
<input type="text"  placeholder="Total Deposit" name="deposit" required/><br>
<b>Total Withdraw :</b><br>
<input type="text"  placeholder="Total withdraw" name="withdraw" required />
<b>Balance :</b>
<input type="text"  placeholder="Balance" name="balance" required/>
 



</div>
</font>


<footer> 

<button type="submit" accesskey="s"  name="btn-branch"> Submit 
</button>
<input type="button" accesskey="c" value="Cancel" onclick="window.location.href='admin_ser.php?back'" />            
</footer>                    
</form>
</div>
</div>
</body>
</html>