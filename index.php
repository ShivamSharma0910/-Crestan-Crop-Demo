<!DOCTYPE html>
<html>
<head>
	<title>Crestan Corp</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div style="margin: auto;width: 60%;">
	<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
	<form id="fupForm" name="form1" method="post">
		<div class="form-group">
			<label for="email">Name:</label>
			<input type="text" class="form-control" id="name" placeholder="Name" name="name">
		</div>
		<div class="form-group" >
			<label for="pwd">City:</label>
			<select name="city" id="city" class="form-control">
				<option value="">Select</option>
				<option value="Delhi">Delhi</option>
				<option value="Mumbai">Mumbai</option>
				<option value="Pune">Pune</option>
			</select>
		</div>
		<div class="form-group">
			<label for="pwd">Occupation:</label>
			<input type="text" class="form-control" id="occu" placeholder="Please Enter Occupation" name="occu">
		</div>
		<input type="button" name="save" class="btn btn-primary" value="Save to database" id="butsave">
	</form>
	
</div>
<div class="container">

<br>
  <h2>Employees Details</h2>
	<table class="table table-bordered table-sm" >
    <thead>
      <tr>
       <th>#</th>
        <th>Name</th>
        <th>City</th>
        <th>Occupation</th>
      </tr>
    </thead>
    <tbody id="table">
      
    </tbody>
  </table>
</div>

<script>
$(document).ready(function() {
	$('#butsave').on('click', function() {
		$("#butsave").attr("disabled", "disabled");
		var name = $('#name').val();
		var city = $('#city').val();
		var occu = $('#occu').val();
		if(name!="" && city!=""&& occu!="" ){
			$.ajax({
				url: "save.php",
				type: "POST",
				data: {
					name: name,
					city: city,
					occu: occu				
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$("#butsave").removeAttr("disabled");
						$('#fupForm').find('input:text').val('');
						$("#success").show();
						$('#success').html('Data added successfully !'); 



								$.ajax({
										url: "View_ajax.php",
										type: "POST",
										cache: false,
										success: function(data){
											//alert(data);
											$('#table').html(data); 
										}
									});

					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});


/*$.ajax({
		url: "View_ajax.php",
		type: "POST",
		cache: false,
		success: function(data){
			//alert(data);
			$('#table').html(data); 
		}
	});*/
</script>
</body>
</html>