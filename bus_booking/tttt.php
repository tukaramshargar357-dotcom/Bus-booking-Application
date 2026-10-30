<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
  
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1>Hello, world!</h1>
				
				<form class="row g-3">	
				  <div class="col-md-4">
					<label for="txtOne" class="form-label">txtOne</label>
					<input id="txtOne" type="text" class="form-control" >
				  </div>
				  <div class="col-md-4">
					<button id="btnCopy" type="button" class="btn btn-primary">Copy</button>
				  </div>
				  <div class="col-md-4">
					<label for="txtTwo" class="form-label">txtTwo</label>
					<input type="text" class="form-control" id="txtTwo">
				  </div>				  
				  
				</form>
			</div>
		</div>
	</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
	
	<script>
		// 1. Select the element
		const btnCopy = document.querySelector('#btnCopy');
		const txtOne = document.querySelector('#txtOne');
		const txtTwo = document.querySelector('#txtTwo');

		// 2. Bind the click event listener
		btnCopy.addEventListener('click', function(event) {
			console.log('Button was clicked!');
			
			const txtOneVal = txtOne.value;
			let result = "";
			
			for (let i = 1; i <= 10; i++) {
			
			  console.log(i * txtOneVal); // Outputs: 0, 1, 2
			  result = result + (i * txtOneVal) + ", ";
			}
			 
			txtTwo.value = result;
			
		});
		
		txtOne.addEventListener('change', function(event) {
			console.log('Button was clicked!');
			
			const txtOneVal = txtOne.value;
			let result = "";
			
			for (let i = 1; i <= 10; i++) {
			
			  console.log(i * txtOneVal); // Outputs: 0, 1, 2
			  result = result + (i * txtOneVal) + ", ";
			}
			 
			txtTwo.value = result;		
		});
	</script>
  </body>
</html>