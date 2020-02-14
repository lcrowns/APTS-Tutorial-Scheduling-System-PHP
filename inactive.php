<?php 

include 'header.php';
?>

<div class="container">
<div class = "row mb-5">
</div>
<div class ="row mb-2">
<label>Tutors:</label>
			<div class = "col-lg-6">
			<div class = "row">
				<div class = "col-lg-10">
					<input type="text" class="form-control">
				</div>
				<div class ="col-lg-2">
					<button type="submit" class="btn btn-secondary">Search</button>
				</div>
			</div>
			</div>
			
		</div>
		<div class ="row">
				<a type="submit" class="btn btn-secondary" href="viewTutors.php">Active</a>
				<a type="submit" class="btn btn-secondary" href="inactive.php">Inactive</a>
				<a type="submit" class="btn btn-secondary" href="pending.php">Pending</a>
				
		</div>	
 <div class="row mb-3" >
    <table class="table table-secondary">
		  <thead>
		    <tr>
		      <th scope="col">ID No</th>
		      <th scope="col">Name</th>
		      <th scope="col">Course</th>
		      <th scope="col">Year Level</th>
			  <th scope="col">Status</th>
			  <th scope="col">View</th>
		    </tr>
		  </thead>
		  <tbody>
  </div>
</div>