<?php
include_once 'headerstudent.php';
include_once '../config/connection.php';
include_once '../classes/account.php';
include_once '../classes/tutor.php';


$tutorId= isset ($_GET ['tutorId']) ? $_GET['tutorId']: die('ERROR: missing ID.');
$userId= isset ($_GET ['userId']) ? $_GET['userId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$id = $account->getTutorId($userId);
$loc=2;
$tutor = new Tutor($db);
$tutor->userId = $userId;
$stmt2 = $tutor->viewTutorAvail();


$tutor1 = new Tutor($db);
$tutor1->tutorId = $tutorId;
$tutor1->viewonetutor2($userId);
$poo = $tutor1->tutorStatus;

if(isset($_POST['save'])){

  $tutor = new Tutor($db);
  $tutor->userId=$userId;
  $tutor->tutorStatus= $poo;

  $checked = $_POST['day'];
  $checked2 = $_POST['time'];
    
  for($i=0; $i < count($checked); $i++){
    $tutor->DaysAvail = $checked[$i];
    for($a=0; $a < count($checked2); $a++){
      $tutor->TimeAvail= $checked2[$a];
      $duplicate = false;

      $tutor1 = new Tutor($db);
      $tutor1->userId = $userId;
      $stmtt = $tutor1->viewTutorAvail();

      while ($row = $stmtt->fetch(PDO::FETCH_ASSOC)){
      extract($row);
        if($DaysAvail == $checked[$i] AND $TimeAvail == $checked2[$a]){
          $duplicate = true;
        }
      }

      if ($duplicate ==false){
      if ($tutor->addTutor2()){
            echo "<script type='text/javascript'>alert('Successfully Added!'); location='addavail.php?tutorId=$tutorId&userId=$userId';</script>";
          }

      }else{
        echo "<script type='text/javascript'>location='addavail.php?tutorId=$tutorId&userId=$userId';</script>";
      }
    }
  }
}
?>

<body style="background-color:white;">
    <br><br>
    <div class="container">
      <h1 style="margin-bottom: 0;">Add Available Day/Time</h1>
    <a class="text-danger" href="myaccount.php?userId=<?php echo $userId?>">[Back]</a>
    <br><br>
   <div class="card border-secondary mb-5" style="max-width: 90rem;">
    <form method="POST" >
      <div class="card-body text-dark">
        <div class="form-row">
          <div class="form-group col-md-4">
            <h3>Day:</h3>
            <input type="checkbox" name="day[]" value="Monday"> Monday<br>
            <input type="checkbox" name="day[]" value="Tuesday"> Tuesday<br>
            <input type="checkbox" name="day[]" value="Wednesday"> Wednesday<br>
            <input type="checkbox" name="day[]" value="Thursday"> Thursday<br>
            <input type="checkbox" name="day[]" value="Friday"> Friday<br>
          </div>

          <div class="form-group col-md-4">
            <h3>Time:</h3>
            <input type="checkbox" name="time[]" value="8:00 AM-9:00 AM"> 8:00 AM-9:00 AM<br>
            <input type="checkbox" name="time[]" value="8:30 AM-9:30 AM"> 8:30 AM-9:30 AM<br>
            <input type="checkbox" name="time[]" value="9:00 AM-10:00 AM"> 9:00 AM-10:00 AM<br>
            <input type="checkbox" name="time[]" value="9:30 AM-10:30 AM"> 9:30 AM-10:30 AM<br>
            <input type="checkbox" name="time[]" value="10:00 AM-11:00 AM"> 10:00 AM-11:00 AM<br>
            <input type="checkbox" name="time[]" value="10:30 AM-11:30 AM"> 10:30 AM-11:30 AM<br>
            <input type="checkbox" name="time[]" value="11:00 AM-12:00 PM"> 11:00 AM-12:00 PM<br>
            <input type="checkbox" name="time[]" value="11:30 AM-12:30 PM"> 11:30 AM-12:30 PM<br>
          </div>

          <div class="form-group col-md-4">
            <br><br>
            <input type="checkbox" name="time[]" value="1:00 PM-2:00 PM"> 1:00 PM-2:00 PM<br>
            <input type="checkbox" name="time[]" value="1:30 PM-2:30 PM"> 1:30 PM-2:30 PM<br>
            <input type="checkbox" name="time[]" value="2:00 PM-3:00 PM"> 2:00 PM-3:00 PM<br>
            <input type="checkbox" name="time[]" value="2:30 PM-3:30 PM"> 2:30 PM-3:30 PM<br>
            <input type="checkbox" name="time[]" value="3:00 PM-4:00 PM"> 3:00 PM-4:00 PM<br>
            <input type="checkbox" name="time[]" value="3:30 PM-4:30 PM"> 3:30 PM-4:30 PM<br>
            <input type="checkbox" name="time[]" value="4:00 PM-5:00 PM"> 4:00 PM-5:00 PM<br>
            <input type="checkbox" name="time[]" value="4:30 PM-5:30 PM"> 4:30 PM-5:30 PM<br>
          </div>
        </div>

        <div class="form-row text-right">
            <div class="form-group col-md-12">
              <button name="save" type="submit" class="btn btn-danger">Save</button>
            </div>
          </div>

        </div>
      </form>
        
  </div>
</div>

<div class="container">
    <h3 class="float-left" style="margin-bottom: 0;">Day/Time Available</h3>
      <div style="clear: both;"></div>
    <div class="card border-secondary mb-5" style="width: 100%;">
      <div class="form-row" style="max-width: 80em; ">
        <div class="form-group col-md-12 text-center" style="margin: 0 1px;">
          

          <table class='table table-hover'>
            <thead>
              <tr>
                <th scope='col'><p class='text-center'>Day</p></th>
                <th scope='col'><p class='text-center'>Time</p></th>
                <th scope='col'></th>
              </tr>
            </thead>
            <tbody>
                  <?php
                  if($stmt2->rowCount()>0 ){
                  while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                  extract($row);
                  if($DaysAvail != '' AND $TimeAvail != ''){
                  echo"

                  <tr>
                  <td><p class='text-center'>{$DaysAvail}</p></td>
                  <td><p class='text-center'>{$TimeAvail}</p></td>
                  <td><a class='btn btn-secondary text-white delete-object text-center' href='deleteavail.php?tutorId={$tutorId}&loc={$loc}&DaysAvail={$DaysAvail}&TimeAvail={$TimeAvail}' onclick='return confirm(\"Are you sure?\")'>Remove</a></td>
                  </tr>
                  </tbody>
                  ";
                  }elseif($stmt2->rowCount()==1 AND $DaysAvail == '' AND $TimeAvail == ''){
                    echo 
                    "
                    <tr>
                      <td class='text-center' colspan='3'>Nothing to show.</td>
                    </tr>
                    ";
                  }else{ continue; }
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
  <div style="clear: both;"></div>
</div>


  </body>

<script>

   /**$(document).on('click', '.delete-object', function(){
       var q = confirm("Are you sure?");
       if (q==true){
        return = false;
       }else{
        return = true;
       }
    });**/
    
    function confirmMe(){
      var q =confirm("parameter");
       if (q==true){
        return = false;
       }else{
        return = true;
       }
    }
</script>

<?php
include_once '../footer.php';
?>