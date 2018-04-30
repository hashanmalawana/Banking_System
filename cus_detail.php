<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<title>Admin </title>

</head>
<body>
<div  class="modal">
<div class="opacity"> 
<form class="modal-content " method="post" >

<header>
<h3>Admin</h3>
<h2><center>Customer Details</center></h2>
</header>
<div class="container">
  <?php 
session_start();
include_once 'dbconnect.php';



$query = $DBcon->query("SELECT customer.*, account.* FROM account INNER JOIN customer ON account.cust_id= customer.customer_id WHERE customer.customer_id =".$_SESSION['customerSession']);

 
if($query->num_rows > 0){

$customerRow=$query->fetch_assoc();

echo "<table>";

          echo "<tr>"."<td>"."Create date"."</td>"."<td>". $customerRow['DateTime']."</td>"."<tr>";
          echo "<tr>"."<td>"."Customer ID"."</td>"."<td>". $customerRow['customer_id']."</td>"."<tr>";
          echo "<tr>"."<td>"."customer Name"."</td>"."<td>". $customerRow['name']." &nbsp". $customerRow['name1']." &nbsp". $customerRow['name2']."</td>"."<tr>"; 
          echo "<tr>"."<td>"."Address"."</td>"."<td>". $customerRow['address']." &nbsp". $customerRow['address1']. $customerRow['address2']. $customerRow['address3']."</td>"."<tr>"; 
          echo "<tr>"."<td>"."NIC No"."</td>"."<td>". $customerRow['nic']."</td>"."<tr>"; 
          echo "<tr>"."<td>"."Birthday"."</td>"."<td>". $customerRow['birthday']."</td>"."<tr>";
          echo "<tr>"."<td>"."E-Mail Address"."</td>"."<td>". $customerRow['email']."</td>"."<tr>"; 
          echo "<tr>"."<td>"."Phone Number"."</td>"."<td>". $customerRow['phone']."</td>"."<tr>"; 
          echo "<tr>"."<td>"."Account Number & Type"."</td>"."<td>"." &nbsp". $customerRow['acc_number']." &nbsp". $customerRow['acc_type']."</td>"."<tr>"; 
echo "</table>";

while ($row = $query->fetch_assoc()) {
echo "<table>";  
          echo "<tr>"."<td>"."Account Number & Type"."</td>"."<td>"." &nbsp". $row['acc_number']." &nbsp ". $row['acc_type']."</td>"."<tr>";
echo "</table>";
      }
    }
else{
/*when Have not created account*/
$queryy = $DBcon->query("SELECT * FROM customer  WHERE customer_id =".$_SESSION['customerSession']);

if($queryy->num_rows > 0){

$customerRow=$queryy->fetch_assoc();



          echo "Create date            :". $customerRow['DateTime']."</br>";
          echo "Customer ID            :". $customerRow['customer_id']."</br>";
          echo "customer Name          : ". $customerRow['name']." &nbsp". $customerRow['name1']." &nbsp". $customerRow['name2']."</br>"; 
          echo "Address                : ". $customerRow['address']." &nbsp". $customerRow['address1']. $customerRow['address2']. $customerRow['address3']."</br>"; 
          echo "NIC No                 : ". $customerRow['nic']."</br>"; 
          echo "Birthday               : ". $customerRow['birthday']."</br>";
          echo "E-Mail Address         : ". $customerRow['email']."</br>"; 
          echo "Phone Number           : ". $customerRow['phone']."</br>"; 
        }
}
$DBcon->close();
?>
</div>

<footer>


<input type="button" value="Update " accesskey="u" onclick="window.location.href='edit_cus.php?customer_id=<?php echo $_SESSION['customerSession']; ?>'" />
<input type="button" value="Cancel" accesskey="c" onclick="window.location.href='admin_ser.php?back'" />
</footer>

</form>
</div>
</div>           
</body>
</html>