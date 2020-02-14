<?php
include_once 'headerstudent.php';
include_once '../classes/tutorial.php';
include_once '../classes/account.php';
include_once '../config/connection.php';

$tlistId= isset ($_GET ['tlistId']) ? $_GET['tlistId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$tutorial = new Tutorial($db);
$tutorial->tlistId = $tlistId;
$tutorial->readOneTutorial();

$account = new Account($db);
$account->userId = $_SESSION['userId'];
$account->readOneAccount();

$date =date("M/d/Y");


if(isset($_POST['accept'])) {
  $tutorial->readOneTutorial();
  if ($tutorial->tListStatus == 'Pending'){
  $tutorial->tListStatus=  'Active';

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
  }

if(isset($_POST['decline'])) {
    $tutorial->readOneTutorial();
    if ($tutorial->tListStatus == 'Pending'){
  $tutorial->tListStatus=  'Inactive';

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
  }
?>

<body >

  <div class="container">
    <h1 style="margin-bottom: 0;">Tutorial Request Details</h1>
    <a class="text-danger" href="homestudent.php">[Back]</a>
    <br>
    <div class="card border-secondary mb-5" style="max-width: 90rem; margin-top: 10px;">
      <form method="POST" action="viewonetutorialreq.php?tlistId=<?php echo $tlistId;?>">
        <div class="card-body text-dark">

          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="inputPassword4">Tutor</label>
              <input type="text" class="form-control" id="tutor" placeholder="Description of the Subject" name="tutor" value = " <?php echo $tutorial->tutor; ?>"readonly="readonly">
            </div>
          
            <div class="form-group col-md-6">
              <label for="inputPassword4">Tutee</label>
              <input type="text" class="form-control" id="tutee" placeholder="Description of the Subject" name="tutee" value = "<?php echo $tutorial->tutee;?>"readonly>
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

            
          <div class="form-row text-right">
            <div class="form-group col-md-12">
          <?php if($tutorial->tListStatus == 'Pending' && $tutorial->tutor==$account->fname." ".$account->lname){
            echo '
          
              <button name="accept" type="submit" class="btn btn-danger">Accept</button>
              <button name="decline" type="submit" class="btn btn-secondary">Decline</button>
            ';
          }else{
            echo "<a class='btn btn-secondary' href='cancelreq.php?tlistId={$tlistId}' role='button'>Cancel Request</a>";
          }
          ?>
              
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
</script>

<?php
include_once '../footer.php';
?>