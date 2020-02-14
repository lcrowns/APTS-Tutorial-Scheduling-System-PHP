<?php
include_once 'headeradmin.php';
include_once '../classes/account.php';
include_once '../config/connection.php';

$database = new Database();
$db = $database->getConnection();


?>

<body>
	<?php include_once 'sidenav.php'; ?>
	<div class="container-fluid main-content float-left" style="background-color: white;">
	<p style="font-size: 28px; color: #383535; margin-top: 5px; float: left;">Tutor List:</p>
  <a class='btn btn-danger text-light float-right' style="margin-top: 8px;" href="addtutor.php" >Add Tutor</a>
  <div style="clear: both;"></div>
  <form method='POST' action='tutors.php'>
    <div class="form-row">
    <div class="form-group col-md-12 input-group">
      <input type='text' class='form-control' id='search1' name='search1' placeholder='Search here' required>
      <input class='btn text-dark' type='submit' value='Search' style="background-color: lightgray;">
    </div>
    </div>
	<ul class="nav nav-tabs" id="myTab" role="tablist" style="max-width: 100%">
      <li class="nav-item">
        <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
      </li>
  		<li class="nav-item">
    		<a class="nav-link" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="false">Active</a>
        <?php $selected='all'?>
  		</li>
  		<li class="nav-item">
    		<a class="nav-link" id="incative-tab" data-toggle="tab" href="#inactive" role="tab" aria-controls="inactive" aria-selected="false">Inactive</a>
  		</li>
      <li class="nav-item">
        <?php if($_POST){
          echo '<a class="nav-link bg-secondary text-light" href="tutors.php">Reset</a>' ;
        }?>
      </li>
	</ul>
		<div class="tab-content text-center" id="myTabContent" style="max-width: 100%;">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab"><?php include "viewtutors_all.php" ?></div>
  			<div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="active-tab"><?php include "viewtutors_active.php" ?></div>
  			<div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab"><?php include "viewtutors_inactive.php" ?></div>
		</div>
	</div>
  </form>
</body>

<script type="text/javascript">


</script>

<?php
include_once '../footer.php';
?>