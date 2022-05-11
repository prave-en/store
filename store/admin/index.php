<?php include ('../session/m_session.php');
include ('../resources/navbar.php');
include ('../resources/model.php');?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="css/admin.css">
  <style>
.entrybtn{
  background-color: #2e2c2c;
  width: 20%;
  display: inline-block;
  margin-top: 5px;
  margin-bottom: 5px;
}
.entrybtn:hover{
  text-decoration: none;
  color: white;
}
input[type=text],input[type=number]{
  margin-top: 5px;
  margin-bottom: 5px;
  height: 30px;
  border:none;
  border-bottom: 2px solid green;
}
input[type=text]:focus,input[type=number]:focus{
  background-color: white;
  }
  .container{
      height: 462px;
    }
  .tab{
    box-shadow: 5px 5px 10px #2e2c2c;
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
  <a href="../sales">Sales</a>
  <a href="../entry record">Purchase Record</a>
  <a href="../sales record">Sales Record</a>
  <a href="../store">Store</a>
  <a href="../admin" class="active">Admin</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div></td></tr>

<tr><td height="10px"></td></tr>
<tr><td align="center" class="container">
   
      <button type="button" class="tab entrybtn" data-toggle="modal" data-target="#exampleModalCenter">ADD NEW PRODUCT</button><br>
      <a href="../pricing_update1/pricing_update.php" class="tab entrybtn">PRICE UPDATE</a><br>
      <a href="../creditors" class="tab entrybtn">CUSTOMERS</a><br>
      <a href="../suppliers" class="tab entrybtn">SUPPLIERS</a><br>
      <a href="#" class="tab entrybtn">PROFIT AND LOSS</a><br>
      <button type="button" class="tab entrybtn" data-toggle="modal" data-target="">REGENERATE BILL</button><br>
      <a href="../order" class="tab entrybtn">ORDER DETAILS</a><br>
</td></tr>

<tr><td class="footer"> <?php include ('../footer/footer.php'); ?> </td></tr>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
        <form action="../new product/new_product.php" method="post" autocomplete="off">
          <input type="text" name="product_name" placeholder="Product Name*" required="">
          <input type="text" name="unit" placeholder="Unit*" required="">
          <input type="text" name="category" placeholder="Category">
          <input type="number" name="cost_price" placeholder="Cost Price*" min="1" required="">
          <input type="number" name="selling_price" min="1" placeholder="Selling Price">
          <input type="number" name="mrp" placeholder="Mrp*" min="1" required="">
          <input type="text" name="product_discription" style="height: 60px" placeholder="Product Discription">
        
      </div>
      <div class="modal-footer">
        <input type="submit" name="add_product" class="tab entrybtn" value="Done"></form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Regenerate Bill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
        <form action="../regenerate bill/index.php" method="post" autocomplete="off">
         <input type="number" name="bill_no" placeholder="Bill No.">
        
      </div>
      <div class="modal-footer">
        <input type="submit" name="regenrate_bill" class="tab entrybtn" value="Done"></form>
      </div>
    </div>
  </div>
</div>
