<?php
session_start();
require_once 'dbconnect.php';

$user_id = $_SESSION["userSession"] ;

$query = $DBcon->query("SELECT * FROM user where user_id= '$user_id'");
$userRow=$query->fetch_array();




if(isset($_POST['btn-signup'])) {
 
 $cust_id = strip_tags($_POST['cust_id']);
 $acc_type = strip_tags($_POST['acc_type']);

 $cust_id = $DBcon->real_escape_string($cust_id); 
 $acc_type = $DBcon->real_escape_string($acc_type);

 $name = $_FILES['file']['name'];
 $target_dir = "upload/";
 $target_file = $target_dir . basename($_FILES["file"]["name"]);

        // Select file type
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
 $extensions_arr = array("jpg","jpeg","png","gif");


$check_cust_id = $DBcon->query("SELECT customer_id FROM customer WHERE customer_id='$cust_id'");
$count=$check_cust_id->num_rows;
 
if ($count = 1) {

 if( in_array($imageFileType,$extensions_arr) ){
            
            // Convert to base64 
 $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
 $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

            // Upload file
 move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$name);

$user_id = $_SESSION["userSession"] ;
$query = "INSERT INTO account(cust_id,acc_type,user_id,name,image) VALUES('$cust_id','$acc_type','$user_id','$name','$image')";

if ($DBcon->query($query) === TRUE) {

$last_id = $DBcon->insert_id;
echo "<font color='red'>New Customer added successfully. your Account Number is: " . $last_id . "</font>"   ;
    
}
else{
echo "<script>alert('Invalied Customer Id')</script>";
}
}

else{
echo "<script>alert(' Account not create')</script>";
}

 $DBcon->close();
}}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<head>
</head>
<title><?php echo " Admin  : ". $userRow['user_id']; ?></title>
<body>
<div  class="modal">
<div class="opacity">  
<form class="modal-content " method="post" enctype='multipart/form-data'>

<header>
<h3>Admin</h3>
<h2><center>Create Account</center></h2>
</header>

<div class="container">
<br>
<b>Customer Id</b>
<input type="text" placeholder="Customer Id" name="cust_id" required  />
<br>


<b>Account Type</b><br>
<input type="radio"  name="acc_type" value="Normal" checked>Normal Serving<br>
<input type="radio"  name="acc_type" value="Fixed" >Fixed deposite<br>
 <br>
<b>Customer Photo</b><br>
<input type='file' name='file' required/>

<input type="hidden" name="user_id" class="txtField" value="<?php echo $user_id; ?>">
</div>
<footer>
<button type="submit" accesskey="s"  name="btn-signup">
Submit 
</button>
            
<input type="button" value="Cancel" accesskey="c" onclick="window.location.href='admin_ser.php?back'" />
</footer>              
</form>
</div>   
</div>
</body>
</html>