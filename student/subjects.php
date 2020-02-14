<?php
include_once 'headerstudent.php';
include_once '../classes/subjects.php';
include_once '../config/connection.php';

$database = new Database();
$db = $database->getConnection();


?>

<body">
	<?php include_once 'sidenav.php';?>
	<div class="container-fluid main-content float-left" style="background-color: white;">
	<p style="font-size: 28px; color: #383535; margin-top: 5px; float: left;">Subject List:</p>
  <div style="clear: both;"></div>
  <form method='POST'>
    <div class="form-row">
    <div class="form-group col-md-12 input-group">
      <input type='text' class='form-control' id='search' name='search' placeholder='Search here' required>
      <input class='btn text-dark' type='submit' value='Search' style="background-color: lightgray;">
    </div>
    </div>
	<ul class="nav nav-tabs" id="myTab" role="tablist" style="max-width: 100%">
  		<li class="nav-item">
    		<a class="nav-link active" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">Active</a>
  		</li>
        <?php if($_POST){
          echo '<a class="nav-link bg-secondary text-light" href="subjects.php">Reset</a>' ;
        }?>
      </li>
	</ul>
		<div class="tab-content" id="myTabContent">
  			<div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab"><?php include "viewsubjects_active.php" ?></div>
		</div>
	</div>
  </form>
</body>

<script type="text/javascript">
</script>

<?php
include_once '../footer.php';
?>