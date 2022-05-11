<?php include ('../session/m_session.php'); ?>
<?php
 error_reporting(0);
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
<body>


<div id="printMe">
    <table align="center" border="0" width="1340" bgcolor="#ffffff">
    <tr><td colspan="11" class="header"> <?php include ('../header/header1.php'); ?> </td></tr>
    <tr><td colspan="11" height="20"></td></tr>
  
    <tr bgcolor="#ffffff"><td colspan="11" height="30" align="center"><b class="purchase">PURCHASE BILL No. <?php echo "$bill_no"; ?></b></td></tr>
    <tr><td colspan="11" height="10"></td></tr>
      <tr><td colspan="11" height="20">
        <b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCustomers Name:</b>&nbsp&nbsp&nbsp <?php echo "$customers_detail[0]"; ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b> Date:</b> &nbsp&nbsp&nbsp<?php echo "$bill_date[0]"; ?> </td></tr>
<tr><td colspan="11" align="center"><table border="1" width="1200"><tr align="center"><td>PRODUCT DISCRIPTION</td><td>QUANTITY</td><td>RATE</td><td>TOTAL PRICE</td><td>REMARKS</td></tr>

</body>
</html>



  <?php
  include("../database/database_connection.php");
  if (isset($_POST["cash_sales"]))
  {
    for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {
      $customers_detail[$a] = $_POST["customers_detail"][0];
      $product_name[$a] = $_POST["product_name"][$a];
      $unit[$a] = $_POST["unit"][$a];
      $quantity[$a] = $_POST["quantity"][$a];
      $discount_percentage[$a] = $_POST["discount_percentage"][0];
     
    
            include ('../database/database_connection2.php');
            $query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name[$a]' AND unit='$unit[$a]'");
            $rows = mysqli_num_rows($query);
            if($rows == 1){ //matched start

                  foreach($query as $row)
               {     
              $store_quantity[$a] = $row['store_quantity'];
               }

           if ($store_quantity[$a] < $quantity[$a])
{           
echo "<tr align='center'>"."<td>"; echo "$product_name[$a]"."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>";
echo ""."</td>"."<td>";echo "out of stock"."</td>"."</tr>";
}
            else{
              $store_quantity[$a] = $store_quantity[$a] - $quantity[$a];
              
              $pdoQuery = "UPDATE store  SET store_quantity = $store_quantity[$a] WHERE product_name=:product_name and unit = :unit";
              $pdoResult = $con->prepare($pdoQuery);
              $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$a], ":unit"=>$unit[$a] ));
             
            $query = mysqli_query($conn, "SELECT * FROM pricing_details WHERE product_name='$product_name[$a]' AND unit='$unit[$a]'");
            $rows = mysqli_num_rows($query);
            if($rows == 1){
            
            foreach($query as $row)
            {
              $cost_price[$a] = $row['cost_price'];
              $mrp[$a] = $row['mrp'];
              $total_price[$a] = $mrp[$a] * $quantity[$a];
              $discount_amount[$a] = $mrp[$a]/100*$discount_percentage[0];
              $after_discount[$a] = $mrp[$a] - $discount_amount[$a];//new sp
              $total_price1[$a] = $quantity[$a] * $after_discount[$a];
              $TA = array_sum($total_price);
              $DA = $TA/100*$discount_percentage[0];
              $grand_total = $TA - $DA;
              $unit_profit[$a] = $after_discount[$a] - $cost_price[$a];
              $total_profit[$a] = $unit_profit[$a] * $quantity[$a];
              
             }}

$remarks[$a] = "cash";
$pdo_add = $con->prepare("INSERT INTO sales (bill_no,product_name,quantity,customers_detail,cost_price, mrp,after_discount,total_price,total_price1,discount_percentage,remarks) VALUES (:bill_no,:product_name,:quantity,:customers_detail,:cost_price,:mrp,:after_discount,:total_price,:total_price1,:discount_percentage,:remarks)");
$pdo_add->bindparam(':bill_no',$bill_no);
$pdo_add->bindparam(':product_name',$product_name[$a]);
$pdo_add->bindparam(':quantity',$quantity[$a]);
$pdo_add->bindparam(':customers_detail',$customers_detail[$a]);
$pdo_add->bindparam(':cost_price',$cost_price[$a]);
$pdo_add->bindparam(':mrp',$mrp[$a]);
$pdo_add->bindparam(':after_discount',$after_discount[$a]);
$pdo_add->bindparam(':total_price',$total_price[$a]);
$pdo_add->bindparam(':total_price1',$total_price1[$a]);
$pdo_add->bindparam(':discount_percentage',$discount_percentage[$a]);
$pdo_add->bindparam(':remarks',$remarks[$a]);
$pdo_add->execute();

$pdo_add = $con->prepare("INSERT INTO profit_loss (product_name,quantity,unit_profit,total_profit) VALUES (:product_name,:quantity,:unit_profit,:total_profit)");
$pdo_add->bindparam(':product_name',$product_name[$a]);
$pdo_add->bindparam(':quantity',$quantity[$a]);
$pdo_add->bindparam(':unit_profit',$unit_profit[$a]);

$pdo_add->bindparam(':total_profit',$total_profit[$a]);
$pdo_add->execute();

echo "<tr align='center'>"."<td>";
echo "$product_name[$a]"."</td>"."<td>";
echo "$quantity[$a]"."</td>"."<td>";echo "$mrp[$a]"."</td>"."<td>";
echo "$total_price[$a]"."</td>"."<td>";echo ""."</td>"."</tr>";

}//else quantity wala
           
        }// matched end
        else{ //not matched start
echo "<tr align='center'>"."<td>"; echo "$product_name[$a]"."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>";
echo ""."</td>"."<td>";echo "unavailable "."</td>"."</tr>";
        }//not matched end
      } //for


