<?php
include_once 'headeradmin.php';
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
$stmt = $subject->readOneTopic();

$topic = new Topic($db);


  if(isset($_POST['Save'])) {
    $subject = new Subject($db);
    $subject->subjId = $subjId;
    $subject->readOneSubj();
    $subject->subjname=  $_POST['subjname'];
    $subject->subjdesc=  $_POST['subjdesc'];
    $subject->subjstat=  $_POST['subjstat'];

    if ($subject->updateSubj()){
      echo "<script type='text/javascript'>alert('Subject Successfully Updated!'); location='viewonesubj.php?subjId={$subjId}';</script>";
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

  if(isset($_POST['deactivate'])) {
    $subject = new Subject($db);
    $subject->subjId = $subjId;
    $subject->readOneSubj();
    $subject->subjstat= 'Inactive';

    if ($subject->updateSubj()){
      echo "<script type='text/javascript'>alert('Subject Successfully Updated!'); location='viewonesubj.php?subjId={$subjId}';</script>";
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
    $subject = new Subject($db);
    $subject->subjId = $subjId;
    $subject->readOneSubj();
    $subject->subjstat= 'Active';

    if ($subject->updateSubj()){
      echo "<script type='text/javascript'>alert('Subject Successfully Updated!'); location='viewonesubj.php?subjId={$subjId}';</script>";
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
    $subject = new Subject($db);
    $subject->subjId = $subjId;

    $topic1 = new Topic($db);
    $id = $topic1->getTopicId($subjId);
    $topic1->topicId = $id;

    $topic = new Topic($db);
    $topic->subjId = $subjId;
    
    $topic1->deleteTopThot();
    $topic->deleteTop();

    if ($subject->deleteSubj()){
      echo "<script type='text/javascript'>alert('Subject Successfully Deleted!'); location='subjects.php';</script>";
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


  if(isset($_POST['search'])) {
    echo "<script type='text/javascript'>location='viewonesubj.php?subjId={$subjId}#Search';</script>";
  }

  if(isset($_POST['remove'])) {
    echo "<script type='text/javascript'>location='viewonesubj.php?subjId={$subjId}#Search';</script>";
  }
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
            <div class="form-group col-md-6">
              <label for="inputEmail4">Subject Code</font></label>
              <input type="text" class="form-control" id="subjname" placeholder="ITOASM1" name="subjname" value = "<?php echo $subject->subjname ?>" readonly="readonly">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Subject Status</font></label>
              <input type="text" class="form-control" id="subjstat" placeholder="Description of the Subject" name="subjstat" value = "<?php echo $subject->subjstat ?>"readonly>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="inputPassword4">Subject Description</font></label>
              <input type="text" class="form-control" id="subjdesc" placeholder="Description of the Subject" name="subjdesc" value = "<?php echo $subject->subjdesc ?>"readonly="readonly">
            </div>
          </div>

          <div class="form-row">
            

          </div>
        
          

          
          <div class="form-row text-right">
            <div class="form-group col-md-12">
              <div id="editTools" style="display: none;">
              <button name="Save" type="submit" class="btn btn-danger">Save</button>
              <a class="btn btn-secondary" href="viewonesubj.php?subjId=<?php echo $subject->subjId;?>" role="button">Cancel</a>
              </div>
              <input type="button" class="btn btn-danger" value="Edit" name="edit" id="edit">
            </div>
          </div>

          <div class="form-row text-right">
            <div class="form-group col-md-12">
              <?php  if($subject->subjstat == 'Active'){
                echo '<button id="deactivate" name="deactivate" type="submit" class="btn btn-danger">Deactivate</button>';
              }else if($subject->subjstat == 'Inactive'){
                echo '<button id="activate" name="activate" type="submit" class="btn btn-danger">Activate</button>';
              }
              ?>
              <button id="delete" name="delete" onclick="return confirm('Delete subject?\nAll the topics under this subject will be deleted.\nAll the topics assigned to tutors under this subject will be removed.'); " type="submit" class="btn btn-secondary">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

  <div class="container">
    <h3 class="float-left" style="margin-bottom: 0;"><?php echo $subject->subjname ?> Topics</h3>
      <?php if($subject->subjstat == 'Active'){
        echo "<button type='button' class='btn btn-danger float-right' data-toggle='modal' data-target='#addtopicmodal' style='margin: 5px; margin-top: 10px; margin-right:0;'>Add Topic</button>";
      } ?>
      <div style="clear: both; margin-bottom: 5px;"></div>
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
          
          <table class='table table-hover' id="Searchh">
            <thead>
              <tr>
                <th scope='col'><p class='text-center'>Topic Name</p></th>
                <th scope='col'><p class='text-center'>Topic Description</p></th>
                <th scope='col'><p class='text-center'>Status</p></th>
                <th scope='col'><p class='text-center'>Action</p></th>
              </tr>
            </thead>
            <tbody id="Search">
                  <?php
                  if(isset($_POST['search'])){
                    $srch = $topic->searchTopic($_POST['search'],$subjId);
                    if($srch->rowCount()>0){
                   
                    while($row=$srch->fetch(PDO::FETCH_ASSOC)){
                    
                    extract($row);
                    echo"

                  <tr onclick=\"window.location='viewonetopic.php?topicId={$topicId}';\">
                  <td><p class='text-center'>{$topname}</p></td>
                  <td><p class='text-center'>{$topdesc}</p></td>
                  <td><p class='text-center'>{$topstatus}</p></td>
                  <td></td>
                  </tr>
                  </tbody>
                  ";
                    }
                  }else
                  echo 
                    "
                    <tr>
                      <td class='text-center' colspan='4'>Nothing to show.</td>
                    </tr>
                    ";
                }

                  elseif($stmt->rowCount()>0){
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
                    extract($row);
                  echo"

                  <tr onclick=\"window.location='viewonetopic.php?topicId={$topicId}';\">
                  <td><p class='text-center'>{$topname}</p></td>
                  <td><p class='text-center'>{$topdesc}</p></td>
                  <td><p class='text-center'>{$topstatus}</p></td>
                  <td class='text-center'>
                    <div class='text-center' style='margin:0; padding: 5px 0;'>";
                    if($topstatus == 'Active'){
                      echo "<a href='changetopstat.php?topstatus={$topstatus}&topicId={$topicId}' class='btn btn-danger'>Deactivate</a>";
                    }else{
                      echo "<a href='changetopstat.php?topstatus={$topstatus}&topicId={$topicId}' class='btn btn-danger'>Activate</a>";
                    }
                    echo " <a href='deletetopic.php?topicId={$topicId}' class='btn btn-secondary' onclick='event.stopPropagation(); return confirm(\"Delete Topic?\\nAll the students assigned with this topic will lose the potential to teach it.\"); '>Delete</a>
                    </div>
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
  </form>
  </div>

  <?php
      include_once 'addtopic.php';
  ?>
      <div id='topictbl'>
                  <div class="modal fade" id="addtopicmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <div class="modal-header">
            <h5 class="modal-title">Add Topic</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>

          <form method="POST" id="addtopicform" action="viewonesubj.php?subjId=<?php echo $subject->subjId;?>">
            <div class="modal-body">
              <table class='table table-hover table-bordered'>
                <tr>
                  <th>Topic</th>
                  <td><input type="text" class="form-control" name="topname"></td>
                </tr>
                <tr>
                  <th>Topic Description</th>
                  <td><input type="text" class="form-control" name="topdesc"></td>
                </tr>
                <input type='hidden' name='subjId' id='subjId' class='hiddenElement' value="<?php echo $subject->subjId ?>"/>
                <input type='hidden' name='topstatus' id='topstatus' class='hiddenElement' value="Active"/>
                <input type='hidden' name='topicId' id='topicId' class='hiddenElement'/>
              </table>
            </div>
            
            <div class="modal-footer">
              <input type='submit' class='btn btn-danger' name='add' id='add' value='Add'>
              <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
            </div>



          </form>
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

<?php
include_once '../footer.php';
?>