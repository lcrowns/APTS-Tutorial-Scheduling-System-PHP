<?php
include_once 'headeradmin.php';
include_once '../classes/subjects.php';
include_once '../config/connection.php';

$database = new Database();
$db = $database->getConnection();


?>

<body>
	<?php include_once 'sidenav.php'; ?>
	<div class="container-fluid main-content float-left" style="background-color: white;">
	<p style="font-size: 28px; color: #383535; margin-top: 5px; float: left;">Subject List:</p>
  <a class='btn btn-danger text-light float-right' style="margin-top: 8px;" data-toggle='modal' data-target='#addsubjectmodal' >Add Subject</a>
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
        <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
      </li>
  		<li class="nav-item">
    		<a class="nav-link" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">Active</a>
  		</li>
  		<li class="nav-item">
    		<a class="nav-link" id="incative-tab" data-toggle="tab" href="#inactive" role="tab" aria-controls="inactive" aria-selected="false">Inactive</a>
      <li class="nav-item">
        <?php if(isset($_POST['search'])){
          echo '<a class="nav-link bg-secondary text-light" href="subjects.php">Reset</a>' ;
        }?>
      </li>
	</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab"><?php include "viewsubjects_all.php" ?></div>
  			<div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="active-tab"><?php include "viewsubjects_active.php" ?></div>
  			<div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab"><?php include "viewsubjects_inactive.php" ?></div>
		</div>
	
  </form>
  </div>


<div id='subjecttbl'>
                  <div class="modal fade" id="addsubjectmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <div class="modal-header">
            <h5 class="modal-title">Add Subject</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>

          <form method="POST" id="addstudentform" action="subjects.php">
            <div class="modal-body">
              <table class='table table-hover table-bordered'>
                <tr>
                  <th>Subject Name</th>
                  <td><input type="text" class="form-control" name="subjname" required></td>
                </tr>
                <tr>
                  <th>Subject Desciption</th>
                  <td><input type="text" class="form-control" name="subjdesc" required></td>
                </tr>
              </table>
            </div>
            <?php
              if(isset($_POST['add'])){
                $account = new Account($db);

                $subjname = $_POST['subjname'];
                $subjdesc = $_POST['subjdesc'];

                echo '<script>window.location="addsubjs.php?userId='; echo $userId;
                echo '&subjname='; echo $subjname;
                echo '&subjdesc='; echo $subjdesc;
                echo '"</script>';
              }
            ?>
            
            <div class="modal-footer">
              <input type='submit' class='btn btn-danger' name='add' id='add' value='Add'>
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
            </div>



          </form>
        </div>
      </div>
    </div>  

</div>
</body>

<script type="text/javascript">
</script>

<?php
include_once '../footer.php';
?>