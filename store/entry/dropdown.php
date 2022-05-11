<?php

$db = mysqli_connect("localhost","root","","mrp");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>PHP Retrieve Data from MySQL using Drop Down Menu</title>
</head>
<style type="text/css">
	.formcss{
		width: 500px;
	}
</style>
<body>

<form style="width: 500px">
 <div class="formcss">
  <select>
    <option>product name</option>
    <?php
       
        $records = mysqli_query($db, "SELECT product_name From store");  // Use select query here 

        while($data = mysqli_fetch_array($records))
        {
            echo "<option value='". $data['product_name'] ."'>" .$data['product_name'] ."</option>";  // displaying data in option menu
        }	
    ?>  
  </select>
  </div>
</form>

<?php mysqli_close($db);  // close connection ?>

</body>
</html>
