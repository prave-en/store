<?php
try{
  $con=new PDO("mysql:host=localhost;dbname=mrp",'root','');
  $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  }
       catch (PDOException $e)
     {
      echo"ERROR".$e->getMessage();
     }
?>

<html>  
    <head>  
        <title>pricing update</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
            <link rel="stylesheet" type="text/css" href="../css/main.css">
       
          
    </head>  
    <style>
        body{
            background-color: #a3a2a2;
            margin: 0;
        }
   .overflow{
     overflow:auto;
      width: 100%;
      height: 392px;
    }

    tr{
        text-align: center;
    }
    tr th{
        position: sticky;
        top: 0;
       height: 30px;
    }
    .button{
        border:1px solid black;
        border-radius: 3px;
        width: 20%;
        padding-top: 5px;
        padding-bottom: 5px;
        background-color: #2e2c2c;
        color: white;
        display: inline-block;
        text-decoration: none;
    }

    .button:hover{
        background-color: #484848;
     }

    input[type=text],input[type=number]{
        border-radius: 3px;
        border:1px solid black;
        padding-top: 2px;
        padding-bottom: 2px;
        text-align: center;
        outline: none;
    }
     input[type=text]:focus,input[type=number]:focus{
   background-color: #cccccc;
  }
    .header{
      text-align: center;
      margin-top: 10px;
    }
    .tab{
    box-shadow: 5px 5px 10px #2e2c2c;
  }

</style>
    <body>
      <div class="header"><?php include("../header/header1.php");?></div>
    <div align="center"><b>UPDATE PRICING DETAILS</b></div>
    <div style="height: 15px"></div> 
        <div class="overflow">
        <div class="container" align="center">  
    <form method="post" id="update_form">
                   
                        <table border="1" class="tab" width="97%">
                            <thead>
                                <th></th>
                                <th>Id</th>
                                <th>Product Id</th>
                                <th>Product Name</th>
                                <th>Unit</th>
                                <th>Cost Price</th>
                                <th>Selling Price</th>
                                <th>Mrp</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                    
    </body>  
</html> 
<script>  
$(document).ready(function(){  
    
    function fetch_data()
    {
        $.ajax({
            url:"pricing_update1.php",
            method:"POST",
            dataType:"json",
            success:function(data)
            {
                var html = '';
                for(var count = 0; count < data.length; count++)
                {
                    html += '<tr>';
                    html += '<td><input type="checkbox" id="'+data[count].id+'" data-id="'+data[count].id+'"data-product_id="'+data[count].product_id+'" data-product_name="'+data[count].product_name+'" data-unit="'+data[count].unit+'" data-cost_price="'+data[count].cost_price+'" data-selling_price="'+data[count].selling_price+'"data-mrp="'+data[count].mrp+'" class="check_box"  /></td>';
                    html += '<td>'+data[count].id+'</td>';
                    html += '<td>'+data[count].product_id+'</td>';
                    html += '<td>'+data[count].product_name+'</td>';
                    html += '<td>'+data[count].unit+'</td>';
                    html += '<td>'+data[count].cost_price+'</td>';
                    html += '<td>'+data[count].selling_price+'</td>';
                    html += '<td>'+data[count].mrp+'</td></tr>';
                }
                $('tbody').html(html);
            }
        });
    }

    fetch_data();

    $(document).on('click', '.check_box', function(){
        var html = '';
        if(this.checked)
        {
            html = '<td><input type="checkbox" id="'+$(this).attr('id')+'" data-id="'+$(this).data('id')+'" data-product_id="'+$(this).data('product_id')+'" data-product_name="'+$(this).data('product_name')+'" data-unit="'+$(this).data('unit')+'" data-cost_price="'+$(this).data('cost_price')+'" data-selling_price="'+$(this).data('selling_price')+'" data-mrp="'+$(this).data('mrp')+'" class="check_box" checked /></td>';
            html += '<td>'+$(this).data("id")+'</td>';
            html += '<td><input type="hidden" name="product_id[]" class="form-control" value="'+$(this).data("product_id")+'">'+$(this).data("product_id")+'</td>';
           html += '<td><input type="hidden" name="product_name[]" class="form-control" value="'+$(this).data("product_name")+'">'+$(this).data("product_name")+'</td>';
           html += '<td><input type="hidden" name="unit[]" class="form-control" value="'+$(this).data("unit")+'">'+$(this).data("unit")+'</td>';
            html += '<td><input type="text" name="cost_price[]" class="form-control" value="'+$(this).data("cost_price")+'" /></td>';
            html += '<td><input type="text" name="selling_price[]" class="form-control" value="'+$(this).data("selling_price")+'" /></td>';
            html += '<td><input type="text" name="mrp[]" class="form-control" value="'+$(this).data("mrp")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('id')+'" /></td>';
        }
        else
        {
            html = '<td><input type="checkbox" id="'+$(this).attr('id')+'" data-id="'+$(this).data('id')+'" data-product_id="'+$(this).data('product_id')+'" data-product_name="'+$(this).data('product_name')+'" data-unit="'+$(this).data('unit')+'" data-cost_price="'+$(this).data('cost_price')+'" data-selling_price="'+$(this).data('selling_price')+'" data-mrp="'+$(this).data('mrp')+'" class="check_box" /></td>';
            html += '<td>'+$(this).data('id')+'</td>';
            html += '<td>'+$(this).data('product_name')+'</td>';
            html += '<td>'+$(this).data('unit')+'</td>';
            html += '<td>'+$(this).data('cost_price')+'</td>';
            html += '<td>'+$(this).data('selling_price')+'</td>';            
        }
        $(this).closest('tr').html(html);
        $('#gender_'+$(this).attr('id')+'').val($(this).data('gender'));
         $('#product_name_'+$(this).attr('id')+'').val($(this).data('product_name'));
    });

    $('#update_form').on('submit', function(event){
        event.preventDefault();
        if($('.check_box:checked').length > 0)
        {
            $.ajax({
                url:"pricing_update2.php",
                method:"POST",
                data:$(this).serialize(),
                success:function()
                {
                    alert('Data Updated');
                    fetch_data();
                }
            })
        }
    });

});  


</script></div><br>

 <div align="center"> 


  <input type="submit" name="multiple_update" id="multiple_update" class="tab button" value="Update" />
                      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                      <a href="../admin" class="tab button">Back</a>

</div>
</form><br>

<div class="footer"><?php include '../footer/footer.php'; ?></div>

