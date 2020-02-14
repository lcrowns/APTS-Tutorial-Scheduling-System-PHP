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

$tutor = new Tutor($db);


if (isset($_POST['save'])){
    $account->readOneAccount();

    $account->fname=$_POST['fname'];
    $account->lname=$_POST['lname'];
    $account->contact=$_POST['contact'];
    if($_POST['password2']!= ''){
      $account->password= $_POST['password2'];
      if($account->firstLogin== 1){
      $account->firstLogin= 0;
      }
    }
    $account->status = $_POST['status'];
    $account->usertype = $_POST['usertype'];
    $account->email = $_POST['email'];
    
    $account->userId = $userId;
    
      if ($account->updateUser()){
      echo "<script type='text/javascript'>alert('Successfully Updated!'); location='myaccount.php?userId=$userId';</script>";
        }
        else {
            echo "<script type='text/javascript'>alert('Try Again!'); location='myaccount.php?userId=$userId';</script>";
        }
  }

?>

<body>
    <br>
    <div class="container">
      <h1 style="margin-bottom: 0;">Student Profile</h1>
    <a class="text-danger" href="homestudent.php">[Back]</a>
    
    <br><br>

   <div class="card border-secondary mb-5" style="max-width: 90rem;">
    <form method="POST" action="myaccount.php?userId=<?php echo $account->userId ?>">
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

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" title="Invalid Email Please Enter Valid Email (eg. johndoe@email.com)" value="<?php echo $account->email?>" readonly>
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
            <a class="btn btn-secondary text-light" role='button' id="cancel">Cancel</a>
          </div>
          
        </div>


        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCity">Mobile Phone Number</label>
            <input type="text" class="form-control" id="contact" placeholder="099999999" name="contact" value="<?php echo $account->contact?>" readonly>
          </div>

          
          <div class="form-group col-md-6">
            <label for="inputCity">ID Number</label>
            <input type="text" class="form-control" id="userId" placeholder="20100000" name="userId" value="<?php echo $account->userId?>" readonly>
          </div>
        </div>
        <form method="POST" action="myaccount.php?userId=<?php echo $account->userId ?>">

        <input type='hidden' name='userId' id='userId' class='hiddenElement' value="<?php echo $userId ?>"/>
        <input type='hidden' name='status' id='status' class='hiddenElement' value="<?php echo $account->status ?>"/>
        <input type='hidden' name='usertype' id='usertype' class='hiddenElement' value="Student"/>

        <div class="form-row text-right">
            <div class="form-group col-md-12">
              <div id="editTools" style="display: none;">
              <button name="save" type="submit" class="btn btn-danger">Save</button>
              <a class="btn btn-secondary" href="myaccount.php?userId=<?php echo $userId;?>" role="button">Cancel</a>
              </div>
              <input type="button" class="btn btn-danger" value="Edit" name="edit" id="edit">
            </div>
          </div>
          <div class="form-row text-right">
            <div class="form-group col-md-12">
          </div>
        </div>
        </div></form>
        
  </div>

  <?php
    if($account->ifTutor()){
      include_once 'mytutorprofile.php';
    } 
  ?>

  </body>

<script>

   $(document).ready(function(){
    $('#edit').click(function(){
    if($('#email').prop('readonly'))
    {

     $('#email').removeAttr('readonly');
     $('#email').attr('required', 'required');

     $('#contact').removeAttr('readonly');
     $('#contact').attr('required', 'required');

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

   function confirmation(){
     var result = confirm("Are you sure you want to proceed?")
  }

  $(document).ready(function(){
    var x = document.getElementById("editTools");
    $('#change').click(function(){
     $('#change').toggle();
     $('#toshow').toggle();
     $('#tohide').toggle();
     $('#edit').toggle();
     x.style.display = "none";

     $('#email').attr('readonly', 'readonly');
     $('#contact').attr('readonly', 'readonly');

     $('#password1').attr('required', 'required');
     $('#password2').attr('required', 'required');
     $('#password3').attr('required', 'required');
    });

    $('#cancel').click(function(){
     $('#change').toggle();
     $('#toshow').toggle();
     $('#tohide').toggle();
     $('#edit').toggle();

     $('#password1').removeAttr('required');
     $('#password2').removeAttr('required');
     $('#password3').removeAttr('required');

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