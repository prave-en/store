<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <title>ledger</title>
</head>
<style type="text/css">
  .entrybtn{
    background-color: #2e2c2c;
  }
  .tab{
    box-shadow: 5px 5px 10px #2e2c2c;
  }
</style>
<body>
  <div id="printMe">
<?php
if (isset($_POST["suppliers_ledger"]))
  {
$suppliers_id = $_POST["suppliers_id"];
$suppliers_detail = $_POST["suppliers_detail"]; ?>

            <table border="0" width="100%">
              <tr><td colspan="4" align="center" height="100px"><?php include '../header/header1.php';?></td></tr>
              <tr align="center"><td colspan="4" height="50px"><b><u>Ledger</u></b></td></tr>
              <tr><td colspan="4" height="50">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Suppliers Id:</b> &nbsp <?php echo "$suppliers_id"; ?> &nbsp&nbsp&nbsp <b>Suppliers Detail:</b> &nbsp <?php echo "
              $suppliers_detail"; ?> </td></tr>
              <tr><td align="center"><table border="1" width="90%">
              <tr align="center">
                <td><b>Entry Date</td>
                <td><b>Bill no.</td>
                <td><b>Bill Date</td>
                <td><b>Receipt No</td>
                <td><b>Receipt Date</td>
                <td><b>Debit</td>
                <td><b>Credit</td>
                <td><b>Balance</td>
                <td><b>Remarks</td>
              </tr>

<?php
include ('../database/database_connection2.php');
include ('../database/database_connection.php');
$pdoQuery = "SELECT * FROM ledger WHERE suppliers_id='$suppliers_id' AND suppliers_detail='$suppliers_detail'";
            $pdoResult = $con->prepare($pdoQuery);
            $pdoExec = $pdoResult->execute(array(":suppliers_id"=>$suppliers_id));
    
            if($pdoExec)
            {
             foreach($pdoResult as $row)
            { 
              $date = $row['date'];
              $bill_no = $row['bill_no'];
              $bill_date = $row['bill_date'];
              $receipt_no = $row['receipt_no'];
              $receipt_date = $row['receipt_date'];
              $debit = $row['debit'];
              $credit = $row['credit'];
              $balance = $row['balance'];
              $remarks = $row['remarks'];
              ?>
              <tr align="center">
                 <td><?php echo "$date"; ?></td>
                <td><?php echo "$bill_no"; ?></td>
              <td><?php echo "$bill_date"; ?></td>
              <td><?php echo "$receipt_no"; ?></td>
              <td><?php echo "$receipt_date"; ?></td>
              <td><?php echo "$debit"; ?></td>
            <td><?php echo "$credit"; ?></td>
            <td><?php echo "$balance"; ?></td>
          <td><?php echo "$remarks"; ?></td></tr>

          <?php
            }
            } ?>
            </table></td></tr>
            <?php

$pdoQuery = "SELECT due_amount FROM suppliers WHERE suppliers_id='$suppliers_id' AND suppliers_detail='$suppliers_detail'";
            $pdoResult = $con->prepare($pdoQuery);
            $pdoExec = $pdoResult->execute(array(":suppliers_id"=>$suppliers_id));
    
            if($pdoExec)
            {
             foreach($pdoResult as $row)
            { 
              $due_amount = $row['due_amount']; ?>
              <tr><td colspan="4" align="right" height="50px"><b>Due Amount: &nbsp <?php echo "$due_amount"; ?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</b>
                
              </td></tr>
              <?php
            }
          }
           }
            ?>

            <?php
if (isset($_POST["customers_ledger"]))
  {
$customers_id = $_POST["customers_id"];
$customers_detail = $_POST["customers_detail"]; ?>

            <table border="0" width="100%">
              <tr><td colspan="4" align="center" height="100px"><?php include '../header/header1.php';?></td></tr>
              <tr align="center"><td colspan="4" height="50px"><b><u>Ledger</u></b></td></tr>
              <tr><td colspan="4" height="50px">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Customers Id:</b> &nbsp <?php echo "$customers_id"; ?> &nbsp&nbsp&nbsp <b>Customers Detail:</b> &nbsp <?php echo "
              $customers_detail"; ?> </td></tr>
              <tr><td align="center"><table border="1" width="90%">
              <tr align="center">
                <td><b>Entry Date</td>
                <td><b>Bill no.</td>
                <td><b>Bill Date</td>
                <td><b>Receipt No</td>
                <td><b>Receipt Date</td>
                <td><b>Debit</td>
                <td><b>Credit</td>
                <td><b>Balance</td>
                <td><b>Remarks</td>
              </tr>

<?php
include ('../database/database_connection2.php');
include ('../database/database_connection.php');
$pdoQuery = "SELECT * FROM ledger WHERE customers_id='$customers_id' AND customers_detail='$customers_detail'";
            $pdoResult = $con->prepare($pdoQuery);
            $pdoExec = $pdoResult->execute(array(":customers_id"=>$customers_id));
    
            if($pdoExec)
            {
             foreach($pdoResult as $row)
            { 
              $date = $row['date'];
              $bill_no = $row['bill_no'];
              $bill_date = $row['bill_date'];
              $receipt_no = $row['receipt_no'];
              $receipt_date = $row['receipt_date'];
              $debit = $row['debit'];
              $credit = $row['credit'];
              $balance = $row['balance'];
              $remarks = $row['remarks'];
              ?>
              <tr align="center">
                 <td><?php echo "$date"; ?></td>
                <td><?php echo "$bill_no"; ?></td>
              <td><?php echo "$bill_date"; ?></td>
              <td><?php echo "$receipt_no"; ?></td>
              <td><?php echo "$receipt_date"; ?></td>
              <td><?php echo "$debit"; ?></td>
            <td><?php echo "$credit"; ?></td>
            <td><?php echo "$balance"; ?></td>
          <td><?php echo "$remarks"; ?></td></tr>
        
          <?php
            }
            }?>
            </table></td></tr>
            <?php

            $pdoQuery = "SELECT credit_amount FROM credit_sales WHERE customers_id='$customers_id' AND customers_detail='$customers_detail'";
            $pdoResult = $con->prepare($pdoQuery);
            $pdoExec = $pdoResult->execute(array(":customers_id"=>$customers_id));
    
            if($pdoExec)
            {
             foreach($pdoResult as $row)
            { 
              $credit_amount = $row['credit_amount']; ?>
              <tr><td colspan="4" align="right" height="50px"><b>Credit Amount: &nbsp <?php echo "$credit_amount"; ?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</b>
                
              </td></tr>
              <?php
            }
          }
            }
            ?>
</table></div>
<div align="right" style="margin-bottom: 10px"><button onclick="printDiv('printMe')" class="tab entrybtn">Print</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</div>

</body>
</html>

<script>
    function printDiv(divName){
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
  </script>


