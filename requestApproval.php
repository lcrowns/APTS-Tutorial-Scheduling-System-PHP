<?php 
include "header.php";


?>
<form>
<div class="container">
<div class = "row mb-5">

</div>

<label>TUTORIALS:</label>
<div class ="row">
				<a type="submit" class="btn btn-secondary" href="#">Active</a>
				<a type="submit" class="btn btn-secondary" href="#">Inactive</a>
				<a type="submit" class="btn btn-secondary" href="#">Pending</a>
				
		</div>	

<div class="form row" >
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
		  <tr>
		      <th scope="col"></th>
		      <th scope="col"></th>
		      <th scope="col"></th>
		      <th scope="col"></th>
			  <th scope="col"></th>
			  <th scope="col"><button type="button" class="btn btn-link">Cancel</button> <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal">Mark As Complete</button></th>
		    </tr>
		  </tbody>
		  
  </div>
  
  
  
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mark Tutorials As Complete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p> Please Confirm Your Action</p>
		<p> Encountered Problems?</p>
		 <button type="button" class="btn btn-link">Report Tutee</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-danger">Cancel</button>
      </div>
    </div>
  </div>
</div>
  </div>
  </form>