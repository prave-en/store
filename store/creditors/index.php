<?php include ('../session/m_session.php');
include ('../resources/model.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <title>creditors</title>
</head>
<style type="text/css">
	
  tr th{
  	position: sticky;
  	top: 0;
  	}
    
  .container{
  height: 435px;
}
  .entrybtn{
    width: 20%;
    display: inline-block;
    background-color: #2e2c2c;
  }
  .entrybtn:hover{
    text-decoration: none;
    color: white;
  }
   input[type=text],input[type=number]{
    height: 30px;
    border:none;
    border-bottom: 1px solid green;
 }
 input[type=text]:focus,input[type=number]:focus{
  background-color: white;
 }
 input[type=date]{
  width: 325px;
  border-radius: 5px;
  border:none;
  border-bottom: 1px solid green;
  outline: none;
 }
 .tab{
    box-shadow: 5px 5px 10px #2e2c2c;
  }
 
</style>
<body>

	<table border="0" width="100%" bgcolor="#a3a2a2">
            <tr><td class="header" colspan="2"><?php include('../header/header1.php'); ?></td></tr>
            <tr><td height="30" colspan="2" align="center"><b>CUSTOMERS<b></td></tr>
                <tr><td height="20" colspan="2"></td></tr>
                <tr><td class="container" colspan="2" align="center">
                	<div class="overflow">

                	<table border="1" class="tab" width="97%">
                		<tr align="center"><th>Customers Id</th><th>Customers Details</th><th>Phone</th><th>Email</th><th>Discription</th><th>Credit Amount</th></tr>

                			<?php
 include ('../database/database_connection1.php');
 $sql = "SELECT * FROM credit_sales";
$result = mysqli_query($con, $sql);
$sum = 0;
if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr align='center'>";
        echo "<td width=''>". $row["customers_id"]. "</td>";
        echo "<td width=''>". $row["customers_detail"]. "</td>";
        echo "<td width=''>". $row["customers_phone"]. "</td>";
        echo "<td width=''>". $row["customers_email"]. "</td>";
        echo "<td width=''>". $row["customers_discription"]. "</td>";
        echo "<td width=''>". $row["credit_amount"]. "</td>"."</tr>";
        $sum += $row['credit_amount'];
        
    }
}
mysqli_close($con);
?>

                	</table></div>
                </td></tr>
                <tr><td height="30" align="right" colspan="2"><b>Total Credit = </b>
                  <b><?php echo $sum; ?></b>&nbsp&nbsp&nbsp
                	</td></tr>
                	<tr><td colspan="2" align="center" height="30">
                		 
                     <a href="../admin" class="tab entrybtn">Back</a>&nbsp&nbsp&nbsp
                     <button type="button" class="tab entrybtn" data-toggle="modal" data-target="#exampleModalCenter">Add Customers</button>&nbsp&nbsp&nbsp
                     <button type="button" class="tab entrybtn" data-toggle="modal" data-target="#exampleModalCenter2">Ledger</button>&nbsp&nbsp&nbsp
                     <button type="button" class="tab entrybtn" data-toggle="modal" data-target="#exampleModalCenter1">Cash Received</button>
            </td></tr>
            <tr><td height="15px"></td></tr>
            <tr><td class="footer"><?php include '../footer/footer.php' ?></td></tr>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Customers Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
        <form action="creditors_db.php" method="post" autocomplete="off">
          <input type="text" name="customers_name" placeholder="Customers Name" required=""><br><br>
          <input type="text" name="customers_address" placeholder="Customers Address" required=""><br><br>
          <input type="number" name="customers_phone" placeholder="Phone"><br><br>
          <input type="text" name="customers_email" placeholder="Email"><br><br>
          <input type="text" name="customers_discription" style="height: 100px" placeholder="Discription">
        
      </div>
      <div class="modal-footer">
        <input type="submit" name="add_customers" class="tab entrybtn" value="Done"></form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Customers Ledger</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
       <form action="../ledger/index.php" method="post" autocomplete="off">
        <input type="text" name="customers_id" placeholder="Customers Id" id="dropdown1" list="select1" required=""><br><br>
       <input type="text" name="customers_detail" placeholder="Customers Detail" id="dropdown2" list="select2" required=""><br><br>
      </div>
      <div class="modal-footer"> 
       <input type="submit" class="tab entrybtn" name="customers_ledger" value="Done"></form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cash Received</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
       <form action="creditors_db.php" method="post" autocomplete="off">
         <input type="text" name="customers_id" id="dropdown1" list="select1" required="" placeholder="Customers Id"><br><br>
         <input type="text" name="customers_detail" id="dropdown2" list="select2" required="" placeholder="Customers Detail"><br><br>
         <input type="text" name="receipt_no" placeholder="Receipt No"><br><br>
         <input type="date" name="receipt_date" placeholder="Receipt Date"><br><br>
         <input type="number" name="amount_received" min="1" placeholder="Amount">
      </div>
      <div class="modal-footer"> 
        <input type="submit" name="submit" class="tab entrybtn" value="Done">

      <datalist id="select1">
 <?php
include ('../database/database_connection3.php');
 $sql = "SELECT customers_id FROM credit_sales";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll();?>
<?php foreach($users as $user): ?>
<option value="<?= $user['customers_id']; ?>"><?= $user['customers_id']; ?></option>
<?php endforeach; ?>
</datalist>

<datalist id="select2">
 <?php
 $sql = "SELECT customers_detail FROM credit_sales";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll();?>
<?php foreach($users as $user): ?>
<option value="<?= $user['customers_detail']; ?>"><?= $user['customers_detail']; ?></option>
<?php endforeach; ?>
</datalist>

</form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
