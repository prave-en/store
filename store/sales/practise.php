<?php 
if (isset($_POST["confirm"]))
  {
  	for ($a = 0; $a < count($_POST["product_name"]); $a++){
  	$customers_detail[$a] = $_POST["customers_detail"][0];
  	$bill_date[$a] = $_POST["bill_date"][0];
  	$discount_percentage[$a] = $_POST["discount_percentage"][0];
  	$product_name[$a] = $_POST["product_name"][$a];
  	$unit[$a] = $_POST["unit"][$a];
  	$quantity[$a] = $_POST["quantity"][$a];
  	$rate[$a] = $_POST["rate"][$a];
  	$remark = $_POST["remark"];
  	
  	echo "$customers_detail[$a]";
  	echo "$bill_date[$a]";
  	echo "$discount_percentage[$a]";
  	echo "$product_name[$a]";
  	echo "$unit[$a]";
  	echo "$quantity[$a]";
  	echo "$rate[$a]";
  	echo "$remark";
  	echo "<br>";
  }
  }

   ?>