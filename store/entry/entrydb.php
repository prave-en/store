<?php
error_reporting(0);
 include '../database/database_connection.php';
 include '../database/database_connection2.php';

  if (isset($_POST["cash_entry"]))
  {
   
for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {
      $suppliers_detail[$a] = $_POST["suppliers_detail"][0];
      $bill_no[$a] = $_POST["bill_no"][0];
      $bill_date[$a] = $_POST["bill_date"][0];
      $product_name[$a] = $_POST["product_name"][$a];
      $unit[$a] = $_POST["unit"][$a];
      $quantity[$a] = $_POST["quantity"][$a];
      $free[$a] = $_POST["free"][$a];
      $discount_percentage[$a] = $_POST["discount_percentage"][0];
      $cost_price[$a] = $_POST["cost_price"][$a];

      $query = mysqli_query($conn, "SELECT * FROM suppliers WHERE suppliers_detail='$suppliers_detail[$a]'");
 $rows = mysqli_num_rows($query);
 if($rows == 1){ // supplier matched
  
foreach($query as $row)
            {     
               $suppliers_id[$a] = $row['suppliers_id'];
            } //foreach

$query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name[$a]' AND unit='$unit[$a]'");
            $rows = mysqli_num_rows($query);
            if($rows == 1){ //matched start
      foreach($query as $row)
               {     
              $store_quantity[$a] = $row['store_quantity'];
              $product_id[$a] = $row['product_id'];
              }//foreach
            }// product match end

              $total_amount[$a] = $quantity[$a]*$cost_price[$a];
              $TA = array_sum($total_amount);
              $TAA = $TA - ($TA * $discount_percentage[0] / 100);
              $t_qty[$a] = 10;
              $store_quantity[$a]=$t_qty[$a] + $store_quantity[$a];
              
              $pdoQuery = "UPDATE store SET store_quantity = $store_quantity[$a] WHERE product_name=:product_name and unit = :unit";
              $pdoResult = $con->prepare($pdoQuery);
              $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$a], ":unit"=>$unit[$a] ));

              
              $remarks[$a]="cash";
              $pdo_add=$con->prepare('INSERT INTO  entry(bill_no,bill_date,suppliers_id,suppliers_detail,product_id,product_name,unit,quantity,free,cost_price,discount_percentage,remarks)values(:bill_no,:bill_date,:suppliers_id,:suppliers_detail,:product_id,:product_name,:unit,:quantity,:free,:cost_price,:discount_percentage,:remarks)');
            $pdo_add->bindparam(':bill_no',$bill_no[$a]);
            $pdo_add->bindparam(':bill_date',$bill_date[$a]);
            $pdo_add->bindparam(':suppliers_id',$suppliers_id[$a]);
            $pdo_add->bindparam(':suppliers_detail',$suppliers_detail[$a]);
            $pdo_add->bindparam(':product_id',$product_id[$a]);
            $pdo_add->bindparam(':product_name',$product_name[$a]);
            $pdo_add->bindparam(':unit',$unit[$a]);
            $pdo_add->bindparam(':quantity',$quantity[$a]);
            $pdo_add->bindparam(':free',$free[$a]);
            $pdo_add->bindparam(':cost_price',$cost_price[$a]);
            $pdo_add->bindparam(':discount_percentage',$discount_percentage[$a]);
            $pdo_add->bindparam(':remarks',$remarks[$a]);
            $pdo_add->execute();

             } //suppliers matched
             else{
              ?>             
<script >
alert("Supplier not Available .....Register Suppliers First");
location= "index.php";
</script>
<?php
             }
             }// main for

                for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {
      $query = mysqli_query($conn, "SELECT * FROM suppliers WHERE suppliers_detail='$suppliers_detail[$a]'");
 $rows = mysqli_num_rows($query);
 if($rows == 1){

           $pdo_add = $con->prepare("INSERT INTO ledger (bill_no,bill_date,suppliers_id, suppliers_detail,total_amount,remarks) VALUES (:bill_no,:bill_date,:suppliers_id,:suppliers_detail,:total_amount,:remarks)");
            $pdo_add->bindparam(':bill_no',$bill_no[$a]);
            $pdo_add->bindparam(':bill_date',$bill_date[$a]);
            $pdo_add->bindparam(':suppliers_id',$suppliers_id[$a]);
            $pdo_add->bindparam(':suppliers_detail',$suppliers_detail[$a]);
            $pdo_add->bindparam(':total_amount',$TAA);
            $pdo_add->bindparam(':remarks',$remarks[$a]);
            $pdo_add->execute();
            break;
          }//supplier match
    } //2nd for
