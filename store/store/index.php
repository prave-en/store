<?php include ('../session/m_session.php');
include ('../resources/navbar.php');
include ('../resources/datatable.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <title>store</title>
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/ai.css">
</head>
<style type="text/css">

  .container{
      height: 421px;
    }
</style>
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
  <a href="../store" class="active">Store</a>
  <a href="../admin">Admin</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div></td></tr>

<tr><td height="3px"></td></tr>

<tr><td align="center">
  <input type="text" id="myInputTextField" placeholder="Search....." autocomplete="off" autofocus="">
</td></tr>
<tr><td height="3px"></td></tr>
<tr><td align="center" class="container">
    <div class="overflow">
   <table border="1" id="myTable" class="tab" width="97%">
  <thead>
    <tr align="center">
      <th>Product Id</th>
      <th>Product Name</th>
      <th>Unit</th>
      <th>Quantity</th>
      <th>Category</th>
      <th>Cost Price</th>
      <th>Selling Price</th>
      <th>Mrp</th>
      <th>Product Discription</th>
    </tr>
  </thead>
    <?php
 include ('../database/database_connection1.php');
$sql = "SELECT * FROM store";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {

      if ($row["store_quantity"]<10) {
        echo "<tr align='center'>";
        echo  "<td>".$row["product_id"]. "</td>";
        echo  "<td>".$row["product_name"]. "</td>";
        echo  "<td>".$row["unit"]. "</td>";
        echo  "<td>"."<font color='red'>".$row["store_quantity"]. "</td>";
        echo  "<td>".$row["category"]. "</td>";
        echo  "<td>".$row["cost_price"]. "</td>";
        echo  "<td>".$row["selling_price"]. "</td>";
        echo  "<td>".$row["mrp"]. "</td>";
        echo  "<td>".$row["product_discription"]. "</td>";
        }
    else
    {
        echo "<tr align='center'>";
        echo  "<td>".$row["product_id"]. "</td>";
        echo  "<td>".$row["product_name"]. "</td>";
        echo  "<td>".$row["unit"]. "</td>";
        echo  "<td>".$row["store_quantity"]. "</td>";
        echo  "<td>".$row["category"]. "</td>";
        echo  "<td>".$row["cost_price"]. "</td>";
        echo  "<td>".$row["selling_price"]. "</td>";
        echo  "<td>".$row["mrp"]. "</td>";
        echo  "<td>".$row["product_discription"]. "</td>";
        }
    }}
mysqli_close($con);
?>
</tbody></table><div></td></tr>

<tr><td class="footer"> <?php include ('../footer/footer.php'); ?> </td></tr>

<script type="text/javascript">
      $(document).ready( function () {
    $('#myTable').DataTable();
} );//main
    </script>

    <script type="text/javascript">
       $('#myTable').DataTable({
        paging: false
});//total data
    </script>

<script type="text/javascript">
oTable = $('#myTable').DataTable(); 
$('#myInputTextField').keyup(function(){
      oTable.search($(this).val()).draw() ;
})
</script>

</body>
</html>
