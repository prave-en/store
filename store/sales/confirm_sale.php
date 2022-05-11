<?php include ('../session/m_session.php');
      include ('../database/database_connection1.php');
      include("../database/database_connection.php");
      include("../database/database_connection2.php");
?>

<?php 
for ($a = 0; $a < count($_POST["product_name"]); $a++){
 $customers_detail[$a] = $_POST["customers_detail"][0];
 $bill_date[$a] = $_POST["bill_date"][0];
 $discount_percentage[$a] = $_POST["discount_percentage"][0];}
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
      <tr><td height="20">
        <b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCustomers Name:</b>&nbsp&nbsp&nbsp <?php echo "$customers_detail[0]"; ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b> Date:</b> &nbsp&nbsp&nbsp<?php echo "$bill_date[0]"; ?> </td></tr>
<tr><td align="center"><table border="1" width="1200" class="tab"><tr align="center"><td>PRODUCT DISCRIPTION</td><td>UNIT</td><td>QUANTITY</td><td>RATE</td><td>REMARKS</td></tr>

<form action="salesdb.php" method="post">

  <input type="hidden" name="customers_detail[]" value="<?php echo $customers_detail[0]; ?>" >
  <input type="hidden" name="bill_date[]" value="<?php echo $bill_date[0]; ?>" >
  <input type="hidden" name="discount_percentage[]" value="<?php echo $discount_percentage[0]; ?>" >


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
              $product_id[$a] = $row['product_id'];   
              $store_quantity[$a] = $row['store_quantity'];
              $cost_price[$a] = $row['cost_price'];
              $selling_price[$a] = $row['selling_price'];
              $mrp[$a] = $row['mrp'];?>
              
              <input type="hidden" name="product_name[]" value="<?php echo $product_name[$a]; ?>" >
              <input type="hidden" name="unit[]" value="<?php echo $unit[$a]; ?>" >
             
              <?php }//foreach

              if($quantity[$a] > $store_quantity[$a])
              { ?>
                 <tr align="center">
                  
                   <td> <?php echo "$product_name[$a]"; ?> </td><td> <?php echo "$unit[$a]"; ?> </td><td><input type="number" name="quantity[]" value="<?php echo $store_quantity[$a];?>" max="<?php echo $store_quantity[$a];?>" min="0"></td><td> <input type="number" name="rate[]" value="<?php echo $mrp[$a]; ?>" max="<?php echo $mrp[$a]; ?>" min="<?php echo $cost_price[$a]; ?>"> </td> <td>only <?php echo "$store_quantity[$a]"; ?> available</td>
                 </tr>
              <?php }//store quantity
              else{ ?>
              
                   <tr align="center">
                   <input type="hidden" name="quantity[]" value="<?php echo $quantity[$a]; ?>">
                   <td> <?php echo "$product_name[$a]"; ?> </td><td> <?php echo "$unit[$a]"; ?> </td><td> <?php echo "$quantity[$a]"; ?></td><td> <input type="number" name="rate[]" value="<?php echo $mrp[$a]; ?>" max="<?php echo $mrp[$a]; ?>" min="<?php echo $cost_price[$a]; ?>"> </td> <td></td>
                 </tr>
        <?php
              }// esle
            }// match end
            else{
              echo "<tr align='center'>"."<td>"; echo "$product_name[$a]"."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>";
echo ""."</td>"."<td>";echo "unavailable "."</td>"."</tr>";
            } 
    } // main for
    ?><tr align="right"><td colspan="5">Discount Percentage (<?php echo "$discount_percentage[0]"; ?>%)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
    <?php
   }// main if
  ?>

</table></td></tr>
  <tr><td height="20px"></td></tr>
  <tr><td align="right">
   <a href="../sales" class="tab entrybtn" style="width: 100px">Back</a> &nbsp&nbsp&nbsp <input type="submit" name="cash_sales" value="Cash" class="tab entrybtn"> &nbsp&nbsp&nbsp <input type="submit" name="credit_sales" value="Credit" class="tab entrybtn">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  </td></tr>

  </form>
