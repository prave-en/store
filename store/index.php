<?php
include ('session/m1_session.php');
include ('resources/navbar.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>home</title>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<style>
  .container{
    height: 457px;
  }
</style>
</head>
<body>
<table align="center" border="0" width="100%" bgcolor="#a3a2a2">

  <tr><td class="header"> <?php include('header/header2.php'); ?> </td></tr>

  <tr><td height="10px"></td></tr>

  <tr><td><div class="topnav" id="myTopnav">
  <a href="index.php" class="active">Home</a>
  <a href="entry">Purchase</a>
  <a href="sales">Sales</a>
  <a href="entry record">Purchase Record</a>
  <a href="sales record">Sales Record</a>
  <a href="store">Store</a>
  <a href="admin">Admin</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i></a>
</div></td></tr>

<tr><td height="10px"></td></tr>
<tr><td align="center" class="container">
<div class="overflow">
   
<div class="recent"><b>Recent Purchases</b></div>
        <table border="1" class="tab"  width="97%">
  <thead>
    <tr align="center">
      <th>Id</th>
     <th>Bill no.</th>
      <th>Bill Date</th>
      <th>Suppliers Detail</th>
      <th>Product Id</th>
      <th>Product Name</th>
      <th>Unit</th>
      <th>Quantity</th>
      <th>Free</th>
      <th>C.P.</th>
      <th>Discount %</th>
      <th>Remarks</th>
    </tr>
  </thead>

    <?php
  include ('database/database_connection1.php');
$sql = "SELECT * FROM entry  ORDER BY s_no DESC limit 5";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr align='center'>";
        echo "<td width=''>". $row["s_no"]. "</td>";
        echo "<td width=''>". $row["bill_no"]. "</td>";
        echo "<td width=''>". $row["bill_date"]. "</td>";
        echo "<td width=''>". $row["suppliers_detail"]. "</td>";
        echo "<td width=''>". $row["product_id"]. "</td>";
        echo "<td width=''>". $row["product_name"]. "</td>";
        echo "<td width=''>". $row["unit"]. "</td>";
        echo "<td width=''>". $row["quantity"]. "</td>";
        echo "<td width=''>". $row["free"]. "</td>";
        echo "<td width=''>". $row["cost_price"]. "</td>";
        echo "<td width=''>". $row["discount_percentage"]. "</td>";
        echo "<td width=''>". $row["remarks"]. "</td>";
         
    }
}
mysqli_close($con);
?></table>

<div class="recent"><b>Recent Sales</b></div>        
        <table border="1" width="97%" class="tab">
  <thead>
    <tr align="center">
      <th>Id</th>
     <th>Bill no.</th>
      <th>Bill Date</th>
      <th>Customers Detail</th>
      <th>Product Id</th>
      <th>Product Name</th>
      <th>Unit</th>
      <th>Quantity</th>
      <th>Rate</th>
      <th>Discount %</th>
      <th>After Dis.</th>
      <th>Total Price</th>
      <th>Remarks</th>
    </tr>
  </thead>
    <?php
  include ('database/database_connection1.php');

$sql = "SELECT * FROM sales  ORDER BY sales_id DESC limit 5";
$result = mysqli_query($con, $sql);


if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr align='center'>";
        
        echo "<td width=''>". $row["sales_id"]. "</td>";
        echo "<td width=''>". $row["bill_no"]. "</td>";
        echo "<td width=''>". $row["bill_date"]. "</td>";
        echo "<td width=''>". $row["customers_detail"]. "</td>";
        echo "<td width=''>". $row["product_id"]. "</td>";
        echo "<td width=''>". $row["product_name"]. "</td>";
        echo "<td width=''>". $row["unit"]. "</td>";
        echo "<td width=''>". $row["quantity"]. "</td>";
        echo "<td width=''>". $row["mrp"]. "</td>";
        echo "<td width=''>". $row["discount_percentage"]. "</td>";
        echo "<td width=''>". $row["after_discount"]. "</td>";
        echo "<td width=''>". $row["total_amount"]."</td>";
        echo "<td width=''>". $row["remarks"]."</td>"."</tr>";


        
    }
}
mysqli_close($con);
?></table>

<?php
 include ('database/database_connection1.php');
 $sql = "SELECT * FROM suppliers";
$result = mysqli_query($con, $sql);
$due= 0;
if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
       
        $row["due_amount"];
        $due += $row['due_amount'];
        
    }
}
mysqli_close($con);
?>

<?php
 include ('database/database_connection1.php');
 $sql = "SELECT * FROM credit_sales";
$result = mysqli_query($con, $sql);
$credit = 0;
if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
       
        $row["credit_amount"];
        $credit += $row['credit_amount'];
        
    }
}
mysqli_close($con);
?>
<?php
$net = $credit - $due;
?>

<?php
date_default_timezone_set('Asia/Kathmandu');
$year = date('o');
$month = date('o-m');
$day = date('o-m-d');
?>

<?php
 include ('database/database_connection1.php');
 $sql = "SELECT * FROM entry where bill_date like '%$month'";
$result = mysqli_query($con, $sql);
$total1 = 0;
if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
       
        $quantity=$row["quantity"];
        $cost_price=$row["cost_price"];
        $total = $quantity*$cost_price;
        $total1 += $total;
        
    }
}
mysqli_close($con);
?>

<div class="recent"><b>Today</b></div>
<table class="tab" border="1" width="97%">
  <tr><td>Purchase:</td></tr>
  <tr><td>Sales:</td></tr>
  <tr><td>Profit Or loss:</td></tr>
</table>

<div class="recent"><b>This Month</b></div>
<table class="tab" border="1" width="97%">
  <tr><td>Purchase:</td></tr>
  <tr><td>Sales:</td></tr>
  <tr><td>Profit or Loss:</td></tr>
</table>

<div class="recent"><b>This Year</b></div>
<table class="tab" border="1" width="97%">
  <tr><td>Purchase:</td></tr>
  <tr><td>Sales:</td></tr>
  <tr><td>Profit or Loss:</td></tr>
</table>

<div class="recent"><b></b></div>
<table class="tab" border="1" width="97%">
  <tr><td>Amount to Receive: <?php echo "$credit"; ?></td></tr>
  <tr><td>Amount to Pay: <?php echo "$due"; ?></td></tr>
  <tr><td>Net: <?php echo "$net"; ?></td></tr>
  <tr><td>Total Profit or Loss:</td></tr>
</table>
<div class="recent"></div>

      </div>
    </td></tr>
<tr><td class="footer"><?php include ('footer/footer.php'); ?></td></tr>

</body>
</html>
