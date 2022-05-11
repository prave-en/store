<?php
include('../database/database_connection.php');


if (isset($_POST["add_product"]))
  {
    $product_name = $_POST["product_name"];
    $unit = $_POST["unit"];
    //$store_quantity = $_POST["store_quantity"];
    $category = $_POST["category"];
    $cost_price = $_POST["cost_price"];
    $selling_price = $_POST["selling_price"];
    $mrp = $_POST["mrp"];
    $product_discription = $_POST["product_discription"];
    $product_id = "pro".rand(0,999);
    //$store_quantity = "0";

    include ('../database/database_connection2.php');
             $query = mysqli_query($conn, "SELECT * FROM store WHERE product_name='$product_name' AND unit='$unit'");
             $rows = mysqli_num_rows($query);

            if($rows == 1){ //matched start
              ?>
   <script >
   alert("Product Already Exist");
  location= "../admin";
  </script>
<?php } 
else
{ //not matched start

  $pdo_add = $con->prepare("INSERT INTO store (product_id,product_name,unit,category,cost_price,selling_price,mrp,product_discription) VALUES (:product_id,:product_name,:unit,:category,:cost_price,:selling_price,:mrp,:product_discription)");

$pdo_add->bindparam(':product_id',$product_id);
$pdo_add->bindparam(':product_name',$product_name);
$pdo_add->bindparam(':unit',$unit);
$pdo_add->bindparam(':category',$category);
$pdo_add->bindparam(':cost_price',$cost_price);
$pdo_add->bindparam(':selling_price',$selling_price);
$pdo_add->bindparam(':mrp',$mrp);
$pdo_add->bindparam(':product_discription',$product_discription);
$pdo_add->execute();

?>
<script >
    alert("Product Added");
  location= "../admin";
  </script>
  <?php
} } ?>
