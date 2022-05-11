<?php include ('../session/m_session.php');
      include ('../database/database_connection1.php');
      include("../database/database_connection.php");
      include("../database/database_connection2.php");
?>

<?php
$sql = "SELECT * FROM orderr order by order_no desc LIMIT 1";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
     $order_no = $row["order_no"];
     //echo "$bill_no"."<br>";
    }}

$sql="SELECT count(s_no) AS total FROM orderr";
$result=mysqli_query($conn,$sql);
$values=mysqli_fetch_assoc($result);
$num_row=$values['total'];
//echo($num_row) ."<br>";

if ($num_row==0) {
$order_no="1";
}
   
else{
$order_no=$order_no+1;
} ?>

 <?php
  if (isset($_POST["done"]))
  {
  	for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {
    //$order_no[$a] = $_POST["order_no"][$a];
    $customers_detail[$a] = $_POST["customers_detail"][$a];
  	$product_name[$a] = $_POST["product_name"][$a];
  	$unit[$a] = $_POST["unit"][$a];
  	$quantity[$a] = $_POST["quantity"][$a];
  	$selling_price[$a] = $_POST["selling_price"][$a];
  	$amount[$a] = $quantity[$a] * $selling_price[$a];
  	$sum_amount = array_sum($amount);
  }//for
  ?>

  <!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/sales.css">
  <title>order</title>
</head>
<style type="text/css">
  .entrybtn{
    display: inline-block;
  }
  .tab{
    box-shadow: 5px 5px 10px #2e2c2c;
  }
</style>
<body>


<div id="printMe">
    <table align="center" border="0" width="1340" bgcolor="#ffffff">
    <tr><td class="header"> <?php include ('../header/header1.php'); ?> </td></tr>
    <tr><td height="20"></td></tr>
  
    <tr bgcolor="#ffffff"><td colspan="11" height="30" align="center"><b class="purchase">Order No.: <?php echo "$order_no"; ?></b></td></tr>
    <tr><td height="10"></td></tr>
      <tr><td height="30">
        <b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <b>Customers Name:</b>&nbsp&nbsp&nbsp <?php echo "$customers_detail[0]"; ?></td></tr>

<tr><td align="center"><table border="1" width="1200" class="tab"><tr align="center"><td>PRODUCT DISCRIPTION</td><td>UNIT</td><td>QUANTITY</td><td>RATE</td><td>AMOUNT</td></tr>
	<?php
for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {	?>
<tr align="center"><td> <?php echo "$product_name[$a]"; ?> </td>
	<td> <?php echo "$unit[$a]"; ?> </td>
	<td> <?php echo "$quantity[$a]"; ?> </td>
	<td> <?php echo "$selling_price[$a]"; ?></td>
	<td> <?php echo "$amount[$a]"; ?> </td></tr>

	<?php
	$pdo_add = $con->prepare("INSERT INTO orderr (order_no,customers_detail,product_name,unit,quantity,rate,amount,sum_amount) VALUES (:order_no,:customers_detail,:product_name,:unit,:quantity,:rate,:amount,:sum_amount)");
$pdo_add->bindparam(':order_no',$order_no);
$pdo_add->bindparam(':customers_detail',$customers_detail[0]);
$pdo_add->bindparam(':product_name',$product_name[$a]);
$pdo_add->bindparam(':unit',$unit[$a]);
$pdo_add->bindparam(':quantity',$quantity[$a]);
$pdo_add->bindparam(':rate',$selling_price[$a]);
$pdo_add->bindparam(':amount',$amount[$a]);
$pdo_add->bindparam(':sum_amount',$sum_amount);
$pdo_add->execute();
}//for

$product_count = count($_POST["product_name"]);
$pdo_add = $con->prepare("INSERT INTO orderr1 (order_no,customers_detail,product_count,sum_amount) VALUES (:order_no,:customers_detail,:product_count,:sum_amount)");
$pdo_add->bindparam(':order_no',$order_no);
$pdo_add->bindparam(':customers_detail',$customers_detail[0]);
$pdo_add->bindparam(':product_count',$product_count);
$pdo_add->bindparam(':sum_amount',$sum_amount);
$pdo_add->execute();
?>
 <tr><td colspan="5" align="right"><b>Total Amount = <?php echo $sum_amount; ?></b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td></tr></table></td></tr></td></tr></table></div>
<table width="100%">
<tr><td align="right" height="50"><a href="../order" class="tab entrybtn" style="width: 100px">Done</a> &nbsp&nbsp&nbsp<button onclick="printDiv('printMe')" class="tab entrybtn">Print</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td></tr></table>
<?php }//main if
?>

<script>
    function printDiv(divName){
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
  </script>