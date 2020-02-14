<?php
include_once 'headeradmin.php';
include_once '../classes/subjects.php';
include_once '../classes/topic.php';
include_once '../config/connection.php';

$topicId= isset ($_GET ['topicId']) ? $_GET['topicId']: die('ERROR: missing ID.');


$topic = new Topic($db);
$topic->topicId = $topicId;
$topic->readOnetopic1();

$subject = new Subject($db);
$subject->readOneSubj();
$subjId = $subject->subjId; 


 if(isset($_POST['save'])) {
 	$topic = new Topic($db);

    $topic->topname=  $_POST['topname'];
    $topic->topdesc=  $_POST['topdesc'];
    $topic->topstatus=  $_POST['topstatus'];

    $topic->topicId= $topicId;

    if ($topic->updatetopic()){
      echo "<script type='text/javascript'>alert('Topic Successfully Updated!'); location='edittopic.php?topicId={$topicId}';</script>";
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
      <form method="POST" action="edittopic.php?topicId=<?php echo $topic->topicId;?>">
                <br>
                <div class="card-body text-dark">
                	<br>

                	<div class="form-row">
          <div class="form-group col-md-12">
            <label for="inputEmail4">Topic *</label>
            <input type="text" class="form-control" id="topname" name="topname" value = "<?php echo $topic->topname ?>" readonly="readonly" required>
          </div>
      </div>
<div class="form-row">
          <div class="form-group col-md-12">
            <label for="inputPassword4">Topic Description *</font></label>
            <input type="text" class="form-control" id="topdesc" name="topdesc" value = "<?php echo $topic->topdesc ?>" readonly="readonly" required>
          </div>

          <div class="form-row">
          	    <div class="col-sm">
      <label>Topic Status</label>
      <select class="form-control" name="topstatus" id="topstatus" value = "<?php echo $topic->topstatus; ?>" readonly="readonly" required="" disabled>
                     <option selected readonly><?php echo $topic->topstatus; ?></option>
                     <option disabled="true"> </option>
                     <option disabled="true">-Choose below to change topic status-</option>
                      <option>Active</option>
                      <option>Inactive</option>
                  </select>
    </div>
          </div>

        </div>


        <div class="form-row text-right">
            <div class="form-group col-md-12">
              <div id="editTools" style="display: none;">
              <button name="save" type="submit" class="btn btn-danger">Save</button>
              <a class="btn btn-secondary" href="edittopic.php?topicId=<?php echo $topicId;?>" role="button">Cancel</a>
              </div>
              <input type="button" class="btn btn-danger" value="Edit" name="edit" id="edit">
            </div>
          </div>






                	</div>
                </form>
            </div>
        </div>
    </body>

<script type="text/javascript">
  $(document).ready(function(){
    $('#edit').click(function(){
    if($('#topname').prop('readonly'))
    {
     $('#topname').removeAttr('readonly');

     $('#topdesc').removeAttr('readonly');

     $('#topstatus').removeAttr('readonly');
     $('#topstatus').removeAttr('disabled');

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