echo "<tr align='center'>"."<td colspan='3'>"."</td>"."<td>";echo "<b>"."$TA";echo"</td>"."<td>"."</td>";

echo "<tr align='center'>"."<td colspan='3'>"."<b>"."Discount Percentage(Discount Amount)"."</td>"."<td>"."<b>"."$discount_percentage[0]"."%"."( $DA)"."</td>"."<td>"."</td>"."</td>"."</tr>";

echo "<tr align='center'>"."<td colspan='3'>"."<b>"."Grand Total"."</td>"."<td>";echo "<b>"."$grand_total";echo"</td>"."<td>"."Cash"."</td>"."</tr>";
}//main if

?>


<?php
  include("../database/database_connection.php");
  if (isset($_POST["credit_sales"]))
  {
    for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {
$customers_detail[$a] = $_POST["customers_detail"][0];
$customers_detail[$a] = $customers_detail[0];
$query = mysqli_query($conn, "SELECT * FROM credit_sales WHERE customers_detail='$customers_detail[$a]'");
 $rows = mysqli_num_rows($query);
 if($rows == 1){ // matched
  
foreach($query as $row)
            {     
              $credit_amount = $row['credit_amount'];
              $customers_id = $row['customers_id'];
              
               } //foreach

      $product_name[$a] = $_POST["product_name"][$a];
      $unit[$a] = $_POST["unit"][$a];
      $quantity[$a] = $_POST["quantity"][$a];
      $discount_percentage[$a] = $_POST["discount_percentage"][0];
     
    
            include ('../database/database_connection2.php');
            $query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name[$a]' AND unit='$unit[$a]'");
            $rows = mysqli_num_rows($query);
            if($rows == 1){ //matched start
      foreach($query as $row)
               {     
              $store_quantity[$a] = $row['store_quantity'];
               }

           if ($store_quantity[$a] < $quantity[$a])
{           
echo "<tr align='center'>"."<td>"; echo "$product_name[$a]"."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>";
echo ""."</td>"."<td>";echo "out of stock"."</td>"."</tr>";
} //less store quantity

            else{
              $store_quantity[$a] = $store_quantity[$a] - $quantity[$a];
              
              $pdoQuery = "UPDATE store  SET store_quantity = $store_quantity[$a] WHERE product_name=:product_name and unit = :unit";
              $pdoResult = $con->prepare($pdoQuery);
              $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$a], ":unit"=>$unit[$a] )); }//else store quantity

            $query = mysqli_query($conn, "SELECT * FROM pricing_details WHERE product_name='$product_name[$a]' AND unit='$unit[$a]'");
            $rows = mysqli_num_rows($query);
            if($rows == 1){ //price matched
            
            foreach($query as $row)
            {
              $cost_price[$a] = $row['cost_price'];
              $mrp[$a] = $row['mrp'];
              $total_price[$a] = $mrp[$a] * $quantity[$a];
              $discount_amount[$a] = $mrp[$a]/100*$discount_percentage[0];
              $after_discount[$a] = $mrp[$a] - $discount_amount[$a];//new sp
              $total_price1[$a] = $quantity[$a] * $after_discount[$a];
              $TA = array_sum($total_price);
              $DA = $TA/100*$discount_percentage[0];
              $grand_total = $TA - $DA;
              $unit_profit[$a] = $after_discount[$a] - $cost_price[$a];
              $total_profit[$a] = $unit_profit[$a] * $quantity[$a];
              $credit_amount1 = $credit_amount + $grand_total;


              
             } //foreach
           }//price matched
           $pdoQuery = "UPDATE credit_sales SET credit_amount = $credit_amount1 WHERE customers_detail=:customers_detail";
              $pdoResult = $con->prepare($pdoQuery);
              $pdoExec = $pdoResult->execute(array(":customers_detail"=>$customers_detail[$a]));

$remarks[$a] = "credit";
$pdo_add = $con->prepare("INSERT INTO sales (bill_no,product_name,quantity,customers_detail,cost_price, mrp,after_discount,total_price,total_price1,discount_percentage,remarks) VALUES (:bill_no,:product_name,:quantity,:customers_detail,:cost_price,:mrp,:after_discount,:total_price,:total_price1,:discount_percentage,:remarks)");
$pdo_add->bindparam(':bill_no',$bill_no);
$pdo_add->bindparam(':product_name',$product_name[$a]);
$pdo_add->bindparam(':quantity',$quantity[$a]);
$pdo_add->bindparam(':customers_detail',$customers_detail[$a]);
$pdo_add->bindparam(':cost_price',$cost_price[$a]);
$pdo_add->bindparam(':mrp',$mrp[$a]);
$pdo_add->bindparam(':after_discount',$after_discount[$a]);
$pdo_add->bindparam(':total_price',$total_price[$a]);
$pdo_add->bindparam(':total_price1',$total_price1[$a]);
$pdo_add->bindparam(':discount_percentage',$discount_percentage[$a]);
$pdo_add->bindparam(':remarks',$remarks[$a]);
$pdo_add->execute();

$pdo_add = $con->prepare("INSERT INTO profit_loss (product_name,quantity,unit_profit,total_profit) VALUES (:product_name,:quantity,:unit_profit,:total_profit)");
$pdo_add->bindparam(':product_name',$product_name[$a]);
$pdo_add->bindparam(':quantity',$quantity[$a]);
$pdo_add->bindparam(':unit_profit',$unit_profit[$a]);
$pdo_add->bindparam(':total_profit',$total_profit[$a]);
$pdo_add->execute();

echo "<tr align='center'>"."<td>";
echo "$product_name[$a]"."</td>"."<td>";
echo "$quantity[$a]"."</td>"."<td>";echo "$mrp[$a]"."</td>"."<td>";
echo "$total_price[$a]"."</td>"."<td>";echo ""."</td>"."</tr>";
           
        }// matched end

        else{ //not matched start
echo "<tr align='center'>"."<td>"; echo "$product_name[$a]"."</td>"."<td>";
echo ""."</td>"."<td>";echo ""."</td>"."<td>";
echo ""."</td>"."<td>";echo "unavailable "."</td>"."</tr>";
        }//not matched end

