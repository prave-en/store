<?php include ('../session/m_session.php'); ?>
<?php
 //error_reporting(0);
 for ($a = 0; $a < count($_POST["product_name"]); $a++){
 $customers_detail[$a] = $_POST["customers_detail"][0];
 $bill_date[$a] = $_POST["bill_date"][0];}

include ('../database/database_connection1.php');
$sql = "SELECT * FROM sales order by bill_no desc LIMIT 1";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
     $bill_no = $row["bill_no"];
     //echo "$bill_no"."<br>";
    }}

$sql="SELECT count(sales_id) AS total FROM sales";
$result=mysqli_query($con,$sql);
$values=mysqli_fetch_assoc($result);
$num_row=$values['total'];
//echo($num_row) ."<br>";

if ($num_row==0) {
$bill_no="1";
}
   
else{
$bill_no=$bill_no+1;
} ?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/sales.css">
  <title>Bill</title>
</head>
<style type="text/css">
  .tab{
    box-shadow: 5px 5px 10px #2e2c2c;
  }
  .printbtn{
    background-color: #2e2c2c;
  }
</style>
<body>


<div id="printMe">
    <table align="center" border="0" width="1340" bgcolor="#ffffff">
    <tr><td colspan="11" class="header"> <?php include ('../header/header1.php'); ?> </td></tr>
    <tr><td colspan="11" height="20"></td></tr>
  
    <tr bgcolor="#ffffff"><td colspan="11" height="30" align="center"><b class="purchase">PURCHASE BILL No. <?php echo "$bill_no"; ?></b></td></tr>
    <tr><td colspan="11" height="10"></td></tr>
      <tr><td colspan="11" height="20">
        <b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCustomers Name:</b>&nbsp&nbsp&nbsp <?php echo "$customers_detail[0]"; ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b> Date:</b> &nbsp&nbsp&nbsp<?php echo "$bill_date[0]"; ?> </td></tr>
<tr><td colspan="11" align="center"><table border="1" width="1200"><tr align="center"><td>PRODUCT DISCRIPTION</td><td>QUANTITY</td><td>RATE</td><td>TOTAL PRICE</td></tr>

</body>
</html>



  <?php
  include("../database/database_connection.php");
  include("../database/database_connection2.php");

  if (isset($_POST["cash_sales"]))
  {
    for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {
      $customers_detail[$a] = $_POST["customers_detail"][0];
      $bill_date[$a] = $_POST["bill_date"][0];
      $product_name[$a] = $_POST["product_name"][$a];
      $unit[$a] = $_POST["unit"][$a];
      $quantity[$a] = $_POST["quantity"][$a];
      $rate[$a] = $_POST["rate"][$a];
      $discount_percentage[$a] = $_POST["discount_percentage"][0];


      $query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name[$a]' AND unit='$unit[$a]'");
            $rows = mysqli_num_rows($query);
            if($rows == 1){ //matched start
      foreach($query as $row)
               {     
              $store_quantity[$a] = $row['store_quantity'];
              $product_id[$a] = $row['product_id'];
              }//foreach

              if ($quantity[$a] == "0") {
              }
              else{
              $store_quantity[$a] = $store_quantity[$a] - $quantity[$a];

              $total_amount[$a] = $rate[$a] * $quantity[$a];
              $TA = array_sum($total_amount);
              $discount_amount[$a] = $rate[$a] / 100 * $discount_percentage[$a];
              $after_discount[$a] = $rate[$a] - $discount_amount[$a];
              $total_amount1[$a] = $after_discount[$a] * $quantity[$a];
              $TA1 = array_sum($total_amount1);
              $DA = $TA / 100 * $discount_percentage[$a];
              $grand_total = $TA - $DA;
             
                $pdoQuery = "UPDATE store  SET store_quantity = $store_quantity[$a] WHERE product_name=:product_name and unit = :unit";
              $pdoResult = $con->prepare($pdoQuery);
              $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$a], ":unit"=>$unit[$a] ));

              $remarks[$a] = "cash";
$pdo_add = $con->prepare("INSERT INTO sales (bill_no,bill_date,customers_detail,product_id,product_name,quantity,unit, mrp,discount_percentage,after_discount,total_amount,remarks) VALUES (:bill_no,:bill_date,:customers_detail,:product_id,:product_name,:quantity,:unit,:mrp,:discount_percentage,:after_discount,:total_amount,:remarks)");
$pdo_add->bindparam(':bill_no',$bill_no);
$pdo_add->bindparam(':bill_date',$bill_date[$a]);
$pdo_add->bindparam(':customers_detail',$customers_detail[$a]);
$pdo_add->bindparam(':product_id',$product_id[$a]);
$pdo_add->bindparam(':product_name',$product_name[$a]);
$pdo_add->bindparam(':quantity',$quantity[$a]);
$pdo_add->bindparam(':unit',$unit[$a]);
$pdo_add->bindparam(':mrp',$rate[$a]);
$pdo_add->bindparam(':discount_percentage',$discount_percentage[$a]);
$pdo_add->bindparam(':after_discount',$after_discount[$a]);
$pdo_add->bindparam(':total_amount',$total_amount1[$a]);
$pdo_add->bindparam(':remarks',$remarks[$a]);
$pdo_add->execute();

echo "<tr align='center'>"."<td>";
echo "$product_name[$a]"."</td>"."<td>";
echo "$quantity[$a]"."</td>"."<td>";echo "$rate[$a]"."</td>"."<td>";
echo "$total_amount[$a]"."</td>"."</tr>";

              }// esle
            }// match end
            else{
             
            }

    } // main for

    echo "<tr align='center'>"."<td colspan='3'>"."</td>"."<td>";echo "<b>"."$TA";echo"</td>"."<tr>";

