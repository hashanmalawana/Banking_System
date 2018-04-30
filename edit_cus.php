<?php
require_once("dbconnect.php");



if(count($_POST)>0) {
	
$query = $DBcon->query("UPDATE customer set name='" . $_POST["name"] . "',name1='" . $_POST["name1"] . "',name2='" . $_POST["name2"] . "', address='" . $_POST["address"] . "',address1='" . $_POST["address1"] . "',address2='" . $_POST["address2"] . "',address3='" . $_POST["address3"] . "', nic='" . $_POST["nic"] . "', birthday='" . $_POST["birthday"] . "', email='" . $_POST["email"] . "', phone='" . $_POST["phone"] . "' WHERE customer_id='" . $_POST["customer_id"] . "'");
	

echo "<script>alert('Update Sucessfully'); window.location='admin_ser.php'</script>";

}

$select_query = $DBcon->query("SELECT * FROM customer WHERE customer_id='" . $_GET["customer_id"] . "'");

$customerRow = $select_query->fetch_array();
$DBcon->close();	

?>

<html>
<head>
<title>Admin-Update Customer</title>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body><div  class="modal">
<div class="opacity"> 
<form class="modal-content" method="post" action="">

<header>
<h3>Admin</h3> 
<h2><center>Edit Customer</center></h2>
</header>

<div class="container">
<h4><font color="#004b66">User Id  :<?php echo $customerRow['customer_id']; ?></font></h4>
</div>
<div class="container">
Customer Name :
<input type="hidden" name="customer_id" class="txtField" value="<?php echo $customerRow['customer_id']; ?>">

<input type="text" name="name" placeholder="First Name" value="<?php echo $customerRow['name']; ?>"><br>
<input type="text" name="name1" placeholder="Middel Name" value="<?php echo $customerRow['name1']; ?>"><br>
<input type="text" name="name2" placeholder="Last Name" value="<?php echo $customerRow['name2']; ?>"><br>

Address :<br>
<input type="text" name="address" placeholder="Address1" value="<?php echo $customerRow['address']; ?>"><br>
<input type="text" name="address1" placeholder="Address2" value="<?php echo $customerRow['address1']; ?>"><br>
<input type="text" name="address2" placeholder="Address3" value="<?php echo $customerRow['address2']; ?>"><br>
<input type="text" name="address3" placeholder="Address4" value="<?php echo $customerRow['address3']; ?>"><br>

NIC No :<br>
<input type="text" name="nic"  value="<?php echo $customerRow['nic']; ?>"><br>

Birthday :<br>
<input type="date" name="birthday"  value="<?php echo $customerRow['birthday']; ?>"><br>

E-Mail Address :<br>
<input type="email" name="email" placeholder="E-Mail" value="<?php echo $customerRow['email']; ?>"><br>


Phone Number :<br>
<input type="text" name="phone" class="txtField" value="<?php echo $customerRow['phone']; ?>">


</div>
<footer>
<button type="submit" accesskey="s" name="submit">
&nbsp; Submit
</button>

<input type="button" accesskey="c" value="Cancel" onclick="window.location.href='admin_ser.php?back'" />
</footer>
</form>
</div>
</div>
</body>
</html>