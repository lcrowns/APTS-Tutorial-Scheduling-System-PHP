<?php
include_once 'headeradmin.php';
include_once '../classes/tutorial.php';
include_once '../classes/subjects.php';
include_once '../classes/topic.php';
include_once '../config/connection.php';

$tlistId= isset ($_GET ['tlistId']) ? $_GET['tlistId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$tutorial = new Tutorial($db);
$tutorial->tlistId = $tlistId;
$tutorial->readOneTutorial();



$date =date("M/d/Y");

?>

<body >

  <div class="container">
    <h1 style="margin-bottom: 0;">Tutorial Details</h1>
    <a class="text-danger" href="homeadmin.php">[Back]</a>
    <br>
    <div class="card border-secondary mb-5" style="max-width: 90rem; margin-top: 10px;">
      <form method="POST" action="viewonetutorial.php?tlistId=<?php echo $tutorial->tlistId;?>">
        <div class="card-body text-dark">

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="inputPassword4">Tutor</font></label>
              <input type="text" class="form-control" id="tutor" placeholder="Description of the Subject" name="tutor" value = " <?php echo $tutorial->tutor ?>"readonly="readonly">
            </div>
          
            <div class="form-group col-md-6">
              <label for="inputPassword4">Tutee</font></label>
              <input type="text" class="form-control" id="tutee" placeholder="Description of the Subject" name="tutee" value = "<?php echo $tutorial->tutee;?>"readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputPassword4">Topic</font></label>
              <input type="text" class="form-control" id="editedby" placeholder="Description of the Subject" name="editedby" value="<?php echo $tutorial->topic ?>"readonly>
            </div>

            <div class="form-group col-md-4">
              <label for="inputPassword4">Date</font></label>
              <input type="text" class="form-control" id="editdate" name="editdate" value="<?php echo $tutorial->date ?>"readonly>
            </div>
            <div class="form-group col-md-4">
              <label for="inputPassword4">Time</font></label>
              <input type="text" class="form-control" id="editdate" name="editdate" value="<?php echo $tutorial->time ?>"readonly>
            </div>
          </div>

           <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputPassword4">Status</font></label>
              <input type="text" class="form-control" id="editedby" placeholder="Description of the Subject" name="editedby" value="<?php echo $tutorial->tListStatus ?>"readonly>
            </div>
            <?php 
            if($tutorial->tListStatus == 'Cancelled'){
            echo '
            <div class="form-group col-md-8">
              <label for="inputPassword4">Cancelled By</font></label>
              <input type="text" class="form-control" id="editdate" name="editdate" value="'; echo $tutorial->cancelBy; echo '"readonly>
            </div>';
            }
             ?>
          </div>

          <?php 
          if($tutorial->tListStatus == 'Cancelled'){
          echo '
          <div class="form-row">
            <div class="form-group col-md-4"></div>
            <div class="form-group col-md-8">
              <label for="inputPassword4">Cancel Reason</font></label>
              <textarea type="text" class="form-control" id="editdate" name="editdate" value=" "readonly>'; echo $tutorial->cancelReason;  echo '</textarea>
            </div>
          </div>';
          }
          ?>
          
          
        </div>

      </div>
    </form>
  </div>
</div>
</div>


<?php if($tutorial->tListStatus == 'Completed'){
echo '
<div class="container">
  <h4>Student Comments</h4>
  <div class="card border-secondary mb-5" style="max-width: 90rem; margin-top: 10px;">
    <div class="card-body text-dark">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputPassword4">Tutee Rating</label>
          <input type="text" class="form-control" id="editdate" name="editdate" value="'; echo $tutorial->tuteeRate; echo '"readonly>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
           <label for="inputPassword4">Tutee Feedback</label>
            <textarea type="text" class="form-control" id="editedby" placeholder="" name="editedby" value="echo $tutorial->getTopic($tutorial->tuteeFeed) ?>"readonly>'; echo htmlspecialchars($tutorial->tuteeFeed); echo '</textarea>
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Tutor Feedback</label>
          <textarea type="text" class="form-control" id="editdate" name="editdate" value="<?php echo $tutorial->tutorFeed ?>"readonly>';echo htmlspecialchars($tutorial->tutorFeed); echo '</textarea>
        </div>
      </div>
    </div>
  </div>
</div>
';
}?>


</body>

<script type="text/javascript">
  
</script>

<?php
include_once '../footer.php';
?>