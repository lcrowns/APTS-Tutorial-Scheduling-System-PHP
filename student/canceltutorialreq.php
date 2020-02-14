<?php
include_once 'headerstudent.php';
include_once '../classes/tutorial.php';
include_once '../classes/subjects.php';
include_once '../classes/topic.php';
include_once '../config/connection.php';

$tlistId= isset ($_GET ['tlistId']) ? $_GET['tlistId']: die('ERROR: missing ID.');
$tutorId= isset ($_GET ['tutorId']) ? $_GET['tutorId']: die('ERROR: missing ID.');
$acctId= isset ($_GET ['acctId']) ? $_GET['acctId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->userId = $_SESSION['userId'];

$tutorial = new Tutorial($db);
$tutorial->tlistId = $tlistId;
$tutorial->readOneTutorial();

$parts = explode("-", $tutorial->time);
$one = substr($parts[1], 0, -3);

$datein = $tutorial->date;
$timein = $one;

$selectedDate = date( 'Y-m-d H:i', strtotime("$datein $timein"));


?>

<body >

  <div class="container">
    <h1 style="margin-bottom: 0;">Cancel Tutorial</h1>
    <a class="text-danger" href="viewonetutorial.php?tlistId=<?php echo $tlistId?>&tutorId=<?php echo $tutorId?>&acctId=<?php echo $acctId;?>">[Back]</a>
    <div class="text-right" style="margin: 0px; padding: 0px; ">
    </div>
    <div style="clear: both;"></div>
    <div class="card border-secondary mb-5" style="max-width: 90rem; margin-top: 10px;">
      <form method="POST" action="viewonetutorial.php?tlistId=<?php echo $tutorial->tlistId;?>">
        <div class="card-body text-dark">

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="inputPassword4">Tutor</label>
              <input type="text" class="form-control" id="tutor" placeholder="Description of the Subject" name="tutor" value = " <?php echo $tutorial->getTutor($tutorial->tutorId); ?>"readonly="readonly">
            </div>
          
            <div class="form-group col-md-6">
              <label for="inputPassword4">Tutee</label>
              <input type="text" class="form-control" id="tutee" placeholder="Description of the Subject" name="tutee" value = "<?php echo $tutorial->getTutee($tutorial->acctId);?>"readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputPassword4">Topic</label>
              <input type="text" class="form-control" id="editedby" placeholder="Description of the Subject" name="editedby" value="<?php echo $tutorial->getTopic($tutorial->topicId) ?>"readonly>
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
    <a class="text-danger" href="viewonetutorial.php?tlistId=<?php echo $tlistId?>&tutorId=<?php echo $tutorId?>&acctId=<?php echo $acctId;?>">[Back]</a>
    <div class="text-right" style="margin: 0px; padding: 0px; ">
    </div>
    <div style="clear: both;"></div>
    <div class="card border-secondary mb-5" style="max-width: 90rem; margin-top: 10px;">
      <form method="POST" action="viewonetutorial.php?tlistId=<?php echo $tutorial->tlistId;?>">
        <div class="card-body text-dark">

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="inputPassword4">Choose from the following:</label>
              <div style="text-indent: 5%;">
			  <div><input type="radio" name="radio" value="Unable to attend">Unable to attend</div>
			  <div><input type="radio" name="radio" value="Feeling Ill">Feeling Ill</div>
			  <div><input type="radio" name="radio" value="Emergency">Emergency</div>
			  <div><input type="radio" name="radio">Others</div>
			  </div>
            </div>
          </div>

          
          
        </div>

      </div>
    </form>
  </div>
</div>
</div>