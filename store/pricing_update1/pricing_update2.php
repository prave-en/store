<?php

//multiple_update.php

//database_connection.php

$connect = new PDO("mysql:host=localhost;dbname=mrp", "root", "");

if(isset($_POST['hidden_id']))
{
 $product_id = $_POST['product_id'];
 $product_name = $_POST['product_name'];
 $unit = $_POST['unit'];
 $cost_price = $_POST['cost_price'];
 $selling_price = $_POST['selling_price'];
 $mrp = $_POST['mrp'];
 $id = $_POST['hidden_id'];
 for($count = 0; $count < count($id); $count++)
 {
  $data = array(
   ':product_id'   => $product_id[$count],
   ':product_name'   => $product_name[$count],
   ':unit'   => $unit[$count],
   ':cost_price' => $cost_price[$count],
   ':selling_price'   => $selling_price[$count],
   ':mrp'   => $mrp[$count],
   ':id'   => $id[$count]
  );
  $query = "
  UPDATE store 
  SET product_id = :product_id,product_name = :product_name,unit = :unit,cost_price = :cost_price, selling_price = :selling_price,mrp = :mrp 
  WHERE id = :id
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
 }
}

?>