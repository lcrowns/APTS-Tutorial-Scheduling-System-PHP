<?php
include_once 'headerstudent.php';
include_once '../config/connection.php';
include_once '../classes/account.php';
include_once '../classes/tutor.php';


$userId= isset ($_GET ['userId']) ? $_GET['userId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->userId = $userId;
$account->readOneAccount();

$loc=1;
$tutor = new Tutor($db);
$tutor->userId = $userId;
$tutor->viewonetutor2($userId);
$mytopics = $tutor->readMyTopics($userId);
$stmt2 = $tutor->viewTutorAvail();
?>

<body>

      <h1 style="margin-bottom: 0;">Tutor Profile</h1>


    <h3 class="float-left" style="margin-bottom: 0;">My Topics</h3>
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
              </tr>
            </thead>
            <tbody>
                  <?php
                  if($mytopics->rowCount()>0){
                  while ($row = $mytopics->fetch(PDO::FETCH_ASSOC)){
                  extract($row);
                  echo"

                  <tr>
                  <td><p class='text-center'>{$subjname}</p></td>
                  <td><p class='text-center'>{$topname}</p></td>
                  <td><p class='text-center'>{$topdesc}</p></td>
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
	<a class='btn btn-danger text-light float-right' href="addavail.php?tutorId=<?php echo $tutor->tutorId?>&userId=<?php echo $userId?>"  style="margin:5px 0;">Add Day/Time</a>
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
                  <td><p class='text-center'><a class='btn btn-secondary text-white delete-object' href='deleteavail.php?tutorId={$tutorId}&loc={$loc}&DaysAvail={$DaysAvail}&TimeAvail={$TimeAvail}' onclick='return confirm(\"Are you sure?\")'>Remove</a></p></td>
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

<script type="text/javascript">

   /**$(document).on('click', '.delete-object', function(){
       var q = confirm("Are you sure?");
       if (q==true){
        return = false;
       }else{
        return = true;
       }
    });**/
    
</script>

<?php
include_once '../footer.php';
?>