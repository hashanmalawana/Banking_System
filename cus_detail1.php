<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $userRow['position']." :". $userRow['user_id']; ?>   </title>

</head>
<body>
<div  class="modal">
<div class="opacity">  
<form class="modal-content " method="post" >

<header>
<h3>Customer Service Officer</h3>
<h2><center>Customer Details</center></h2>
</header>

<div class="container"> 
<?php 
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession1'])) {
   include_once("logout.php");
   exit;
}

$user_id = $_SESSION["userSession1"] ;

$query = $DBcon->query("SELECT * FROM user where user_id= '$user_id'");
$userRow=$query->fetch_array();


$query1 = $DBcon->query("SELECT customer.*, account.* FROM account INNER JOIN customer ON account.cust_id= customer.customer_id WHERE customer.customer_id =".$_SESSION['customerSession']);
 
if($query1->num_rows > 0){

$customerRow=$query1->fetch_assoc();



          echo  "Create date   :". $customerRow['DateTime']."</br>";
          echo "Customer ID   :". $customerRow['customer_id']."</br>";
          echo "customer Name  : ". $customerRow['name']." ". $customerRow['name1']." ". $customerRow['name2']."</br>"; 
          echo "Address  : ". $customerRow['address']." ". $customerRow['address1']." ". $customerRow['address2']." ". $customerRow['address3']."</br>"; 
          echo "NIC No  : ". $customerRow['nic']."</br>"; 
          echo "Birthday  : ". $customerRow['birthday']."</br>";
          echo "E-Mail Address  : ". $customerRow['email']."</br>"; 
          echo "Phone Number  : ". $customerRow['phone']."</br>"; 
          echo "Account Number & Type  : ". $customerRow['acc_number']." &nbsp". $customerRow['acc_type']."</br>"; 

while ($row = $query1->fetch_assoc()) {
  
        echo "Account Number & Type : ". $row['acc_number']." &nbsp". $row['acc_type']."</br>";

      }
    } else{

$queryy = $DBcon->query("SELECT * FROM customer  WHERE customer_id =".$_SESSION['customerSession']);

if($queryy->num_rows > 0){

$customerRow=$queryy->fetch_assoc();



          echo  "Create date   :". $customerRow['DateTime']."</br>";
          echo "Customer ID   :". $customerRow['customer_id']."</br>";
          echo "customer Name  : ". $customerRow['name']." ". $customerRow['name1']." ". $customerRow['name2']."</br>"; 
          echo "Address  : ". $customerRow['address']." ". $customerRow['address1']." ". $customerRow['address2']." ". $customerRow['address3']."</br>"; 
          echo "NIC No  : ". $customerRow['nic']."</br>"; 
          echo "Birthday  : ". $customerRow['birthday']."</br>";
          echo "E-Mail Address  : ". $customerRow['email']."</br>"; 
          echo "Phone Number  : ". $customerRow['phone']."</br>"; 
        }
}

$DBcon->close();

?>

</div>
</body>
<footer>

<input type="button" value="Back" accesskey="b" ONCLICK="window.location.href='cus_ser.php' ""/>

</footer>           
</form>
</div>
</div>
</html>