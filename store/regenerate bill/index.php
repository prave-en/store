<?php //error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="mrp_css1.css">  
  <title>Regenerated bill</title>
</head>
<style>
    body{
        margin: 0;
    }
    .printbtn{
    background-color:#696969;
    width:200px;
    color: white;
    padding-top: 3px;
    padding-bottom: 3px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    border: 1px solid black;
    border-radius: 3px;
    font-size: 15px;
  }
  .printbtn:hover{
    background-color: #484848
  
</style>
<body>
  <div id="printMe">
<table align="center" border="0" width="1340" bgcolor="#ffffff">
    <tr><td colspan="3"><img src="logo.png"></td><td colspan="7"><b><h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMRP DEPARTMENTAL STORE<br><h4>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspBIRENDRANAGAR,SURKHET</h4></b></td><td width="300" align="center"></td></tr>
    <tr><td colspan="11" height="20"></td></tr>
    <tr bgcolor="#ffffff"><td colspan="11" align="center" height="30"><b>PURCHASE BILL</td></tr>
      <tr><td colspan="11" height="20">

<?php
        
if(isset($_POST['regenerate_bill']))
{
        
    try {
        $pdoConnect = new PDO("mysql:host=localhost;dbname=mrp","root","");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    
   
    $bill_no = $_POST['bill_no'];
    
   
    $pdoQuery = "SELECT * FROM sales WHERE bill_no = :bill_no";
    
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    
    
    $pdoExec = $pdoResult->execute(array(":bill_no"=>$bill_no));
    
    if($pdoExec)
    {
          if($pdoResult->rowCount()>0)
        {     
             foreach($pdoResult as $row)
            {
                 $sales_date = $row['bill_date'];
                 $customers_name = $row['customers_detail'];
                $discount_percentage = $row['discount_percentage'];
                ?>

<b> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCustomers Name:</b>&nbsp&nbsp&nbsp<?php echo  "$customers_name"; ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b> Date:</b> &nbsp&nbsp&nbsp<?php echo "$sales_date";?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b> Re-generated Date </b> &nbsp&nbsp&nbsp <?php
date_default_timezone_set('Asia/Kathmandu');
echo date('l,jS F o   g:i:s a');
?>
               
               <?php break;
                }//foreach
              }//if
            
            }//if
          }
          ?>
        </td></tr>
        <tr><td colspan="11">
          <table align="center" border="1" width="1200">
            <tr align="center"><td>PRODUCT NAME</td>
              <td>COMPANY NAME</td>
              <td>QUANTITY</td>
              <td>UNIT PRICE</td>
              <td>TOTAL PRICE</td></tr>


<?php
        
if(isset($_POST['regenerate_bill']))
{
        
    try {
        $pdoConnect = new PDO("mysql:host=localhost;dbname=mrp","root","");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
    
   
    $bill_no = $_POST['bill_no'];
    $sum = 0;
    
   
    $pdoQuery = "SELECT * FROM sales WHERE bill_no = :bill_no";
    
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    
    
    $pdoExec = $pdoResult->execute(array(":bill_no"=>$bill_no));
    $sum = 0;
    if($pdoExec)
    {

          if($pdoResult->rowCount()>0)
        {     
             foreach($pdoResult as $row)
            {    
                 $product_name = $row['product_name'];
                 //$company_name = $row['company_name'];
                $quantity = $row['quantity'];
                $mrp = $row['mrp'];
                $total_price = $row['total_amount'];
                $sum += $row['total_price'];
                echo "<tr align='center'><td>";
                echo "$product_name";echo "</td><td>";
                echo "$company_name";echo "</td><td>";
                echo "$quantity";echo "</td><td>";
                echo "$selling_price";echo "</td><td>";
                echo "$total_price";echo "</td><tr>";
                $a=$sum/100*$discount_percentage;
                $b=$sum-$a;

                
              }

              }
                else
              {
                echo "<tr><td colspan='5' align='center' height='100'><font color='red'>There is no data in such date...please check and re-enter the bill no.</font> </td></tr>";
              }
            }
          }
          ?>

          <tr align="center"><td colspan="4"><b></td><td><b><?php echo $sum; ?></td></tr>
            <tr align="center"><td colspan="4"><b>Discount Percentage &nbsp (Discount Amount)</td><td><b><?php echo "$discount_percentage";echo "%";?> (<?php echo "$a"; ?>)</td></tr>
              <tr align="center"><td colspan="4"><b>GRAND TOTAL</b></td><td><b><?php echo "$b"; ?></td></tr>

          </table></td></tr></table></div>
          <table width="100%">
            <tr><td height="20"></td></tr>
            <tr><td height="30" align="right"><button onclick="printDiv('printMe')" class="printbtn">Print</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td></tr>
          <tr><td colspan="11" height="20"></td></tr>
 <tr><td align="center" colspan="11" bgcolor="#ffffff"><h5>copyright &copy2017 Mid-Western University Surkhet,Nepal</h5></td></tr>
</table>
<script>
    function printDiv(divName){
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
  </script>
            </td> </tr>

        