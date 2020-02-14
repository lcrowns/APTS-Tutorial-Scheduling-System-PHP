<?php
include_once 'headeradmin.php';
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

if(isset($_POST['deactivate'])) {
    $topic->topstatus= 'Inactive';

    if ($topic->updatetopic()){
      echo "<script type='text/javascript'>alert('Topic Successfully Updated!'); location='viewonetopic.php?topicId={$topicId}';</script>";
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

  if(isset($_POST['activate'])) {
    $topic->topstatus= 'Active';

    if ($topic->updatetopic()){
      echo "<script type='text/javascript'>alert('Topic Successfully Updated!'); location='viewonetopic.php?topicId={$topicId}';</script>";
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

  if(isset($_POST['save'])) {

    $topic->topname = $_POST['topname'];
    $topic->topdesc = $_POST['topdesc'];

    if ($topic->updatetopic()){
      echo "<script type='text/javascript'>alert('Topic Successfully Updated!'); location='viewonetopic.php?topicId={$topicId}';</script>";
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

  if(isset($_POST['delete'])) {

    if ($topic->deleteOneTop()){
      echo "<script type='text/javascript'>alert('Topic Successfully Deleted!'); location='viewonesubj.php?subjId={$subjId}';</script>";
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

<body>

    <br><br>
  <div class="container">
    <h1 style="margin-bottom: 0;">Topic Details</h1>
    <a class="text-danger" href="viewonesubj.php?subjId=<?php echo $topic->subjId ?>">[Back]</a>
    <br>
    <br>
    <div class="card border-secondary mb-5" style="max-width: 90rem;">
      <form method="POST" action="viewonetopic.php?topicId=<?php echo $topic->topicId;?>">
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

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputEmail4">Status</label>
              <input type="text" class="form-control" id="topstatus" name="topstatus" value = "<?php echo $topic->topstatus ?>" readonly>
            </div>
          </div>

          <div class="form-row text-right">
            <div class="form-group col-md-12">
              <div id="editTools" style="display: none;">
              <button name="save" type="submit" class="btn btn-danger">Save</button>
              <a class="btn btn-secondary" href="viewonetopic.php?topicId=<?php echo $topic->topicId;?>" role="button">Cancel</a>
              </div>
              <input type="button" class="btn btn-danger" value="Edit" name="edit" id="edit">
            </div>
          </div>

          <div class="form-row text-right">
            <div class="form-group col-md-12">
              <?php  if($topic->topstatus == 'Active'){
                echo '<button id="deactivate" name="deactivate" type="submit" class="btn btn-danger">Deactivate</button>';
              }else if($topic->topstatus == 'Inactive'){
                echo '<button id="activate" name="activate" type="submit" class="btn btn-danger">Activate</button>';
              }
              ?>
              <button id="delete" name="delete" type="submit" class="btn btn-secondary" onclick=' return confirm("Are you sure?"); '>Delete</button>
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>

  <div class="container">
    <h3 class="float-left" style="margin-bottom: 0;"><?php echo $subject->subjname ?> Tutors</h3>
      <div style="clear: both;"></div>
      <form method='POST' action='viewonetopic.php?topicId=<?php echo $topicId ?>'>
      <div class="form-row">
      <div class="form-group col-md-12 input-group">
      <input type='text' class='form-control' id='search1' name='search1' placeholder='Search here' required>
      <?php if(!isset($_POST['search1'])){
        echo "<input class='btn text-dark' type='submit' value='Search' style='background-color: lightgray;'>";
      }else{
        echo '<a class="btn btn-secondary" href="viewonetopic.php?topicId=';echo $topicId; echo'">Reset</a>';
      }?>
    </div>
    </div>
    <div class="card border-secondary mb-5" style="max-width: 90rem;">
      <?php
        include_once 'viewtutors_active.php';
      ?>
    </div>
  </form>
  </div>
</body>

<script type="text/javascript">
  $(document).ready(function(){

    $('#cancel').click(function(){

     document.getElementById('topname').value = "<?php echo $topic->topname ?>";
     document.getElementById('topdesc').value = "<?php echo $topic->topdesc ?>";
    });

    $('#edit').click(function(){
    if($('#topname').prop('readonly'))
    {
     $('#topname').removeAttr('readonly');
     $('#topname').attr('required', 'required');

     $('#topdesc').removeAttr('readonly');
     $('#topdesc').attr('required', 'required');

     $('#edit').attr('hidden', 'hidden');

     $('#activate').attr('hidden', 'hidden');
     $('#deactivate').attr('hidden', 'hidden');
     $('#delete').attr('hidden', 'hidden');

     var x = document.getElementById("editTools");
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
    }
    else{
         $('#subjname').attr('readonly', 'readonly')
      }
    });
});
</script>
