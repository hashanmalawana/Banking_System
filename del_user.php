<?php
require_once("dbconnect.php");

$query = "DELETE FROM user WHERE user_id='" . $_GET["user_id"] . "'";

mysqli_query($DBcon,$query);
header("Location:admin_ser.php");


?>
