<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl1.css" >
<link rel="stylesheet" href="css/styl3.css" >
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Admin</title>
</head>

<body>
<div  class="modal">
<div class="opacity"> 
<form class="modal-content " method="post">

<header>
<h3>Admin</h3>
<h2 ><center>Branch Summary</center></h2>
</header>
<div class="container">
<input type="hidden" value="<?php date_default_timezone_set("Asia/Calcutta");   echo date('y/m/d');?>" name="date"   />

<label ><b>Close Date and Time :</b></label>
<input type="text"  placeholder="yyyy-mm-dd hh:mm:ss" name="end_time" required />
</div>
<div class="container"><center>
<button type="submit"  accesskey="1"  name="btn-all_tran" id="btn-all_tran">All Transaction
</button> 

<button type="submit"  accesskey="2"  name="btn-all_deposit" id="btn-all_deposit">All Deposit
</button> 

<button type="submit"  accesskey="3"  name="btn-all_withdraw" id="btn-all_withdraw">All Withdraw
</button>

<button type="submit"  accesskey="4"  name="btn-branch_summary" id="btn-branch_summary">Branch Summary
</button>
</center>
</div>



<?php
session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['userSession'])) {
include_once("logout.php");
exit;
}



if (isset($_POST['btn-all_tran'])) {
 
 $date = strip_tags($_POST['date']);
 $end_time = strip_tags($_POST['end_time']);
 
 $date = $DBcon->real_escape_string($date);
 $end_time = $DBcon->real_escape_string($end_time);

$query = $DBcon->query("SELECT * FROM transaction WHERE Date between '$date' and '$end_time'");
echo '<table>';

echo '<tr ><th>';
echo 'Date';
echo '</th>';

echo '<th>';
echo 'Transaction Id';
echo '</th>';

echo '<th>';
echo 'User Id';
echo '</th>';

echo '<th>';
echo 'Account Number';
echo '</th>';

echo '<th>';
echo 'Deposit/Withdraw';
echo '</th>';

echo '<th>';
echo 'Amount';
echo '</th>';
        
echo '</tr >';
 
while ($row = $query->fetch_assoc()) {

echo '<tr>';
echo '<td>';
echo $row['date'];
echo '</td>';
          
echo '<td>';
echo $row['trans_id'];
echo '</td>';

echo '<td>';
echo $row['user_id'];
echo '</td>';
           
echo '<td>';
echo $row['acc_no'];
echo '</td>';
               
echo '<td>';
echo $row['tratype'];
echo '</td>';


echo '<td>';
echo $row['amt'];
echo '</td>';
echo '</tr>';
}

}

if (isset($_POST['btn-all_deposit'])) {

$date = strip_tags($_POST['date']);
$end_time = strip_tags($_POST['end_time']);
 
$date = $DBcon->real_escape_string($date);
$end_time = $DBcon->real_escape_string($end_time);


$query = $DBcon->query("SELECT * FROM `transaction` WHERE Date between '$date' and '$end_time' and tratype='deposit'");


echo '<table>';

echo '<tr ><th>';
echo 'Date';
echo '</th>';

echo '<th>';
echo 'Transaction Id';
echo '</th>';

echo '<th>';
echo 'User Id';
echo '</th>';

echo '<th>';
echo 'Account Number';
echo '</th>';


echo '<th>';
echo 'Amount';
echo '</th>';
        
echo '</tr >';
 
while ($row = $query->fetch_assoc()) {

echo '<tr>';
echo '<td>';
echo $row['date'];
echo '</td>';
          
echo '<td>';
echo $row['trans_id'];
echo '</td>';

echo '<td>';
echo $row['user_id'];
echo '</td>';
           
echo '<td>';
echo $row['acc_no'];
echo '</td>';

echo '<td>';
echo $row['amt'];
echo '</td>';
echo '</tr>';
}

}

if (isset($_POST['btn-all_withdraw'])) {

$date = strip_tags($_POST['date']);
 $end_time = strip_tags($_POST['end_time']);
 
 $date = $DBcon->real_escape_string($date);
 $end_time = $DBcon->real_escape_string($end_time);



$query = $DBcon->query("SELECT * FROM `transaction` WHERE Date between '$date' and '$end_time' and tratype='withdraw' ");


echo '<table>';

echo '<tr ><th>';
echo 'Date';
echo '</th>';

echo '<th>';
echo 'Transaction Id';
echo '</th>';

echo '<th>';
echo 'User Id';
echo '</th>';

echo '<th>';
echo 'Account Number';
echo '</th>';


echo '<th>';
echo 'Amount';
echo '</th>';
        
echo '</tr >';
 
while ($row = $query->fetch_assoc()) {

echo '<tr>';
echo '<td>';
echo $row['date'];
echo '</td>';
          
echo '<td>';
echo $row['trans_id'];
echo '</td>';

echo '<td>';
echo $row['user_id'];
echo '</td>';
           
echo '<td>';
echo $row['acc_no'];
echo '</td>';

echo '<td>';
echo $row['amt'];
echo '</td>';
echo '</tr>';
}


}

if (isset($_POST['btn-branch_summary'])) {

$date = strip_tags($_POST['date']);
 $end_time = strip_tags($_POST['end_time']);
 
 $date = $DBcon->real_escape_string($date);
 $end_time = $DBcon->real_escape_string($end_time);

$query=$DBcon->query("SELECT ((SELECT COALESCE(SUM(amt),0) FROM `transaction` WHERE Date between '$date' and '$end_time' and tratype = 'deposit' )) AS dbalance ");

$rows = $query->fetch_assoc(); 

$deposit= $rows['dbalance'];
$formattedNum1 = number_format($deposit, 2);
echo '<b>All Deposit Amount      : Rs.'.$formattedNum1.'<b><br>';



$query=$DBcon->query("SELECT ((SELECT COALESCE(SUM(amt),0) FROM `transaction` WHERE Date between '$date' and '$end_time' and tratype = 'withdraw' )) AS wbalance ");

$rows = $query->fetch_assoc(); 

$withdraw= $rows['wbalance'];
$formattedNum2 = number_format($withdraw, 2);
echo '<b>All Withdraw Amount      : Rs.'.$formattedNum2.'</b><br><br>';




$query=$DBcon->query("SELECT ((SELECT COALESCE(SUM(amt),0) FROM `transaction` WHERE Date between '$date' and '$end_time' and tratype = 'deposit' ) - (SELECT COALESCE( SUM( amt ),0) FROM `transaction` WHERE Date between '$date' and '$end_time' and tratype = 'withdraw' )) AS tbalance ");

$row = $query->fetch_assoc(); 

$sum= $row['tbalance'];
$formattedNum3 = number_format($sum, 2);
echo '<b>Day Balance      : Rs.'.$formattedNum3.'</b><br>';

}

$DBcon->close();
?>

</body>
<footer>

<input type="button"  accesskey="b" value="Back" name="back"ONCLICK="window.location.href='admin_ser.php' ""/>

</footer>
</form> 
</div>
</div>
</html>
