<?php

//select.php


//database_connection.php

$connect = new PDO("mysql:host=localhost;dbname=mrp", "root", "");



$query = "SELECT * FROM store ORDER BY id DESC";

$statement = $connect->prepare($query);

if($statement->execute())
{
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }

 echo json_encode($data);
}

?>




