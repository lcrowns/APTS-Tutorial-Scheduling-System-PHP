<?php
include_once 'headerstudent.php';
include_once '../config/connection.php';
include_once '../classes/tutor.php';
include_once '../classes/subjects.php';
include_once '../classes/topic.php';
include_once '../classes/tutorial.php';

$tutorId= isset ($_GET ['tutorId']) ? $_GET['tutorId']: die('ERROR: missing ID.');
$tuteeId= isset ($_GET ['tuteeId']) ? $_GET['tuteeId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$tutee = new Account($db);
$tutee->userId = $tuteeId;
$tutee->readOneAccount();

$tutor = new Tutor($db);
$tutor->userId = $tutorId;
$tutor->viewonetutor2($tutorId);

$tutorUser = $tutor->userId;

$topics = $tutor->viewTutorTopicAct();
$dates = $tutor->viewTutorAvail();
$stmt2 = $tutor->viewTutorAvail();

if($_POST){
	$prnt = date("l", strtotime($_POST['date']));

	if($tutor->checkTimeDay($prnt,$_POST['time'],$tutorUser)){
		
    	$parts = explode("-", $_POST['time']);
    	$one = substr($parts[0], 0, -3);
    	$date = DateTime::createFromFormat( 'H:i', $one);
    	$formatted = $date->format( 'H:i');

      $datein = $_POST['date'];
      $timein = $one;

      $selectedDate = date( 'Y-m-d H:i', strtotime("$datein $timein"));
      #$datenow = date('Y-m-d H:i' );

		$timestamp = time()  + 60*60;
		$timenow = date('Y-m-d H:i', $timestamp);

		if($selectedDate>=$timenow){
			$tutorial = new Tutorial($db);
		
			$tutorial->tutor=$tutor->fname." ".$tutor->lname;
    		$tutorial->tutee=$tutee->fname." ".$tutee->lname;
    		$tutorial->topic=$_POST['topic'];
    		$tutorial->date = $_POST['date'];
    		$tutorial->time = $_POST['time'];
    		$tutorial->tListStatus = $_POST['tListStatus'];

    		if($tutorial->addTutorial()){
    			echo "<script type='text/javascript'>alert('Request sent succesfully!'); location='homestudent.php';</script>";
  			}
  			else{
    			echo "<script type='text/javascript'>alert('Try Again!');</script>";
  			}
		}
		else{
			echo "<script type='text/javascript'>alert('The request must be set at least one hour before the desired schedule time!');</script>";
		}
	}else{
		
		echo "<script type='text/javascript'>alert('The tutor is not available on $prnt at the selected time. Please refer to the Day/Time Table for more info.');</script>";
	}
}

?>
<body>
<br><br>
	<div class="container">
    	<h1 class="float-left" style="margin-bottom: 0;">Request Tutorial</h1>

      	<div style="clear: both;"></div>
      	<a class="text-danger float-left" href="viewonetutor.php?tutorId=<?php echo $tutorId ?>&tuteeId=<?php echo $tuteeId ?>">[Back]</a>
      	<div style="clear: both;"></div>
      	<br>
   		<div class="card border-secondary mb-5" style="max-width: 90rem;">
      		<form method="POST" action="requesttutorial.php?tutorId=<?php echo $tutorId ?>&tuteeId=<?php echo $tuteeId ?>">
        		<div class="card-body text-dark">
        			<div class="form-row">
          				<div class="form-group col-md-6">
            				<label for="inputEmail4">Tutor</label>
            				<input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" value="<?php echo $tutor->fname." ".$tutor->lname ?>" readonly>
          				</div>

          				<div class="form-group col-md-6">
            				<label for="inputPassword4">Tutee</label>
            				<input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" value="<?php echo $tutee->fname." ".$tutee->lname ?>" readonly>
          				</div>
        			</div>

        			<div class="form-row">
          				<div class="form-group col-md-12">
            				<label>Choose a Topic</label>
      						<select class="form-control" name="topic" id="topic" value = "<?php echo $topic->topstatus; ?>" required="">
                     			<option value="" selected disabled="">Choose a Topic</option>
                     			<?php 
                     				if(($topics->rowCount())>0){
  										while ($row = $topics->fetch(PDO::FETCH_ASSOC)){
											extract($row);
											echo "<option value='{$topname}'>{$topname}</option>";
										}
									}else{
											echo "<option disabled='true'>No Topics Available</option>
											";
									}
                      			?>
                  			</select>
         				 </div>
        			</div>

        			<div class="form-row">
          				<div class="form-group col-md-6">
            				<label for="inputEmail4">Date</label>
            				<input type="date" class="form-control" onchange="checkDate(); " id="date" name="date" min="<?php echo date('m/d/Y'); ?>" required>
          				</div>

          				<div class="form-group col-md-6">
            				<label>Time</label>
      						<select class="form-control" name="time" id="time" required="">
      							<option value="" selected disabled="">Select Time</option>
      							<?php 
                     				if(($dates->rowCount())>0){
  										while ($row = $dates->fetch(PDO::FETCH_ASSOC)){
											extract($row);
											echo "<option>{$TimeAvail}</option>";
										}
									}else{
											echo "<option disabled='true'>No Time Available</option>
											";
									}
                      			?>
                  			</select>
          				</div>
          				<p hidden>Tutorial Status</p><input type="hidden" id="tListStatus" name="tListStatus" value="Pending">
        			</div>

        			<div class="form-row">
        				<div class="form-group col-md-12">
          					<div class="float-right">          
            					<button name="save" type="submit" class="btn btn-danger">Save</button>
              					<a class="btn btn-secondary" href="requesttutorial.php?tutorId=<?php echo $tutorId?>&tuteeId=<?php echo $tuteeId?>" role="button">Cancel</a>
         					 </div>
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
 function checkDate() {
   var selectedText = document.getElementById('date').value;
   var selectedDate = new Date(selectedText);
   var now = new Date();
   now.setDate(now.getDate()-1);
   if (selectedDate < now) {
    alert("Date cannot be set in the past.");
    document.getElementById('date').value = null;
   }
 }




</script>
<?php
include_once '../footer.php';
?>