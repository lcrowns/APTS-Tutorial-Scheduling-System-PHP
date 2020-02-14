<?php
include_once 'header.php';


 ?>
 
<form class="form-group">




<!-- Button trigger modal -->
<button type="button" class="btn btn-link" data-toggle="modal" data-target="#tutorModal">View Profile</button>


<!-- Modal -->
<div class="modal fade" id="tutorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
	  
	  <form class="form-group">
	 
	
	  <form class ="form-row">
	  <label>Name:</label><br>	
	  <label>Course:</label><br>
	  <label>Date Applied:</label><br>
	  <label>Status:</label>
	  </form><br><br>
		<form class ="form-row">
		 <div class="form-group col-md-6">
		<label>Subject Experties</label>
		</div>
		<div class="form-group col-md-6">
		<label>Hours Vacant</label>
		</div>
		</form>
	
	  </form>
	   
	  
        
      </div>
      <div class="modal-footer">
	  <form class="form-group">
        <form class="form-row">
		<button type="button" class="btn btn-danger">Accept</button>
		<button type="button" class="btn btn-danger">Deny</button><br>
		</form>
		
		<form class="form-row"> 
		<div class="form-group col-md-12">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button><br>
		</div>
		</form>
		</form>
      </div>
    </div>
  </div>
</div>
</form> 
 
 <?php
include_once 'footer.php';
 ?>
 
 
 