?>
<script >
alert("Purchase Successful \nSupplier = <?php echo $suppliers_detail[0]; ?> \nTotal amount = <?php echo $TAA; ?> \nRemarks = Cash");
location= "index.php";
</script>
<?php  
  } //main if



  if (isset($_POST["credit_entry"]))
  {
   
for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {
      $suppliers_detail[$a] = $_POST["suppliers_detail"][0];
      $bill_no[$a] = $_POST["bill_no"][0];
      $bill_date[$a] = $_POST["bill_date"][0];
      $product_name[$a] = $_POST["product_name"][$a];
      $unit[$a] = $_POST["unit"][$a];
      $quantity[$a] = $_POST["quantity"][$a];
      $free[$a] = $_POST["free"][$a];
      $discount_percentage[$a] = $_POST["discount_percentage"][0];
      $cost_price[$a] = $_POST["cost_price"][$a];

      $query = mysqli_query($conn, "SELECT * FROM suppliers WHERE suppliers_detail='$suppliers_detail[$a]'");
 $rows = mysqli_num_rows($query);
 if($rows == 1){ // supplier matched
  
foreach($query as $row)
            {     
               $suppliers_id[$a] = $row['suppliers_id'];
               $due_amount = $row['due_amount'];
            } //foreach

$query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name[$a]' AND unit='$unit[$a]'");
            $rows = mysqli_num_rows($query);
            if($rows == 1){ //matched start
      foreach($query as $row)
               {     
              $store_quantity[$a] = $row['store_quantity'];
              $product_id[$a] = $row['product_id'];
              }//foreach
            }// product match end

              $total_amount[$a] = $quantity[$a]*$cost_price[$a];
              $TA = array_sum($total_amount);
              $TAA = $TA - ($TA * $discount_percentage[0] / 100);
              $due_amount = $due_amount + $TAA;
              $t_qty[$a] = 10;
              $store_quantity[$a]=$t_qty[$a] + $store_quantity[$a];
              

              $pdoQuery = "UPDATE store SET store_quantity = $store_quantity[$a] WHERE product_name=:product_name and unit = :unit";
              $pdoResult = $con->prepare($pdoQuery);
              $pdoExec = $pdoResult->execute(array(":product_name"=>$product_name[$a], ":unit"=>$unit[$a] ));

              
              $remarks[$a]="credit";
              $pdo_add=$con->prepare('INSERT INTO  entry(bill_no,bill_date,suppliers_id,suppliers_detail,product_id,product_name,unit,quantity,free,cost_price,discount_percentage,remarks)values(:bill_no,:bill_date,:suppliers_id,:suppliers_detail,:product_id,:product_name,:unit,:quantity,:free,:cost_price,:discount_percentage,:remarks)');
            $pdo_add->bindparam(':bill_no',$bill_no[$a]);
            $pdo_add->bindparam(':bill_date',$bill_date[$a]);
            $pdo_add->bindparam(':suppliers_id',$suppliers_id[$a]);
            $pdo_add->bindparam(':suppliers_detail',$suppliers_detail[$a]);
            $pdo_add->bindparam(':product_id',$product_id[$a]);
            $pdo_add->bindparam(':product_name',$product_name[$a]);
            $pdo_add->bindparam(':unit',$unit[$a]);
            $pdo_add->bindparam(':quantity',$quantity[$a]);
            $pdo_add->bindparam(':free',$free[$a]);
            $pdo_add->bindparam(':cost_price',$cost_price[$a]);
            $pdo_add->bindparam(':discount_percentage',$discount_percentage[$a]);
            $pdo_add->bindparam(':remarks',$remarks[$a]);
            $pdo_add->execute();

             } //suppliers matched
             else{
              ?>             
<script >
alert("Supplier not Available ....Register Suppliers First");
location= "index.php";
</script>
<?php
             }
             }// main for

                for ($a = 0; $a < count($_POST["product_name"]); $a++)
    {
      $query = mysqli_query($conn, "SELECT * FROM suppliers WHERE suppliers_detail='$suppliers_detail[$a]'");
 $rows = mysqli_num_rows($query);
 if($rows == 1){

           $pdo_add = $con->prepare("INSERT INTO ledger (bill_no,bill_date,suppliers_id, suppliers_detail,debit,balance,remarks) VALUES (:bill_no,:bill_date,:suppliers_id,:suppliers_detail,:debit,:balance,:remarks)");
            $pdo_add->bindparam(':bill_no',$bill_no[$a]);
            $pdo_add->bindparam(':bill_date',$bill_date[$a]);
            $pdo_add->bindparam(':suppliers_id',$suppliers_id[$a]);
            $pdo_add->bindparam(':suppliers_detail',$suppliers_detail[$a]);
            $pdo_add->bindparam(':debit',$TAA);
            $pdo_add->bindparam(':balance',$due_amount);
            $pdo_add->bindparam(':remarks',$remarks[$a]);
            $pdo_add->execute();

            $pdoQuery = "UPDATE suppliers SET due_amount = $due_amount WHERE suppliers_detail=:suppliers_detail";
              $pdoResult = $con->prepare($pdoQuery);
              $pdoExec = $pdoResult->execute(array(":suppliers_detail"=>$suppliers_detail[$a]));


            break;
          }//supplier match
    } //2nd for
?>
<script >
alert("Purchase Successful \nSupplier = <?php echo $suppliers_detail[0]; ?> \nTotal amount = <?php echo $TAA; ?> \nRemarks = Credit");
location= "index.php";
</script>
<?php  
  } //main if

  
  