<?php include ('../session/m_session.php');
include ('../resources/navbar.php');
include ('../resources/datatable.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <title>sales record</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   

  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/sr.css">
  
<style type="text/css">
    .container{
      height: 425px;
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
  <a href="../sales record" class="active">Sales Record</a>
  <a href="../store">Store</a>
  <a href="../admin">Admin</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div></td></tr>

<tr><td height="3"></td></tr>
  <tr><td align="center"><input type="text" autofocus="" id="myInputTextField" placeholder="Search....." autocomplete="off"></td></tr>
  <tr><td height="3"></td></tr>
<tr><td align="center" class="container">
    <div class="overflow">
    
<table border="1" id="myTable" class="tab" width="97%">
  <thead>
    <tr align="center">
      <th>Id</th>
      <th>Entry Date</th>
      <th>Bill no.</th>
      <th>Bill Date</th>
      <th>Customers Detail</th>
      <th>Product Id</th>
      <th>Product Discription</th>
      <th>Quantity</th>
      <th>Unit</th>
      <th>Rate</th>
      <th>Discount %</th>
      <th>After Dis.</th>
      <th>Total Price</th>
      <th>Remarks</th>
    </tr>
  </thead>
    <?php
  include ('../database/database_connection1.php');

$sql = "SELECT * FROM sales  ORDER BY sales_id DESC";
$result = mysqli_query($con, $sql);


if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr align='center'>";
        
        echo "<td width=''>". $row["sales_id"]. "</td>";
        echo "<td width=''>". $row["sales_date"]. "</td>";
        echo "<td width=''>". $row["bill_no"]. "</td>";
        echo "<td width=''>". $row["bill_date"]. "</td>";
        echo "<td width=''>". $row["customers_detail"]. "</td>";
        echo "<td width=''>". $row["product_id"]. "</td>";
        echo "<td width=''>". $row["product_name"]. "</td>";
        echo "<td width=''>". $row["quantity"]. "</td>";
        echo "<td width=''>". $row["unit"]. "</td>";
        echo "<td width=''>". $row["mrp"]. "</td>";
        echo "<td width=''>". $row["discount_percentage"]. "</td>";
        echo "<td width=''>". $row["after_discount"]. "</td>";
        echo "<td width=''>". $row["total_amount"]."</td>";
        echo "<td width=''>". $row["remarks"]."</td>"."</tr>";


        
    }
}
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

<script type="text/javascript">
  var table = $('#myTable').DataTable();
 
// Sort by column 1 and then re-draw
table
    .order( [ 0, 'desc' ] )
    .draw();
</script>

</body>
</html>
