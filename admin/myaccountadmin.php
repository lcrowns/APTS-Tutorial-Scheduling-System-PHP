<?php
include_once 'headeradmin.php';
include_once '../config/connection.php';
include_once '../classes/account.php';


$userId= isset ($_GET ['userId']) ? $_GET['userId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->userId = $userId;
$account->readOneAccount();

if (isset($_POST['save'])){

	 	$account->email= $_POST['email'];
		$account->password= $_POST['password2'];
	
		
			if ($account->updateUser()){
			echo "<script type='text/javascript'>alert('Successfully Updated!'); location='myaccountadmin.php?userId={$userId}';</script>";
				}
				else {
						echo "<script type='text/javascript'>alert('Try Again!'); location='myaccountadmin.php?userId={$userId}';</script>";
				}
	}
?>

<body>
    <br> <br>
    <div class="container">
    <h1 style="margin-bottom: 0;">User Profile</h1>
    <a class="text-danger" href="homeadmin.php">[Back]</a>
    <br>
   <div class="card border-secondary mb-5" style="max-width: 90rem;">
      <form method="POST" action="myaccountadmin.php?userId=<?php echo $account->userId ?>" name="cpass">
        <div class="card-body text-dark">
        <div class="form-row">

          <div class="form-group col-md-6">
            <label for="inputEmail4">First Name</label>
            <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" value="<?php echo $account->fname?>" readonly>
          </div>

          <div class="form-group col-md-6">
            <label for="inputPassword4">Last Name</label>
            <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" value="<?php echo $account->lname?>" readonly>
          </div>
        </div>

        <div class="form-row" >
          <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" id="email" placeholder="First Name" name="email" value="<?php echo $account->email?>" readonly>
          </div>

          <div class="form-group col-md-6" id='tohide'>
            <label for="change">Password</label><br>
            <a class="btn btn-danger text-light" id="change" >Change Password</a>
          </div>
        </div>

        <div class="form-row" style="display: none;" id="toshow">

          <div class="form-group col-md-6" >
            
          </div>

          <div class="form-group col-md-6" >
            <label for="password1">Current Password</label>
            <input type="password" class="form-control" id="password1" placeholder="Password" name="password1" title="Must contain at least one number and one uppercase letter, and at least 8 or more characters" >
          </div>


          <div class="form-group col-md-6" >
            
          </div>

          <div class="form-group col-md-6">
            <label for="password2">New Password</label>
            <input type="password" class="form-control" id="password2" placeholder="New Password" name="password2" title="Must contain at least one number and one uppercase letter, and at least 8 or more characters" >
          </div>

          <div class="form-group col-md-6" >
            
          </div>

          <div class="form-group col-md-6">
            <label for="password3">Confirm New Password</label>
            <input type="password" class="form-control" id="password3" placeholder="Confirm New Password" name="password3" title="Must contain at least one number and one uppercase letter, and at least 8 or more characters"  >
          </div>
          
          <div class="form-group col-md-6" >
            
          </div>
          <div class="form-group col-md-6 text-right" >
            <button name="save" type="submit" class="btn btn-danger" onclick="return checkform();">Save</button>
            <a class="btn btn-secondary text-light" type='reset' id="cancel">Cancel</a>
          </div>
          
        </div>
          
        </div>


        



        
        
      </form>
      </div>
  </div>

  </body>

  <script type="text/javascript">
$(document).ready(function(){
    $('#change').click(function(){
     $('#change').toggle();
     $('#toshow').toggle();
     $('#tohide').toggle();
    });

    $('#cancel').click(function(){
     $('#change').toggle();
     $('#toshow').toggle();
     $('#tohide').toggle();

     document.getElementById('password1').value = "";
     document.getElementById('password2').value = "";
     document.getElementById('password3').value = "";
    });
});


function checkform() {
  var old = "<?php echo $account->password ?>";
    if(document.cpass.password1.value == ''|| document.cpass.password2.value == '' || document.cpass.password3.value == ''){
      alert("Please enter the fields required.");
      return false;
    }else if(old == document.cpass.password2.value) {
      alert("Your old password cannot be your new one.");
      return false;
    }else if(document.cpass.password2.value != document.cpass.password3.value){
      alert("The new passwords entered does not match.");
      return false;
    }else if(document.cpass.password1.value != old){
      alert("The old password entered is incorrect.");
      return false;
    } else {
        document.cpass.submit();
    }
}
  </script>



<?php
include_once '../footer.php';
?>