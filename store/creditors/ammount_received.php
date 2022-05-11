<!DOCTYPE html>
<html>
<head>
	<title>cash received</title>
</head>
<style type="text/css">
	body{
		margin: 0;
	}
	table{
		
		
	}
	input[type=text]{
		width: 300px;
		text-align: center;
		border:none;
		border-bottom: 2px solid black;
		border-radius: 5px;
		height: 20px;
	}
	input[type=number]{
		width: 300px;
		text-align: center;
		border:none;
		border-bottom: 2px solid black;
		border-radius: 5px;
		height: 20px;
	}
	.submit{
		background-color: grey ;
		display: inline-block;
		text-decoration: none;
		border-radius: 5px;
		border:none;
		border-bottom: 2px solid black;
		height: 25px;
		width: 300px;
	}
	.submit:hover{
		background-color: #484848;
	}
	.header{
		margin-top: 70px;
		text-align: center;
	}

	.container{
		position: absolute;
		top: 40%;
		left: 40%;
	}
</style>
<body>
		<div class="header"><img src="cash.jpg"></div>
		<div class="container">
			<form action="ammout_received_db.php" method="post" autocomplete="off">
				<input type="text" name="customers_name" placeholder="Customers Name" id="dropdown1" list="select1" required=""><br><br>
				<input type="text" name="customers_address" placeholder="Customers Address" id="dropdown2" list="select2" required=""><br><br>
				<input type="text" name="ammount_received" placeholder="Amount Received" required=""><br><br>
				<input type="submit" class="submit" name="submit" value="Submit">

 <datalist id="select1">
 <?php
include ('../database/database_connection3.php');
 $sql = "SELECT customers_name FROM credit_sales";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll();?>
<?php foreach($users as $user): ?>
<option value="<?= $user['customers_name']; ?>"><?= $user['customers_name']; ?></option>
<?php endforeach; ?>
</datalist>

<datalist id="select2">
 <?php
 $sql = "SELECT customers_address FROM credit_sales";
 $stmt = $pdo->prepare($sql);
 $stmt->execute();
 $users = $stmt->fetchAll();?>
<?php foreach($users as $user): ?>
<option value="<?= $user['customers_address']; ?>"><?= $user['customers_address']; ?></option>
<?php endforeach; ?>
</datalist>
			</form>
		</div>

</body>
</html>





