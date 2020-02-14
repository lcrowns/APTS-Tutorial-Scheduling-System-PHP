<?php
include_once 'headeradmin.php';
include_once '../config/connection.php';
include_once '../classes/tutor.php';

$tutorId= isset ($_GET ['tutorId']) ? $_GET['tutorId']: die('ERROR: missing ID.');


$database = new Database();
$db = $database->getConnection();


$tutor = new Tutor($db);
$tutor->tutorId = $tutorId;
$tutor->viewonetutor();

$account = new Account($db);
$account->userId = $tutor->userId;
$account->readOneAccount();


if(isset($_POST['save'])) {

  if ($_POST['tutorStatus'] != 'Pending'){
  $tutor = new Tutor($db);

  $tutor->tutorStatus=  $_POST['tutorStatus'];
  $tutor->tutorId= $tutorId;

    if ($tutor->updateRequest()){
      echo "<script type='text/javascript'>alert('Request Successfully Updated!'); location='tutors.php';</script>";
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

<body>

    <br>
    <div class="container">
      <h1 style="margin-bottom: 0;">Tutor Request</h1>
      <a class="text-danger" href="tutors.php">[Back]</a>
      <br>
      <br>
   <div class="card border-secondary mb-5" style="max-width: 90rem;">
      <form method="POST" action="viewonetutorreq.php?tutorId=<?php echo $tutorId ?>">
                <br>
                <div class="card-body text-dark">
        <div class="form-row">

          <div class="form-group col-md-6">
            <label for="inputEmail4">First Name</font></label>
            <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" value="<?php echo $account->fname ?>" readonly>
          </div>

          <div class="form-group col-md-6">
            <label for="inputPassword4">Last Name</font></label>
            <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" value="<?php echo $account->lname ?>" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputEmail4">Email</font></label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid Email Please Enter Valid Email (eg. johndoe@email.com)" value="<?php echo $account->email ?>" readonly>
          </div>

          <div class="form-group col-md-4">
            <label for="inputCity">Mobile Phone Number</font></label>
            <input type="Number" class="form-control" id="contact" placeholder="099999999" name="contact" value="<?php echo $account->contact ?>" readonly>
          </div>

          <div class="form-group col-md-4">
            <label for="inputCity">ID Number</font></label>
            <input type="Number" class="form-control" id="userId" placeholder="20100000" name="userId" value="<?php echo $account->userId ?>" readonly>
          </div>

          <?php 
          if ($tutor->tutorStatus != 'Pending'){
          echo '
          <div class="form-row">
            <div class="form-group col-md-12">
              <div class="float-right">
              <label>Status</label>
              <select class="form-control" name="tutorStatus" id="exampleFormControlSelect1" value = "'; echo $tutor->tutorStatus; echo '" disabled>
                <option selected readonly>'; echo $tutor->tutorStatus; echo '</option>
                <option disabled="true"> </option>
                <option disabled="true">-Choose below to change Tutor status-</option>
                <option value="Active">Accept</option>
                <option value="Declined">Deny</option>
              </select>
            </div>
            </div>
          </div>';
          }else{
            echo '
          <div class="form-row">
            <div class="form-group col-md-12">
              <div class="float-right">
              <label>Status</label>
              <select class="form-control" name="tutorStatus" id="exampleFormControlSelect1" value = "';echo $tutor->tutorStatus; echo '" required>
                <option selected readonly>'; echo $tutor->tutorStatus; echo '</option>
                <option disabled="true"> </option>
                <option disabled="true">-Choose below to change Tutor status-</option>
                <option value="Active">Accept</option>
                <option value="Declined">Deny</option>
              </select>
            </div>
            </div>
          </div>';
          }

          ?>
        </div>
      <div class="form-row">
        <div class="form-group col-md-12">
          <div class="float-right">          
            <button name="save" type="submit" class="btn btn-danger">Save</button>
            <a class="btn btn-secondary" href="tutors.php" role="button">Cancel</a>
          </div>
        </div>
      </div>
        <!--<a style="background-color: gray; color: white; padding: 7px 15px; text-align: center; text-decoration: none; display: inline-block; border-radius: 5px; margin-bottom: 0;">Cancel</a>-->
        

        </div>
        
      </form>
  </div>

  </body>



<?php
include_once '../footer.php';
?>