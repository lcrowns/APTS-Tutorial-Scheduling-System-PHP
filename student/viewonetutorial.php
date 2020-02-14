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
    $tutorial->tlistId= $tlistId;
    $tutorial->tutorFeed=  $_POST['tutorFeed'];

    if ($tutorial->updateTutorial()){
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

  if(isset($_POST['save2'])) {
    $tutorial->readOneTutorial();
    $tutorial->tuteeFeed=  $_POST['tuteeFeed'];
    $tutorial->tuteeRate=  $_POST['radioRate'];

    if ($tutorial->updateTutorial()){
      echo "<script type='text/javascript'>alert('Tutorial Successfully Updated!'); location='viewonetutorial.php?tlistId={$tlistId};</script>";
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
    <h1 style="margin-bottom: 0;">Tutorial Details</h1>
    <a class="text-danger" href="homestudent.php">[Back]</a>
    <div class="text-right" style="margin: 0px; padding: 0px; ">
    <?php if($tutorial->tListStatus == 'Active' && $account->ifTutor()){
      echo '
    <a class="btn btn-danger" href="markcomplete.php?tlistId=';echo $tlistId; echo'" role="button">Mark as Complete</a>';
    }
    if($tutorial->tListStatus == 'Active'){
      echo '
    <a class="btn btn-secondary" href="canceltutorial.php?tlistId=';echo $tlistId; echo'" role="button">Cancel Tutorial</a>';
  }
    ?>
    </div>
    <div style="clear: both;"></div>
    <div class="card border-secondary mb-5" style="max-width: 90rem; margin-top: 10px;">
      <form method="POST" action="viewonetutorial.php?tlistId=<?php echo $tutorial->tlistId;?>">
        <div class="card-body text-dark">

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="inputPassword4">Tutor</label>
              <input type="text" class="form-control" id="tutor" placeholder="Description of the Subject" name="tutor" value = " <?php echo $tutorial->tutor; ?>"readonly="readonly">
            </div>
          
            <div class="form-group col-md-6">
              <label for="inputPassword4">Tutee</label>
              <input type="text" class="form-control" id="tutee" placeholder="Description of the Subject" name="tutee" value = "<?php echo $tutorial->tutee; ?>" readonly>
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

           <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputPassword4">Status</label>
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

<?php 

$name = $account->fname." ".$account->lname;

if($tutorial->tListStatus == 'Completed'){
echo '
<div class="container">
  <h4>Student Comments</h4>
  <div class="card border-secondary mb-5" style="max-width: 90rem; margin-top: 10px;">
    <form method="POST" action="viewonetutorial.php?tlistId=';echo $tlistId; echo'">
    <div class="card-body text-dark">';
      
      echo '
      <div class="form-row" id="rate">
        <div class="form-group col-md-6">
           <label for="inputPassword4">Tutee Rate</font></label>
            <input type="text" class="form-control" id="tuteeRate" placeholder="" name="tuteeRate" value="';echo $tutorial->tuteeRate; echo '"readonly>
        </div>
        </div>
      <div class="form-row" id="radioSel" style="display:none;">
      <div class="form-group col-md-8">
        <div class="custom-control custom-radio custom-control-inline">
          <div class="">
          <input type="radio" id="radioRate" name="radioRate" class="" value="1"> 1
          </div>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
        <div class="">
          <input type="radio" id="radioRate" name="radioRate" class="" value="2"> 2
          </div>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
        <div class="">
          <input type="radio" id="radioRate" name="radioRate" class="" value="3"> 3
          </div>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
        <div class="">
          <input type="radio" id="radioRate" name="radioRate" class="" value="4"> 4
          </div>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
        <div class="">
          <input type="radio" id="radioRate" name="radioRate" class="" value="5"> 5 
          </div>
        </div>
      </div>
      </div>
      <br>
      <div class="form-row">
        <div class="form-group col-md-6">
           <label for="inputPassword4">Tutee Feedback</font></label>
            <textarea type="text" class="form-control" id="tuteeFeed" placeholder="" name="tuteeFeed" value="<?php echo $tutorial->tutorial->tuteeFeed ?>"readonly>';echo htmlspecialchars($tutorial->tuteeFeed); echo '</textarea>
      </div>';
      
      echo '
      
        <div class="form-group col-md-6">
          <label for="inputPassword4">Tutor Feedback</font></label>
          <textarea type="text" class="form-control" id="tutorFeed" name="tutorFeed" readonly >';echo htmlspecialchars($tutorial->tutorFeed); echo '</textarea>
        </div>
      </div>';
      if($tutorial->tListStatus == 'Completed' && ($tutorial->tuteeFeed == null OR $tutorial->tuteeRate == null) && $name == $tutorial->tutee){
        echo 
        '<div class="form-row">
        <div class="form-group col-md-12">
          <div class="float-right">    
            <div id="editTools" style="display: none;">      
            <button name="save2" type="submit" class="btn btn-danger">Save</button>
            <a class="btn btn-secondary" href="viewonetutorial.php?tlistId=';echo $tlistId; echo '" role="button">Cancel</a>
            </div>
            <input type="button" class="btn btn-danger" value="Edit" name="edittutee" id="edittutee">
          </div>
        </div>
      </div>';
      }elseif($tutorial->tListStatus == 'Completed' && $tutorial->tutorFeed == null && $name == $tutorial->tutor){
        echo 
        '<div class="form-row">
        <div class="form-group col-md-12">
          <div class="float-right">    
            <div id="editTools" style="display: none;">      
            <button name="save" id="save" type="submit" class="btn btn-danger">Save</button>
            <a class="btn btn-secondary" href="viewonetutorial.php?tlistId=';echo $tlistId;  echo '" role="button">Cancel</a>
            </div>
            <input type="button" class="btn btn-danger" value="Edit" name="edittutor" id="edittutor">
          </div>
        </div>
      </div>';
      }
    echo '  
    </div>
    </form>


  </div>
</div>';
}
?>

</body>

<script type="text/javascript">
  $(document).ready(function(){
    $('#edittutor').click(function(){
    if($('#tutorFeed').prop('readonly'))
    {
     $('#tutorFeed').removeAttr('readonly');
     $('#tutorFeed').attr('required', 'required');

     $('#edittutor').attr('hidden', 'hidden');

     var x = document.getElementById("editTools");
     if (x.style.display === "none") {
       x.style.display = "block";
     } else {
       x.style.display = "none";
     }
    }
    else{
         //$('#subjname').attr('readonly', 'readonly')
      }
    });
});

  $(document).ready(function(){
    $('#edittutee').click(function(){
    if($('#tuteeFeed').prop('readonly'))
    {
     $('#tuteeFeed').removeAttr('readonly');
     $('#tuteeFeed').attr('required', 'required');

     $('#edittutee').attr('hidden', 'hidden');

     var x = document.getElementById("editTools");
     var y = document.getElementById("tuteeRate");
     var z = document.getElementById("radioSel");
     if (x.style.display === "none") {
       x.style.display = "block";
       z.style.display= "block";
       y.style.display= "none";
     } else {
       x.style.display = "none";
       y.style.display= "none";
       
     }
    }
    else{
         //$('#subjname').attr('readonly', 'readonly')
      }
    });
});

</script>

<?php
include_once '../footer.php';
?>