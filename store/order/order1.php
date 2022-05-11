<?php 
error_reporting(0);
include ('../session/m_session.php');
include ('../database/database_connection1.php');
include("../database/database_connection.php");
include("../database/database_connection2.php");
?>

<?php 
for ($a = 0; $a < count($_POST["product_name"]); $a++){
 $customers_detail[$a] = $_POST["customers_detail"][0];
 //$bill_date[$a] = $_POST["bill_date"][0];
 //$discount_percentage[$a] = $_POST["discount_percentage"][0];
break; }
  ?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/sales.css">
  <title>confirm sale</title>
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
  
    <tr bgcolor="#ffffff"><td colspan="11" height="30" align="center"><b class="purchase">Recheck</b></td></tr>
    <tr><td height="10"></td></tr>
      <tr><td height="30">
        <b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <b>Customers Name:</b>&nbsp&nbsp&nbsp <?php echo "$customers_detail[0]"; ?></td></tr>

<tr><td align="center"><table border="1" width="1200" class="tab"><tr align="center"><td>PRODUCT DISCRIPTION</td><td>UNIT</td><td>QUANTITY</td><td>RATE</td><td>AMOUNT</td></tr>

<form action="order2.php" method="post">

  <?php
  if (isset($_POST["done"]))
  {
    for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {

      $product_name[$a] = $_POST["product_name"][$a];
      $unit[$a] = $_POST["unit"][$a];
      $quantity[$a] = $_POST["quantity"][$a];

      $query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name[$a]' AND unit='$unit[$a]'");
            $rows = mysqli_num_rows($query);
            if($rows == 1){ //matched start
      foreach($query as $row)
               {  
              $cost_price[$a] = $row['cost_price'];
              $selling_price[$a] = $row['selling_price'];
              $mrp[$a] = $row['mrp'];
              $amount[$a] = $quantity[$a] * $selling_price[$a];
              $sum_amount = array_sum($amount);
                } } ?>
              <tr align="center">
              <td> <?php echo $product_name[$a]; ?></td>
              <td> <?php echo $unit[$a]; ?></td>
              <td> <input type="number" name="quantity[]" value="<?php echo $quantity[$a]; ?>" min="0" ></td>
              <td> <input type="number" name="selling_price[]" value="<?php echo $selling_price[$a]; ?>" min="<?php echo $cost_price[$a]; ?>" max="<?php echo $mrp[$a]; ?>" > </td>
              <td> <?php echo $amount[$a]; ?></td>
              </tr>

              <input type="hidden" name="order_no[]" value=" <?php echo $order_no; ?>">
              <input type="hidden" name="customers_detail[]" value=" <?php echo $customers_detail[$a]; ?>">
              <input type="hidden" name="product_name[]" value=" <?php echo $product_name[$a]; ?>">
              <input type="hidden" name="unit[]" value=" <?php echo $unit[$a]; ?>">
              <input type="hidden" name="amount[]" value=" <?php echo $amount[$a]; ?>">
              
              
       <?php       
    } // main for
    ?>
    <tr><td colspan="5" align="right"><input type="hidden" name="sum_amount[]" value=" <?php echo $sum_amount; ?>"> <b> Total Amount = <?php echo "$sum_amount"; ?> </b>&nbsp&nbsp</td></tr>
   <?php  }// main if
  ?>
</table></td></tr>
  <tr><td height="20px"></td></tr>
  <tr><td colspan="5" align="right"><input type="submit" name="done" value="Done" class="tab entrybtn">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td></tr>
  </form>