echo "<tr align='center'>"."<td colspan='3'>"."<b>"."Discount Percentage(Discount Amount)"."</td>"."<td>"."<b>"."$discount_percentage[0]"."%"."( $DA)"."</td>"."</tr>";

echo "<tr align='center'>"."<td colspan='3'>"."<b>"."Grand Total"."</td>"."<td>";echo "<b>"."$grand_total";echo"</td>"."</tr>";

  } // main if



 if (isset($_POST["credit_sales"]))
  {
    for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {
      $customers_detail[$a] = $_POST["customers_detail"][0];
      $bill_date[$a] = $_POST["bill_date"][0];
      $product_name[$a] = $_POST["product_name"][$a];
      $unit[$a] = $_POST["unit"][$a];
      $quantity[$a] = $_POST["quantity"][$a];
      $rate[$a] = $_POST["rate"][$a];
      $discount_percentage[$a] = $_POST["discount_percentage"][0];

      $query = mysqli_query($conn, "SELECT * FROM credit_sales WHERE customers_detail='$customers_detail[$a]'");
 $rows = mysqli_num_rows($query);
 if($rows == 1){ // matched
  
foreach($query as $row)
            {     
              $credit_amount = $row['credit_amount'];
              $customers_id[$a] = $row['customers_id'];
              } //foreach

              $query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name[$a]' AND unit='$unit[$a]'");
            $rows = mysqli_num_rows($query);
            if($rows == 1){ //matched start
      foreach($query as $row)
               {     
              $store_quantity[$a] = $row['store_quantity'];
              $product_id[$a] = $row['product_id'];

              }//foreach
               if ($quantity[$a] == "0") {
              }
              else{
              $store_quantity[$a] = $store_quantity[$a] - $quantity[$a];

              $total_amount[$a] = $rate[$a] * $quantity[$a];
              $TA = array_sum($total_amount);
              $discount_amount[$a] = $rate[$a] / 100 * $discount_percentage[$a];
              $after_discount[$a] = $rate[$a] - $discount_amount[$a];
              $total_amount1[$a] = $after_discount[$a] * $quantity[$a];
              $TA1 = array_sum($total_amount1);
              $DA = $TA / 100 * $discount_percentage[$a];
              $grand_total = $TA - $DA;
              $credit_amount = $grand_total + $credit_amount;
              
              $pdoQuery = "UPDATE store  SET store_quantity = $store_quantity[$a] WHERE product_name=:product_name and unit = :unit";
              $pdoResult = $con->prepare($pdoQuery);
              $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$a], ":unit"=>$unit[$a] ));

$remarks[$a] = "credit";
$pdo_add = $con->prepare("INSERT INTO sales (bill_no,bill_date,customers_detail,product_id,product_name,quantity,unit, mrp,discount_percentage,after_discount,total_amount,remarks) VALUES (:bill_no,:bill_date,:customers_detail,:product_id,:product_name,:quantity,:unit,:mrp,:discount_percentage,:after_discount,:total_amount,:remarks)");
$pdo_add->bindparam(':bill_no',$bill_no);
$pdo_add->bindparam(':bill_date',$bill_date[$a]);
$pdo_add->bindparam(':customers_detail',$customers_detail[$a]);
$pdo_add->bindparam(':product_id',$product_id[$a]);
$pdo_add->bindparam(':product_name',$product_name[$a]);
$pdo_add->bindparam(':quantity',$quantity[$a]);
$pdo_add->bindparam(':unit',$unit[$a]);
$pdo_add->bindparam(':mrp',$rate[$a]);
$pdo_add->bindparam(':discount_percentage',$discount_percentage[$a]);
$pdo_add->bindparam(':after_discount',$after_discount[$a]);
$pdo_add->bindparam(':total_amount',$total_amount1[$a]);
$pdo_add->bindparam(':remarks',$remarks[$a]);
$pdo_add->execute();

            echo "<tr align='center'>"."<td>";
echo "$product_name[$a]"."</td>"."<td>";
echo "$quantity[$a]"."</td>"."<td>";echo "$rate[$a]"."</td>"."<td>";
echo "$total_amount[$a]"."</td>"."</tr>";
}//store quantity wala else
}//product match
else{
} //product not match end
             }// customer match
