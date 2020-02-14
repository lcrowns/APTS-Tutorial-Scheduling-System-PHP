<?php
include_once 'headerstudent.php';
include_once '../classes/subjects.php';
include_once '../classes/topic.php';
include_once '../config/connection.php';

$subjId= isset ($_GET ['subjId']) ? $_GET['subjId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->userId = $userId;
$account->readOneAccount();

$subject = new Subject($db);
$subject->subjId = $subjId;
$subject->readOneSubj();
$stmt = $subject->readOneTopicAct();

$topic = new Topic($db);


$fname = $subject->adfname;
$lname = $subject->adlname;

$fname1 = $account->fname;
$lname1 = $account->lname;

?>

<style>
    tbody tr:hover{cursor:pointer;}
</style>

<body >

  <div class="container">
    <h1 style="margin-bottom: 0;">Subject Details</h1>
    <a class="text-danger" href="subjects.php">[Back]</a>
    <br>
    <div class="card border-secondary mb-5" style="max-width: 90rem; margin-top: 10px;">
      <form method="POST" action="viewonesubj.php?subjId=<?php echo $subject->subjId;?>">
        <div class="card-body text-dark">

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputEmail4">Subject Code</font></label>
              <input type="text" class="form-control" id="subjname" placeholder="ITOASM1" name="subjname" value = "<?php echo $subject->subjname ?>" readonly="readonly">
            </div>
            <div class="form-group col-md-8">
              <label for="inputPassword4">Subject Description</font></label>
              <input type="text" class="form-control" id="subjdesc" placeholder="Description of the Subject" name="subjdesc" value = "<?php echo $subject->subjdesc ?>"readonly="readonly">
            </div>
          </div>
        
          <p hidden>Subject Status</p><input type="hidden" id="subjstat" name="subjstat" value="Active">
          

        </div>
      </div>
    </form>
  </div>
</div>

  <div class="container">
    <h3 class="float-left" style="margin-bottom: 0;"><?php echo $subject->subjname ?> Topics</h3>
    <div style="clear: both;"></div>
    <form method="POST"> 
      <div class="form-row">
          <div class="form-group col-md-12 input-group">
          <input type='text' class='form-control' id='search' name='search' placeholder='Search here' required>
          <?php if($_POST){
          echo '<a class="btn btn-secondary" href="viewonesubj.php?subjId=';echo $subject->subjId; echo'">Reset</a>' ;
        
          }else{
            echo '<input class="btn text-dark" type="submit" value="Search" style="background-color: lightgray;">';
          }?>
          </div>
        </div>
    <div class="card border-secondary mb-5" style="max-width: 90rem;">
      
      <div class="form-row">
        
        <div class="form-group col-md-12">
          

          <table class='table table-hover'>
            <thead>
              <tr>
                <th scope='col'><p class='text-center'>Topic Name</p></th>
                <th scope='col'><p class='text-center'>Topic Description</p></th>
              </tr>
            </thead>
            <tbody>
                <?php
                  if(isset($_POST['search'])){
                  $srch = $topic->searchTopic($_POST['search'],$subjId);
                  if($srch->rowCount()>0){
                  while($row = $srch->fetch(PDO::FETCH_ASSOC)){ 
                  extract($row);
                  echo"

                  <tr onclick=\"window.location='viewonetopic.php?topicId={$topicId}';\">
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
                      <td class='text-center' colspan='2'>Nothing to show.</td>
                    </tr>
                    ";
                  }
                  }
                  elseif($stmt->rowCount()>0){
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
                    extract($row);
                  echo"

                  <tr onclick=\"window.location='viewonetopic.php?topicId={$topicId}';\">
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
                      <td class='text-center' colspan='2'>Nothing to show.</td>
                    </tr>
                    ";
                  }
                ?>
            </tbody>
          </table>
        </div>
        
        </div>
      </form>
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