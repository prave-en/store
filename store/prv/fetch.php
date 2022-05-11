<?php 
include ('../database/database_connection1.php');
include("../database/database_connection.php");
include("../database/database_connection2.php");

$product_name = $_POST["product_name"];

$query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name'");
            $rows = mysqli_num_rows($query);
            if($rows == 1){ //matched start
      foreach($query as $row)
               {  
              $cost_price = $row['cost_price'];
              echo "$cost_price";
          }
      }
      else{
      	echo "not found";
      }