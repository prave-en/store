<?php include ('../session/m_session.php');
include ('../resources/navbar.php');
include ('../resources/datatable.php');
//include ('../resources/model.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <title>sales</title>
  <link rel="stylesheet" type="text/css" href="../css/sales.css">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <style type="text/css">

   input[type=text],input[type=number],input[type=date]{
    height: 25px;
    width: 90%;
    border-radius: 5px;
    margin-top: 5px;
    margin-bottom: 5px;
    border:1px solid black;
  }
.container{
      height: 418px;
    }
  </style>
</head>
<body>
<table align="center" border="0" width="100%" bgcolor="#a3a2a2">

  <tr><td class="header"> <?php include('../header/header.php'); ?> </td></tr>

  <tr><td height="10px"></td></tr>

  <tr><td><div class="topnav" id="myTopnav">
  <a href="../index.php">Home</a>
  <a href="../entry">Purchase</a>
  <a href="../sales" class="active">Sales</a>
  <a href="../entry record">Purchase Record</a>
  <a href="../sales record">Sales Record</a>
  <a href="../store">Store</a>
  <a href="../admin">Admin</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div></td></tr>

<tr><td height="20px"></td></tr>
<tr><td align="center" class="container">
    <div class="overflow">
   
<form method="POST" action="confirm_sale.php" autocomplete="off">
  <table class="table tab table-bordered" id="crud_table" border="1" width="97%">
    <tr><td colspan="5"><input list="select1" type="text" name="customers_detail[]" placeholder="Customers Details" autofocus="" style="width: 20%" required="">&nbsp&nbsp&nbsp<input type="date" name="bill_date[]" style="width: 200px" required=""></td></tr>
    <tr align="center">
      <th>S no.</th>
      <th>Product Discription</th>
      <th>Unit</th>
      <th>Quantity</th>
      <th width="80px">Remove</th>
      </tr>
    
      <tr align="center"><td>1</td>
      <td><input list="select3" type="text" name="product_name[]" required></td>
      <td><input list="select2" type="text" name="unit[]" style="width: 150px" required=""></td>
      <td><input type="number" name="quantity[]" min="1" style="width: 150px" required></td>
      <td></td>
      </tr>
    </table>
    <br><p align="right"><button type="button" name="add" id="add" class="tab entrybtn" style="width: 55px">+</button>&nbsp&nbsp&nbsp&nbsp</p>

    </td></tr>
   
<tr><td colspan="4" align="right">Discount % &nbsp
  <input type="number" name="discount_percentage[]" value="0" min="0" style="width: 10%">&nbsp
  <input type="submit" name="done" value="Done" class="tab entrybtn">&nbsp&nbsp
</td></tr></form>


<script>
$(document).ready(function(){
 var count = 1;
 $('#add').click(function(){
  count = count + 1;
  var html_code = "<tr id='row"+count+"' align='center'>";
   html_code += "<td>" +count+ "</td>"
   html_code += "<td><input list='select3' type='text' name='product_name[]' required></td>";
   html_code += "<td><input list='select2' type='text' name='unit[]' style='width: 150px' required></td>";
   html_code += "<td><input type='number' name='quantity[]' min='1'  style='width: 150px' required></td>";
   html_code += "<td align='center'><button name='remove' data-row='row"+count+"' class='tab entrybtn remove'  style='width: 70%'>-</button></td>";   
   html_code += "</tr>";  
   $('#crud_table').append(html_code);
 });
 
 $(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
 });
});
</script>

<datalist id="select1">
 <?php
 include ('../database/database_connection3.php');
 $sql = "SELECT customers_detail FROM credit_sales";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll();?>
 <?php foreach($users as $user): ?>
 <option value="<?= $user['customers_detail']; ?>"><?= $user['customers_detail']; ?></option>
 <?php endforeach; ?>
 </datalist>

 <datalist id="select2">
 <?php
 $sql = "SELECT unit FROM store";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll();?>
 <?php foreach($users as $user): ?>
 <option value="<?= $user['unit']; ?>"><?= $user['unit']; ?></option>
 <?php endforeach; ?>
 </datalist>

 <datalist id="select3">
 <?php
 $sql = "SELECT product_name FROM store";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll();?>
 <?php foreach($users as $user): ?>
 <option value="<?= $user['product_name']; ?>"><?= $user['product_name']; ?></option>
 <?php endforeach; ?>
 </datalist>


<tr><td class="footer"> <?php include ('../footer/footer.php'); ?> </td></tr>

</body>
</html>
