<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
<script src="js/jquery.simplePagination.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/simplePagination.css" />
<link rel="stylesheet" href="css/styl.css" >
<link rel="stylesheet" href="css/styl1.css" >
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Cash</title>
</head>
<body>
<div  class="modal" >
<div class="opacity">  
<form class="modal-content " method="post" >
<header>
<h3>Cash</h3>
<h2><center>Total Transection</center></h2>
</header>

<?php
session_start();
require_once 'dbconnect.php';
      
$id=$_SESSION['user1']; 

$limit = 8;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit; 
             
$total=  $DBcon->query("SELECT * FROM `transaction` WHERE acc_no='$id' order by trans_id desc LIMIT $start_from, $limit ");
 
echo '<table>';
echo '<tr >';
echo '<tr ><td>';
echo 'Date';
echo '</td>';
echo '<td>';
echo 'Transection Id';
echo '</td>';
echo '<td>';
echo 'Deposit/Withdraw';
echo '</td>';
echo '<td>';
echo 'Amount Rs.';
echo '</td>';
echo '<td>';
echo 'User Id';
echo '</td>';
echo '</tr>';           
                
while($row= $total->fetch_array())
{
echo '<tr>';
echo '<td>';
echo $row['date'];
echo '</td>';
echo '<td>';
echo $row['trans_id'];
echo '</td>';
echo '<td>';
echo $row['tratype'];
echo '</td>';
echo '<td>';
echo $row['amt'];
echo '</td>';
echo '<td>';
echo $row['user_id'];
echo '</td>';
echo '</tr>';               
              
}

$count=  $DBcon->query("SELECT COUNT(trans_id) FROM transaction WHERE acc_no='$id'");
$row=$count->fetch_array();
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit);  
$pagLink = "<nav><ul class='pagination'>";  
for ($i=1; $i<=$total_pages; $i++) {  
$pagLink .= "<li><a href='cash_tran_totaltra.php?page=".$i."'>".$i."</a></li>";  
};  
echo "<br>".$pagLink . "</ul></nav>"; 

$DBcon->close();
?>

</body>

<footer>
<input type="button" accesskey="b" value="Back" ONCLICK="window.location.href='cash_tran_home.php' ""/>
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
		hrefTextPrefix : 'cash_tran_totaltra.php?page='
    });
	});
</script>