echo "<tr align='center'>"."<td colspan='3'>"."</td>"."<td>";echo "<b>"."$TA";echo"</td>"."<td>"."</td>";

echo "<tr align='center'>"."<td colspan='3'>"."<b>"."Discount Percentage(Discount Amount)"."</td>"."<td>"."<b>"."$discount_percentage[0]"."%"."( $DA)"."</td>"."<td>"."</td>"."</td>"."</tr>";

echo "<tr align='center'>"."<td colspan='3'>"."<b>"."Grand Total"."</td>"."<td>";echo "<b>"."$grand_total";echo"</td>"."<td>"."credit"."</td>"."</tr>";



            $pdo_add = $con->prepare("INSERT INTO ledger (bill_no,customers_id, customers_detail,total_amount,remarks) VALUES (:bill_no,:customers_id,:customers_detail,:total_amount,:remarks)");
$pdo_add->bindparam(':bill_no',$bill_no);
$pdo_add->bindparam(':customers_id',$customers_id);
$pdo_add->bindparam(':customers_detail',$customers_detail[$a]);
$pdo_add->bindparam(':total_amount',$grand_total);
$pdo_add->bindparam(':remarks',$remarks[0]);
$pdo_add->execute();
}//match end

else
{//not matched start
?>
<script >
   alert("Customer Does Not Exist ......For Credit Sales Add Customers First");
  location= "index.php";
  </script>
  <?php
}//not matched end
}//main if
}//for
?>

</table></td></tr></table></div>
<table border="0" align="center" width="1340">
<tr><td height="20"></td></tr>
<tr><td align="right">
<button onclick="printDiv('printMe')" class="printbtn">Print</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td></tr></table>

<script>
    function printDiv(divName){
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
  </script>