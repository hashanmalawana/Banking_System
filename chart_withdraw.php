<?php
session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['userSession'])) {
   include_once("logout.php");
   exit;
}

include("chart_style.php");

?>

<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js">
</script>

<?php
    
    $strQuery = "SELECT date, withdraw FROM branch WHERE states='Close' ORDER BY date DESC LIMIT 31";

    $result = $DBcon->query($strQuery) or exit("Error code ({$DBcon->errno}): {$DBcon->error}");

 
    if ($result) {
        
        $arrData = array(
            "chart" => array(
              "caption" => "Branch Summary - Withdraw",
              "paletteColors" => "#0075c2",
              "bgColor" => "#ffffff",
              "borderAlpha"=> "20",
              "canvasBorderAlpha"=> "0",
              "usePlotGradientColor"=> "0",
              "plotBorderAlpha"=> "10",
              "showXAxisLine"=> "1",
              "xAxisLineColor" => "#999999",
              "showValues" => "0",
              "divlineColor" => "#999999",
              "divLineIsDashed" => "1",
              "showAlternateHGridColor" => "0"
            )
        );

        $arrData["data"] = array();


        while($row = mysqli_fetch_array($result)) {
        array_push($arrData["data"], array(
            "label" => $row["date"],
            "value" => $row["withdraw"]
            )
        );
        }



        $jsonEncodedData = json_encode($arrData);



        $columnChart = new FusionCharts("column2D", "myFirstChart" , 850, 400, "chart-1", "json", $jsonEncodedData);

    
        $columnChart->render(); 

  
        $DBcon->close();
    }

?>


<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<link rel="stylesheet" href="css/styl.css" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin :<?php echo  $_SESSION["userSession"]; ?></title>
</head>
<body>

<div  class="modal"> 
<div class="opacity"> 
<form class="modal-content">
<header>
<h3>Admin</h3>  
<h2 ><center>Branch Analysis</center></h2>
</header> 
<div class="container"><center>
<div id="chart-1"></div>
</div></center>

<div id="mySidenav">
  <div class="container">
  <a href="chart_balance.php" id="balance">Total Balance</a>
  <a href="chart_deposit.php" id="deposit">Deposit</a>
  <a href="chart_withdraw.php" id="withdraw">Withdraw</a>
  </div>
</div>

<footer>
<input type="button" accesskey="b" value="Back" onclick="window.location.href='admin_ser.php?back'" />
</footer>

</form>         
</div>        
</body>
</html>