<?php
include('../database/database_connection.php');


if (isset($_POST["add_customers"]))
  {
    $customers_name = $_POST["customers_name"];
    $customers_address = $_POST["customers_address"];
    $customers_phone = $_POST["customers_phone"];
    $customers_email = $_POST["customers_email"];
    $customers_discription = $_POST["customers_discription"];
    $customers_id = "cus".rand(0,999);
    $customers_detail = $customers_name." , ".$customers_address;
    $credit_amount = "0";

    include ('../database/database_connection2.php');
             $query = mysqli_query($conn, "SELECT * FROM credit_sales WHERE customers_detail='$customers_detail'");
             $rows = mysqli_num_rows($query);

            if($rows == 1){ //matched start
              ?>
   <script >
   alert("Customers Already Exist");
  location= "index.php";
  </script>
<?php } 
else
{ //not matched start
   $pdo_add = $con->prepare("INSERT INTO credit_sales (customers_id,customers_detail,customers_phone,customers_email,customers_discription,credit_amount) VALUES (:customers_id,:customers_detail,:customers_phone,:customers_email,:customers_discription,:credit_amount)");

$pdo_add->bindparam(':customers_id',$customers_id);
$pdo_add->bindparam(':customers_detail',$customers_detail);
$pdo_add->bindparam(':customers_phone',$customers_phone);
$pdo_add->bindparam(':customers_email',$customers_email);
$pdo_add->bindparam(':customers_discription',$customers_discription);
$pdo_add->bindparam(':credit_amount',$credit_amount);
$pdo_add->execute();
?>
<script >
    alert("Customers Added");
  location= "index.php";
  </script>
  <?php
} }


if (isset($_POST["submit"]))//amount received
  {
$customers_id=$_POST['customers_id'];
$customers_detail=$_POST['customers_detail'];
$receipt_no=$_POST['receipt_no'];
$receipt_date=$_POST['receipt_date'];
$amount_received=$_POST['amount_received'];

include ('../database/database_connection2.php');

$query = mysqli_query($conn, "SELECT * FROM credit_sales WHERE customers_id='$customers_id' AND customers_detail='$customers_detail'");
 
 $rows = mysqli_num_rows($query);

 if($rows == 1){//matched

           $pdoQuery = "SELECT credit_amount FROM credit_sales WHERE customers_id=:customers_id AND customers_detail=:customers_detail";
    
    
    $pdoResult = $con->prepare($pdoQuery);
    
    
    $pdoExec = $pdoResult->execute(array(":customers_id"=>$customers_id, ":customers_detail"=>$customers_detail ));
    
     if($pdoExec)
    {
      foreach($pdoResult as $row)
            {     
              $credit_amount = $row['credit_amount'];
             
              $credit_amount = $credit_amount - $amount_received;
          
               $pdoQuery = "UPDATE credit_sales SET credit_amount = $credit_amount WHERE customers_id=:customers_id AND customers_detail=:customers_detail";
               $pdoResult = $con->prepare($pdoQuery);
               $pdoExec = $pdoResult->execute(array(":customers_id"=>$customers_id, ":customers_detail"=>$customers_detail ));

     if($pdoExec)
    {

$remarks = "cash received";
$pdo_add = $con->prepare("INSERT INTO ledger (receipt_no,receipt_date,customers_id,customers_detail,debit,balance,remarks) VALUES (:receipt_no,:receipt_date,:customers_id,:customers_detail,:debit,:balance,:remarks)");
$pdo_add->bindparam(':receipt_no',$receipt_no);
$pdo_add->bindparam(':receipt_date',$receipt_date);
$pdo_add->bindparam(':customers_id',$customers_id);
$pdo_add->bindparam(':customers_detail',$customers_detail);
$pdo_add->bindparam(':debit',$amount_received);
$pdo_add->bindparam(':balance',$credit_amount);
$pdo_add->bindparam(':remarks',$remarks);
if($pdo_add->execute()){
  ?>
  <script >
    alert("Cash Received");
  location= "index.php";
  </script>
  <?php
} //pdo add
         } //delete pdo exec
       }// foreach
   }//if
 }//matched end
   else{
     ?>
  <script >
    alert("Customer Doesnot Exist");
  location= "index.php";
  </script>
  <?php
} //not matched end
}
?> 