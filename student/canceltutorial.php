<?php
include_once 'headerstudent.php';
include_once '../classes/tutorial.php';
include_once '../classes/subjects.php';
include_once '../classes/topic.php';
include_once '../config/connection.php';

$tlistId= isset ($_GET ['tlistId']) ? $_GET['tlistId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->userId = $_SESSION['userId'];
$account->readOneAccount();

$tutorial = new Tutorial($db);
$tutorial->tlistId = $tlistId;
$tutorial->readOneTutorial();

if(isset($_POST['save'])) {
  $tutorial->readOneTutorial();
    if ($_POST['radio']=='others'){
    	$tutorial->cancelReason=  $_POST['cancelReason'];

    }else{
    	$tutorial->cancelReason = $_POST['radio'];
    }

    if($tutorial->tutor==$account->fname." ".$account->lname){
        $tutorial->cancelBy = $tutorial->tutor;
    }else{
      	$tutorial->cancelBy = $tutorial->tutee;
    }
    
    $tutorial->tListStatus = 'Cancelled';
    

    if ($tutorial->updateTutorial2()){
      echo "<script type='text/javascript'>alert('Tutorial Successfully Updated!'); location='viewonetutorial.php?tlistId={$tlistId}';</script>";
    }
    else{
      echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'>
          <strong><p class='text-center'>Please Try Again!</p></strong>
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>

      ";
      }
  }

?>

<body >

  <div class="container">
    <h1 style="margin-bottom: 0;">Cancel Tutorial</h1>
    <a class="text-danger" href="viewonetutorial.php?tlistId=<?php echo $tlistId?>;?>">[Back]</a>
    <div class="text-right" style="margin: 0px; padding: 0px; ">
    </div>
    <div style="clear: both;"></div>
    <div class="card border-secondary mb-5" style="max-width: 90rem; margin-top: 10px;">
      <form method="POST" action="canceltutorial.php?tlistId=<?php echo $tutorial->tlistId;?>">
        <div class="card-body text-dark">

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="inputPassword4">Tutor</label>
              <input type="text" class="form-control" id="tutor" placeholder="Description of the Subject" name="tutor" value = " <?php echo $tutorial->tutor ?>"readonly="readonly">
            </div>
          
            <div class="form-group col-md-6">
              <label for="inputPassword4">Tutee</label>
              <input type="text" class="form-control" id="tutee" placeholder="Description of the Subject" name="tutee" value = "<?php echo $tutorial->tutee?>"readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputPassword4">Topic</label>
              <input type="text" class="form-control" id="editedby" placeholder="Description of the Subject" name="editedby" value="<?php echo $tutorial->topic ?>"readonly>
            </div>

            <div class="form-group col-md-4">
              <label for="inputPassword4">Date</label>
              <input type="text" class="form-control" id="editdate" name="editdate" value="<?php echo $tutorial->date ?>"readonly>
            </div>
            <div class="form-group col-md-4">
              <label for="inputPassword4">Time</label>
              <input type="text" class="form-control" id="editdate" name="editdate" value="<?php echo $tutorial->time ?>"readonly>
            </div>
          </div>

          
          
        </div>

      </div>
    </form>
  </div>
</div>

<div class="container">
    <h1 style="margin-bottom: 0;">Select Reason</h1>
    
    <div class="text-right" style="margin: 0px; padding: 0px; ">
    </div>
    <div style="clear: both;"></div>
    <div class="card border-secondary mb-5" style="max-width: 90rem; margin-top: 10px;">
      <form method="POST" action="canceltutorial.php?tlistId=<?php echo $tutorial->tlistId;?>&tutorId=<?php echo $tutorial->tutorId;?>&acctId=<?php echo $tutorial->acctId;?>">
        <div class="card-body text-dark">

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="inputPassword4">Choose from the following:</label>
              <div style="text-indent: 10px;">
			  <div><input type="radio" class="rad1" name="radio" id="unable" value="Unable to attend">Unable to attend</div>
			  <div><input type="radio" class="rad2" name="radio" id="ill" value="Feeling Ill">Feeling Ill</div>
			  <div><input type="radio" class="rad3" name="radio" id="emer" value="Emergency">Emergency</div>
        <div><input type="radio" class="rad4" name="radio" id="showtext" value="Other Participant Did Not Show">Other Participant Did Not Show</div>
			  <div><input type="radio" class="rad5" name="radio" id="showtext" value="others">Others</div>
			  </div>
            </div>
          </div>
          <?php 
          ?>
        <div class="form-row" id="textarea" style="display: none;">
        <div class="form-group col-md-8">
           <label for="inputPassword4">Specify your reason</label>
            <textarea type="text" class="form-control" id="cancelReason" placeholder="" name="cancelReason" value="<?php echo $tutorial->tutorial->tuteeFeed ?>/5"><?php echo htmlspecialchars($tutorial->cancelReason); ?></textarea>
        </div>
      </div>
          

          <div class="form-row text-right">
            <div class="form-group col-md-12">
              <button name="save" type="submit" class="btn btn-danger">Save</button>
              <a class="btn btn-secondary" href="viewonetutorial.php?tlistId=<?php echo $tlistId?>&tutorId=<?php echo $tutorId?>&acctId=<?php echo $acctId;?>">Cancel</a>
            </div>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>
</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
    $('#showtext').click(function(){
     var x = document.getElementById("textarea");
     x.style.display = "block";
    });
    $('#unable').click(function(){
     var x = document.getElementById("textarea");
     x.style.display = "none";
    });
    $('#ill').click(function(){
     var x = document.getElementById("textarea");
     x.style.display = "none";
    });
    $('#emer').click(function(){
     var x = document.getElementById("textarea");
     x.style.display = "none";
    });
});
</script>