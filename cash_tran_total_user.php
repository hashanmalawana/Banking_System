<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
<script src="js/jquery.simplePagination.js"></script>
<link rel="stylesheet" href="css/simplePagination.css" />
<link rel="stylesheet" href="css/styl1.css" >
<link rel="stylesheet" href="css/styl.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cash</title>
</head>
<body>
<div  class="modal">
<div class="opacity">  
<form class="modal-content " method="post" >
<header>
<h3>Cash</h3>
<h2><center>My Transaction Details</center></h2>
</header>

              
<?php
session_start();
require_once 'dbconnect.php';
 
date_default_timezone_set("Asia/Calcutta");

$user_id= $_SESSION['userSession2']; 
$date = date('Y-m-d');
$dates = date('Y-m-d H:i:s');
             
$limit = 8;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit; 

$total=  $DBcon->query("SELECT `date`,`tratype`, `amt`, `acc_no` FROM `transaction` WHERE  date between '$date' and '$dates' order by date desc LIMIT $start_from, $limit ");

 echo '<h3><font color="#004b66">User Id :'. $user_id .'</font></h3>' ;          

echo '<table>';

echo '<tr ><th>';
echo 'Date';
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

                  
while($row= $total->fetch_assoc())
           {
echo '<tr>';
echo '<td>';
echo $row['date'];
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

$count=  $DBcon->query("SELECT COUNT(trans_id) FROM transaction WHERE  date between '$date' and '$dates' order by date desc ");
$row=$count->fetch_array();
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);  
$pagLink = "<nav><ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {  
$pagLink .= "<li><a href='cash_tran_total_user.php?page=".$i."'>".$i."</a></li>";  
};  
echo "<br>".$pagLink . "</ul></nav>"; 


$DBcon->close();
?>

</body>
<footer>

<input type="button" accesskey="b" value="Back" ONCLICK="window.location.href='cash_ser.php' ""/>
</footer>

</form>
</div>
</div>
</html>
<script type="text/javascript">
$(document).ready(function(){
$('.pagination').pagination({
        items: <?php echo $total_records;?>,
        itemsOnPage: <?php echo $limit;?>,
        cssStyle: 'light-theme',
		currentPage : <?php echo $page;?>,
		hrefTextPrefix : 'cash_tran_total_user.php?page='
    });
	});
</script>