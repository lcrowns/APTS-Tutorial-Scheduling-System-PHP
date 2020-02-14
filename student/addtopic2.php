<?php
include_once 'headerstudent.php';
include_once '../classes/subjects.php';
include_once '../classes/topic.php';
include_once '../classes/tutor.php';
include_once '../config/connection.php';

$subjId= isset ($_GET ['subjId']) ? $_GET['subjId']: die('ERROR: missing ID.');
$tutorId= isset ($_GET ['tutorId']) ? $_GET['tutorId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->userId = $userId;
$account->readOneAccount();

$subject = new Subject($db);
$subject->subjId = $subjId;
$subject->readOneSubj();
$stmt = $subject->readOneTopicAct();


$tutor1 = new Tutor($db);

  if(isset($_POST['save'])) {

    
  }
?>

<body >

  <div class="container">
    <h1 style="margin-bottom: 0;">Add Topic</h1>
     <a class="text-secondary" href="homestudent.php">Home</a> > 
    <a class="text-secondary" href="mytutorprofile.php?userId=<?php echo $_SESSION['userId']; ?>">Tutor Profile</a> >
    <a class="text-secondary" href="addtopic.php?tutorId=<?php echo $tutorId?>&userId=<?php echo $_SESSION['userId']; ?>">Select Subject</a>
    <br>
    <a class="text-danger" href="addtopic.php?tutorId=<?php echo $tutorId?>&userId=<?php echo $_SESSION['userId']; ?>">[Back]</a>
    <br>
    
    <h3 class="float-left" style="margin-bottom: 0;"><?php echo $subject->subjname ?> Topics</h3>
      <div style="clear: both;"></div>

    <div class="card border-secondary mb-5" style="max-width: 90rem;">
      <div class="form-row">
        <div class="form-group col-md-12">
          

          <table class='table table-hover'>
            <thead>
              <tr>
                <th scope='col'><p class='text-center'>Topic ID</p></th>
                <th scope='col'><p class='text-center'>Topic Name</p></th>
                <th scope='col'><p class='text-center'>Topic Description</p></th>
                <th scope='col'><p class='text-center'>Action</p></th>
              </tr>
            </thead>
            <tbody>
                  <?php
                    if($stmt->rowCount()>0){
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
                    extract($row);
                  echo"

                  <tr>
                  <td><p class='text-center'>{$topicId}</p></td>
                  <td><p class='text-center'>{$topname}</p></td>
                  <td><p class='text-center'>{$topdesc}</p></td>
                  <td>";
                  if (!($tutor1->isAdded($topicId,$tutorId))){
                    echo "
                    <a class='btn btn-danger' href='addtopic3.php?tutorId={$tutorId}&subjId={$subjId}&topicId={$topicId}' role='button'>Add</a>";
                  }else{
                    echo "
                    </td>
                    </tr>
                  </tbody>
                  ";
                  }
                  
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


</body>

<script type="text/javascript">
  $(document).ready(function(){
    $('#edit').click(function(){
    if($('#subjname').prop('readonly'))
    {
     $('#subjname').removeAttr('readonly');
     $('#subjname').attr('required', 'required');

     $('#subjdesc').removeAttr('readonly');
     $('#subjdesc').attr('required', 'required');

     $('#edit').attr('hidden', 'hidden');

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

<?php
include_once '../footer.php';
?>