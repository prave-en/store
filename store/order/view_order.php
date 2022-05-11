<?php
//error_reporting(0);
$servername="localhost";
$username="root";
$password="";
$dbname="mrp";
$con=mysqli_connect($servername,$username,$password,$dbname);
$order_no = $_POST["order_no"];

  if (isset($_POST["view_order"]))
  {
$sql = "SELECT * FROM orderr where order_no = $order_no";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
                $customers_detail = $row['customers_detail'];
                $sum_amount = $row['sum_amount'];
                break; } } ?>

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
        <b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <b>Customers Name:</b>&nbsp&nbsp&nbsp <?php echo "$customers_detail"; ?></td></tr>

<tr><td align="center"><table border="1" width="1200" class="tab"><tr align="center"><td>PRODUCT DISCRIPTION</td><td>UNIT</td><td>QUANTITY</td><td>RATE</td><td>AMOUNT</td></tr>

<?php
$sql = "SELECT * FROM orderr where order_no = $order_no";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
                $customers_detail = $row['customers_detail'];
                $product_name = $row['product_name'];
                $unit = $row['unit'];
                $quantity = $row['quantity'];
                $rate = $row['rate'];
                $amount = $row['amount'];
                //$sum_amount = $row['sum_amount']; ?>

<tr align="center"><td> <?php echo "$product_name"; ?> </td>
  <td> <?php echo "$unit"; ?> </td>
  <td> <?php echo "$quantity"; ?> </td>
  <td> <?php echo "$rate"; ?></td>
  <td> <?php echo "$amount"; ?> </td></tr>
                
<?php }
?> <tr><td colspan="5" align="right"><b>Total Amount = <?php echo "$sum_amount"; ?></b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td></tr></table></td></tr></td></tr></table></div>
<table width="100%">
<tr><td align="right" height="50"><a href="../order" class="tab entrybtn">Back</a>&nbsp&nbsp&nbsp<button onclick="printDiv('printMe')" class="tab entrybtn">Print</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td></tr></table>
<?php
}
mysqli_close($con);
} //view order
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

<?php
  if (isset($_POST["delete_order"]))
  {

echo "$order_no";
$sql = "DELETE FROM 'orderr1' WHERE 'orderr1'.'order_no' = $order_no";
$result = mysqli_query($con, $sql);

  echo "deleted";

mysqli_close($con);
}
?>

