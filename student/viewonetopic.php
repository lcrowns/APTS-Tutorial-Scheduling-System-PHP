<?php
include_once 'headerstudent.php';
include_once '../classes/topic.php';
include_once '../classes/account.php';
include_once '../classes/tutor.php';
include_once '../classes/subjects.php';
include_once '../config/connection.php';

$topicId= isset ($_GET ['topicId']) ? $_GET['topicId']: die('ERROR: missing ID.');


$tutee = new Account($db);
$tutee->$userId = $_SESSION['userId'];
$tutee->readOneAccount();

$tuteeId = $_SESSION['userId'];

$acctId = $account->acctId;
$userId = $account->$userId = $_SESSION['userId'];

$topic = new Topic($db);
$topic->topicId = $topicId;
$topic->readOnetopic1();

$subject = new Subject($db);
$subject->readOneSubj();
$subjId = $subject->subjId; 

$tutor = new Tutor($db);
$stmt = $tutor->readTutorTop($topicId);

?>

<body>

    <br><br>
  <div class="container">
    <h1 style="margin-bottom: 0;">Topic Details</h1>
    <a class="text-danger" href="viewonesubj.php?subjId=<?php echo $topic->subjId ?>">[Back]</a>
    <br>
    <br>
    <div class="card border-secondary mb-5" style="max-width: 90rem;">
      <form method="POST" action="edittopic.php?topicId=<?php echo $topic->topicId;?>">
        <div class="card-body text-dark">

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputEmail4">Topic</label>
              <input type="text" class="form-control" id="topname" name="topname" value = "<?php echo $topic->topname ?>" readonly>
            </div>
            <div class="form-group col-md-8">
              <label for="inputPassword4">Topic Description</label>
              <input type="text" class="form-control" id="topdesc" name="topdesc" value = "<?php echo $topic->topdesc ?>"readonly>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="container">
    <h3 class="float-left" style="margin-bottom: 0;"><?php echo $subject->subjname ?> Tutors</h3>
      <div style="clear: both;"></div>

    <div class="card border-secondary mb-5" style="max-width: 90rem;">
      <?php include_once 'viewtutors_active.php';?>
    </div>
  </div>
</body>