else{
  ?>             
<script >
alert("Customer not Available .....For Credit Purchase Register Customers First");
location= "index.php";
</script>
<?php
}
    }// main for

    for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {
      $pdo_add = $con->prepare("INSERT INTO ledger (bill_no,bill_date,customers_id, customers_detail,credit,balance,remarks) VALUES (:bill_no,:bill_date,:customers_id,:customers_detail,:credit,:balance,:remarks)");
            $pdo_add->bindparam(':bill_no',$bill_no);
            $pdo_add->bindparam(':bill_date',$bill_date[$a]);
            $pdo_add->bindparam(':customers_id',$customers_id[$a]);
            $pdo_add->bindparam(':customers_detail',$customers_detail[$a]);
            $pdo_add->bindparam(':credit',$grand_total);
            $pdo_add->bindparam(':balance',$credit_amount);
            $pdo_add->bindparam(':remarks',$remarks[$a]);
            $pdo_add->execute();

            $pdoQuery = "UPDATE credit_sales SET credit_amount = $credit_amount WHERE customers_detail=:customers_detail";
              $pdoResult = $con->prepare($pdoQuery);
              $pdoExec = $pdoResult->execute(array(":customers_detail"=>$customers_detail[$a]));
            break;
    }

    echo "<tr align='center'>"."<td colspan='3'>"."</td>"."<td>";echo "<b>"."$TA";echo"</td>"."<tr>";

echo "<tr align='center'>"."<td colspan='3'>"."<b>"."Discount Percentage(Discount Amount)"."</td>"."<td>"."<b>"."$discount_percentage[0]"."%"."( $DA)"."</td>"."</tr>";

echo "<tr align='center'>"."<td colspan='3'>"."<b>"."Grand Total"."</td>"."<td>";echo "<b>"."$grand_total";echo"</td>"."</tr>";
  }//main if
  ?>
  </table></td></tr></table></div>
<table border="0" align="center" width="1340">
<tr><td height="20"></td></tr>
<tr><td align="right">
  <a href="../sales" class="tab printbtn" style="width: 100px">Done</a> &nbsp&nbsp&nbsp
<button onclick="printDiv('printMe')" class="tab printbtn">Print</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td></tr></table>

<script>
    function printDiv(divName){
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
  </script>

     
    
            