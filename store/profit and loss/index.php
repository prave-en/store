<?php include ('../session/m_session.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/main.css">
	<title>profit and loss</title>
</head>
<style type="text/css">
	body{
		margin:0;
	}
  tr th{
  	position: sticky;
  	top: 0;
  	background-color: #484848;
  }
  tr tr:hover{
  	background-color: #767676;
  }
  .entrybtn{
    width: 40%;
  }
</style>
<body>

	<table border="0" width="100%" bgcolor="#696969">
            <tr><td class="header" colspan="2"><?php include('../header/header1.php'); ?></td></tr>
            <tr><td height="30" colspan="2" bgcolor="#484848" align="center"><b>PROFIT AND LOSS<b></td></tr>
                <tr><td colspan="2" height="20"></td></tr>
                <tr><td class="container" colspan="2">
                	<div class="overflow">
                	<table border="1" width="100%">
                		<tr><th>Date</th><th>Product Name</th><th>Quantity</th><th>Unit Profit</th><th>Total Profit</th></tr>

                			<?php
include ('../database/database_connection1.php');
$sql = "SELECT * FROM profit_loss";
$result = mysqli_query($con, $sql);
$sum = 0;
if (mysqli_num_rows($result) > 0) {
  
    while($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr align='center'>";
        echo "<td width=''>". $row["pl_date"]. "</td>";
        echo "<td width=''>". $row["product_name"]. "</td>";
        echo "<td width=''>". $row["quantity"]. "</td>";
        echo "<td width=''>". $row["unit_profit"]. "</td>";
        echo "<td width=''>". $row["total_profit"]. "</td>"."</tr>";
        $sum += $row['total_profit'];
        
    }
}
mysqli_close($con);
?>

                	</table></div>
                </td></tr>
                <tr><td height="30" align="right" colspan="2"><b>Total Profit</b>&nbsp = &nbsp
                		<b><?php echo $sum; ?></b> &nbsp&nbsp&nbsp
                	</td></tr>
                	<tr><td colspan="2" align="center" height="30">
                		 <button onclick="goBack()" class="entrybtn" >Back</button>
      <script>
function goBack() {
 location= "../admin";
}
</script>
                	</td></tr>
                  <tr><td colspan="2" height="15px"></td></tr>

</body>
</html>
