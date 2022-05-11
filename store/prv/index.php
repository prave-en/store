<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>
   <input type="text" name='product_name' id="partner"><br>
    <hr>
    a<span id="result"></span><br>
    b<span id="result"></span>
</body>
</html>
<script>
$(document).ready(function(){
    $('#partner').keyup(function(){
        var name=$("#partner").val();
        // alert(name)
$.ajax({
			url:"fetch.php",
			method:"post",
			data:{product_name:name},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
        });
});
</script>
