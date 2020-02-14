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
  <p style="font-size: 28px; color: #383535; margin-top: 5px; float: left;">Tutorial List:</p>
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
        <a class="nav-link" id="inactive-tab" data-toggle="tab" href="#inactive" role="tab" aria-controls="inactive" aria-selected="false">Declined</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="cancelled-tab" data-toggle="tab" href="#cancelled" role="tab" aria-controls="cancelled" aria-selected="false">Cancelled</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
      </li>
      <li class="nav-item">
        <?php if($_POST){
          echo '<a class="nav-link bg-secondary text-light" href="homeadmin.php">Reset</a>' ;
        }?>
      </li>
  </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab"><?php include "viewtutorial_all.php" ?></div>
        <div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="active-tab"><?php include "viewtutorial_active.php" ?></div>
        <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab"><?php include "viewtutorial_inactive.php" ?></div>
        <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab"><?php include "viewtutorial_pending.php" ?></div>
        <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab"><?php include "viewtutorial_cancelled.php" ?></div>
        <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab"><?php include "viewtutorial_completed.php" ?></div>
    </div>
  </form>
</div>

</body>

<script type="text/javascript">


</script>

<?php
include_once '../footer.php';
?>