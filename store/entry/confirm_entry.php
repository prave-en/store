<?php include ('../session/m_session.php');
      include ('../database/database_connection1.php');
      include("../database/database_connection.php");
      include("../database/database_connection2.php");
?>

<?php 
for ($a = 0; $a < count($_POST["product_name"]); $a++){
 $suppliers_detail[$a] = $_POST["suppliers_detail"][0];
 $bill_no[$a] = $_POST["bill_no"][0];
 $bill_date[$a] = $_POST["bill_date"][0];
 $discount_percentage[$a] = $_POST["discount_percentage"][0];}
  ?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/sales.css">
  <title>confirm entry</title>
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
        <b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCustomers Name:</b>&nbsp&nbsp&nbsp <?php echo "$suppliers_detail[0]"; ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b> Bill no.:</b> &nbsp&nbsp&nbsp<?php echo "$bill_no[0]"; ?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b> Date:</b> &nbsp&nbsp&nbsp<?php echo "$bill_date[0]"; ?> </td></tr>
<tr><td align="center"><table border="1" width="1200" class="tab"><tr align="center"><td>PRODUCT DISCRIPTION</td><td>UNIT</td><td>QUANTITY</td><td>FREE</td><td>RATE</td><td>REMARKS</td></tr>

<form action="entrydb.php" method="post">

  <input type="hidden" name="suppliers_detail[]" value="<?php echo $suppliers_detail[0]; ?>" >
  <input type="hidden" name="bill_no[]" value="<?php echo $bill_no[0]; ?>" >
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
      $free[$a] = $_POST["free"][$a];

      $query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name[$a]' AND unit='$unit[$a]'");
            $rows = mysqli_num_rows($query);
            if($rows == 1){ //matched start
      foreach($query as $row)
               {  
              $product_id[$a] = $row['product_id'];   
              //$store_quantity[$a] = $row['store_quantity'];
              $cost_price[$a] = $row['cost_price'];
              //$selling_price[$a] = $row['selling_price'];
              //$mrp[$a] = $row['mrp'];?>

              <input type="hidden" name="product_name[]" value="<?php echo $product_name[$a]; ?>">
              <input type="hidden" name="unit[]" value="<?php echo $unit[$a]; ?>">
              <input type="hidden" name="quantity[]" value="<?php echo $quantity[$a]; ?>">
              <input type="hidden" name="free[]" value="<?php echo $free[$a]; ?> ">
              
              <tr align="center"><td><?php echo "$product_name[$a]"; ?></td><td><?php echo "$unit[$a]"; ?></td><td> <?php echo "$quantity[$a]"; ?></td><td> <?php echo "$free[$a]"; ?></td><td> <input type="number" name="cost_price[]" value="<?php echo $cost_price[$a]; ?>" autocomplete="off"></td><td></td>
             
              <?php }//foreach
                    }// match end
            else{
              echo "<tr align='center'>"."<td>"; echo "$product_name[$a]"."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>"; echo "<font color='red'> unavailable </font> "."</td>"."</tr>";
            } 
    } // main for
    ?><tr align="right"><td colspan="6">Discount Percentage (<?php echo "$discount_percentage[0]"; ?>%)&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
    <?php
   }// main if
  ?>

</table></td></tr>
  <tr><td height="20px"></td></tr>
  <tr><td align="right">
   <a href="../entry" class="tab entrybtn" style="width: 100px">Back</a> &nbsp&nbsp&nbsp <input type="submit" name="cash_entry" value="Cash" class="tab entrybtn"> &nbsp&nbsp&nbsp <input type="submit" name="credit_entry" value="Credit" class="tab entrybtn">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  </td></tr>

  </form>
