<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html>
<head>
    <title>example</title>
</head>
<body>
<form action="password.php" method="POST">
    <input type="text" name="name" placeholder="name">
    <input type="text" name="email" placeholder="class">
     <input type="submit" name="hover" value="hover">
   
</form>


<?php
        if (isset($_POST["hover"]))
  {
  ?>

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
       
        <?php
        $name = $_POST["name"];
        $email = $_POST["email"];
        echo $name;
        echo $email;
        ?>
      </div>
      <div class="modal-footer">
       <button type="button" class="entrybtn" data-toggle="modal" data-target="#exampleModalCenter2">Add Customers</button></form>


       <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
          <input type="text" name="customers_name" placeholder="Customers Name"><br><br>
          <input type="text" name="customers_address" placeholder="Customers Address"><br><br>
          <input type="number" name="customers_phone" placeholder="Phone"><br><br>
          <input type="text" name="customers_email" placeholder="Email"><br><br>
          <input type="text" name="customers_discription" style="height: 100px" placeholder="Discription">
        
      </div>
      <div class="modal-footer">
        <input type="submit" name="add_customers" class="entrybtn" value="Done"></form>
      </div>
    </div>
  </div>
</div>


      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(function () {  
    $("#exampleModalCenter").modal("show");

    });
</script>
<?php  } ?>
</body>
</html>