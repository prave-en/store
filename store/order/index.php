<?php include ('../session/m_session.php');
include ('../resources/model.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <title>Order</title>
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
            <tr><td height="30" colspan="2" align="center"><b><u>Orders</u><b></td></tr>
                <tr><td height="20" colspan="2"></td></tr>
                <tr><td class="container" colspan="2" align="center">
                  <div class="overflow">

                  <table border="1" class="tab" width="97%">
                    <tr align="center"><th>Order No.</th><th>Order Date</th><th>Customers Name</th><th>Product Count</th><th>ToTal Amount</th></tr>

                      <?php
 include ('../database/database_connection1.php');
 $sql = "SELECT * FROM orderr1";
$result = mysqli_query($con, $sql);
$sum = 0;
if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr align='center'>";
        echo "<td width=''>". $row["order_no"]. "</td>";
        echo "<td width=''>". $row["order_date"]. "</td>";
        echo "<td width=''>". $row["customers_detail"]. "</td>";
        echo "<td width=''>". $row["product_count"]. "</td>";
        echo "<td width=''>". $row["sum_amount"]. "</td>"."</tr>";
        
    }
}
mysqli_close($con);
?>

                  </table></div>
                </td></tr>
                  <tr><td colspan="2" align="center" height="30">
                    <a href="order.php" class="tab entrybtn">Take New Order</a>&nbsp&nbsp&nbsp
                    <button type="button" class="tab entrybtn" data-toggle="modal" data-target="#exampleModalCenter">View Order</button>&nbsp&nbsp&nbsp
                    <button type="button" disabled="" class="tab entrybtn" data-toggle="modal" data-target="#exampleModalCenter1">Delete Order</button>&nbsp&nbsp&nbsp
                    <a href="../admin" class="tab entrybtn">Back</a>
            </td></tr>
            <tr><td height="5px"></td></tr>
            <tr><td class="footer"><?php include '../footer/footer.php' ?></td></tr>


<!-- Button trigger modal -->



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">View Order Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body" align="center">
        <form action="view_order.php" method="post" autocomplete="off">
          <input type="number" name="order_no" placeholder="Order No." required=""><br><br>
          
      </div>

      <div class="modal-footer">
      <input type="submit" name="view_order" class="tab entrybtn" value="Done"></form>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
       <form action="view_order.php" method="post" autocomplete="off">
         <input type="number" name="order_no" required="" placeholder="Order No."><br><br>
      </div>
      <div class="modal-footer"> 
        <input type="submit" name="delete_order" class="tab entrybtn" value="Done"></form>
      </div>
       </div>
    </div>
  </div>
</div>
</form>

</body>
</html>
