<?php
include_once 'headeradmin.php';
include_once '../config/connection.php';
include_once '../classes/tutor.php';
include_once '../classes/subjects.php';
include_once '../classes/topic.php';

$tutorId= isset ($_GET ['tutorId']) ? $_GET['tutorId']: die('ERROR: missing ID.');


$database = new Database();
$db = $database->getConnection();


$tutor = new Tutor($db);
$tutor->userId = $tutorId;


$stmt = $tutor->viewTutorTopic();
$tutor->userId = $tutorId;
$stmt2 = $tutor->viewTutorAvail();

$tutor->viewonetutor2($tutorId);

if(isset($_POST['deactivate'])) {

  if ($_POST['tutorStatus'] != 'Pending'){
  $tutor = new Tutor($db);

  $tutor->tutorStatus=  'Inactive';
  $tutor->userId= $tutorId;

    if ($tutor->updateRequest()){
      echo "<script type='text/javascript'>alert('Tutor Successfully Updated!'); location='viewonetutor.php?tutorId={$tutorId}';</script>";
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

  if(isset($_POST['activate'])) {

  if ($_POST['tutorStatus'] != 'Pending'){
  $tutor = new Tutor($db);

  $tutor->tutorStatus=  'Active';
  $tutor->userId= $tutorId;

    if ($tutor->updateRequest()){
      echo "<script type='text/javascript'>alert('Tutor Successfully Updated!'); location='viewonetutor.php?tutorId={$tutorId}';</script>";
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

    <br><br>
    <div class="container">
      <h1 style="margin-bottom: 0;">Tutor Profile</h1>
      <a class="text-danger" href="tutors.php">[Back]</a>
      <br>
      <br>
   <div class="card border-secondary mb-5" style="max-width: 90rem;">
      <form method="POST" action="viewonetutor.php?tutorId=<?php echo $tutorId ?>">
        <div class="card-body text-dark">
          <div class="form-row">
          <div class="form-group col-md-12">
            <input type="hidden" class="form-control" id="userId" name="userId" value="<?php echo $tutor->userId ?>" readonly>
          </div>
        </div>
        <div class="form-row">

          <div class="form-group col-md-6">
            <label for="inputEmail4">First Name</label>
            <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" value="<?php echo $tutor->fname ?>" readonly>
          </div>

          <div class="form-group col-md-6">
            <label for="inputPassword4">Last Name</label>
            <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" value="<?php echo $tutor->lname ?>" readonly>
          </div>
        </div>

        <div class="form-row">          
          <div class="form-group col-md-6">
            <label for="inputCity">Status</label>
            <input type="text" class="form-control" id="tutorStatus" name="tutorStatus" value="<?php echo $tutor->tutorStatus ?>" readonly>
          </div>
        
        </div>

        <div class="form-row text-right">
            <div class="form-group col-md-12">
              <?php  if($tutor->tutorStatus == 'Active'){
                echo '<button name="deactivate" type="submit" class="btn btn-danger">Deactivate</button>';
              }else if($tutor->tutorStatus == 'Inactive'){
                echo '<button name="activate" type="submit" class="btn btn-danger">Activate</button>';
              }
              ?>
              <a href='deletetutor.php?userId=<?php echo $tutorId ?>&loc=1' class='btn btn-secondary' onclick=' return confirm("Are you sure?"); '>Delete</a>
            </div>
          </div>
      </div>
    </form>
</div>
 </div>
<!------------------------------------------------------->


  <div class="container">
    <h3 class="float-left" style="margin-bottom: 0;">Topics Offered</h3>
    <?php if($tutor->tutorStatus =='Active'){
      echo '<a class=\'btn btn-danger text-light float-right\' href="addtutortopic.php?tutorId='; echo $tutorId; echo '"  style="margin:5px;">Add Topic</a>';
    }
    ?>
      <div style="clear: both;"></div>
    <div class="card border-secondary mb-5" style="width: 100%;">
      <div class="form-row" style="max-width: 80em;">
        <div class="form-group col-md-12" style="margin: 0 1px;">
          

          <table class='table table-hover'>
            <thead>
              <tr>
                <th scope='col'><p class='text-center'>Subject</p></th>
                <th scope='col'><p class='text-center'>Topic Name</p></th>
                <th scope='col'><p class='text-center'>Topic Description</p></th>
                <th scope='col'></th>
              </tr>
            </thead>
            <tbody>
                  <?php
                  if($stmt->rowCount()>0){
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                  extract($row);
                  echo"

                  <tr>
                  <td><p class='text-center'>{$subjname}</p></td>
                  <td><p class='text-center'>{$topname}</p></td>
                  <td><p class='text-center'>{$topdesc}</p></td>
                  <td>";  
                  if($tutorStatus == 'Active'){
                    echo "<p class='text-center'><a class='btn btn-secondary text-white delete-object' delete-id='{$subjId}' href='deletetutortopic.php?taughtId={$taughtId}&tutorId={$userId}'>Remove</a></p>";
                  }
                  echo "
                  </td>
                  </tr>
                  </tbody>
                  ";
                  }
                }else{
                  echo 
                    "
                    <tr>
                      <td class='text-center' colspan='4'>Nothing to show.</td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
          </table>
        </div>
    </div>
  </div>
</div>

<div class="container">
    <h3 class="float-left" style="margin-bottom: 0;">Days/Time Available</h3>
      <div style="clear: both;"></div>
    <div class="card border-secondary mb-5" style="width: 100%;">
      <div class="form-row" style="max-width: 80em;">
        <div class="form-group col-md-12 text-center" style="margin: 0 1px;">
          

          <table class='table table-hover'>
            <thead>
              <tr>
                <th scope='col'><p class='text-center'>Day</p></th>
                <th scope='col'><p class='text-center'>Time</p></th>
              </tr>
            </thead>
            <tbody>
                  <?php
                  if($stmt2->rowCount()>0){
                  while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                  extract($row);
                  echo"

                  <tr>
                  <td><p class='text-center'>{$DaysAvail}</p></td>
                  <td><p class='text-center'>{$TimeAvail}</p></td>
                  </tr>
                  </tbody>
                  ";
                  }
                }else{
                  echo 
                    "
                    <tr>
                      <td class='text-center' colspan='3'>Nothing to show.</td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
          </table>
        </div>
    </div>
  </div>
</div>
</body>

<script type="text/javascript">
  function enable_value(){
    var x = document.getElementById("editTools");
    var y = document.getElementById("edit");
    var z = document.getElementById("enabled");
    var w = document.getElementById("disabled");
     if (x.style.display === "none") {
       x.style.display = "block";
       y.style.display = "none";
       z.style.display = "none";
       w.style.display = "block";
     } else {
       x.style.display = "none";
     }
  }
</script>


<?php
include_once '../footer.php';
?>