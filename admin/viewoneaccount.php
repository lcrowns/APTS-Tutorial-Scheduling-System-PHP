<?php
include_once 'headeradmin.php';
include_once '../config/connection.php';
include_once '../classes/account.php';

$userId= isset ($_GET ['userId']) ? $_GET['userId']: die('ERROR: missing ID.');
$loc= isset ($_GET ['loc']) ? $_GET['loc']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();



$account = new Account($db);
$account->userId = $userId;
$account->readOneAccount();


if(isset($_POST['save'])) {

  $account = new Account($db);
    
    $account->fname=$_POST['fname'];
    $account->lname=$_POST['lname'];
    $account->contact=$_POST['contact'];
    $account->password= $_POST['password'];
    $account->status = $_POST['status'];
    $account->usertype = $_POST['usertype'];
    $account->email = $_POST['email'];
    
    $account->userId = $userId;

    $loc = $_POST['loc'];
    
      if ($account->updateUser()){
      echo "<script type='text/javascript'>alert('Successfully Updated!'); location='viewoneaccount.php?userId={$userId}&loc=$loc';</script>";
      }
        else {
            echo "<script type='text/javascript'>alert('Try Again!'); location='viewoneaccount.php?userId={$userId}&loc={$loc}';</script>";
        }
  }

if(isset($_POST['deactivate'])) {

  $account->status=  'Inactive';

    if ($account->updateUser()){
      echo "<script type='text/javascript'>alert('User Successfully Updated!'); location='viewoneaccount.php?userId={$userId}&loc={$loc}';</script>";
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

  $account->status=  'Active';

    if ($account->updateUser()){
      echo "<script type='text/javascript'>alert('User Successfully Updated!'); location='viewoneaccount.php?userId=$userId&loc=$loc';</script>";
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
  <br>
  <div class="container">
    <h1 style="margin-bottom: 0;"><?php echo $account->usertype; ?> Profile</h1>
    <?php if ($account->usertype =='Student'){
      echo '<a class="text-danger" href="tutees.php">[Back]</a>';
    }else{
      echo '<a class="text-danger" href="admins.php">[Back]</a>';
    }?>
   <div class="card" style="max-width: 90rem; margin-top: 10px;">
      <form method="POST" action="viewoneaccount.php?userId=<?php echo $userId ?>&loc=<?php echo $loc ?>">
                <div class="card-body text-dark">
        <div class="form-row">
          <?php if ($account->usertype =='Admin'){
            echo '<!--';
          }?>
          <div class="form-group col-md-4">
            <label for="inputCity">ID Number</label>
            <input type="text" class="form-control" id="userId" placeholder="20100000" name="userId" value="<?php echo $account->userId ?>" readonly>
          </div>
          <?php if ($account->usertype =='Admin'){
            echo '-->';
          }?>
          <div class="form-group col-md-4">
            <label for="inputEmail4">First Name</label>
            <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" value="<?php echo $account->fname ?>" readonly>
          </div>

          <div class="form-group col-md-4">
            <label for="inputPassword4">Last Name</label>
            <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" value="<?php echo $account->lname ?>" readonly>
          </div>
          
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" title="Invalid Email Please Enter Valid Email (eg. johndoe@email.com)" value="<?php echo $account->email ?>" readonly>
          </div>
          <?php if ($account->usertype =='Admin'){
            echo '<!--';
          }?>
          <div class="form-group col-md-4">
            <label for="inputCity">Mobile Phone Number</label>
            <input type="text" class="form-control" id="contact" placeholder="099999999" name="contact" value="<?php echo $account->contact ?>" readonly>
          </div>
          <?php if ($account->usertype =='Admin'){
            echo '-->';
          }?>
            <input type="hidden" class="form-control" id="usertype" placeholder="Student" name="usertype" value="<?php echo $account->usertype ?>" readonly>

          <input type="hidden" class="form-control" id="inputPassword" name="password" value="<?php echo $account->password?>" readonly>
          <input type="hidden" class="form-control" id="loc" placeholder="Student" name="loc" value="<?php echo $loc ?>" readonly>
            <div class="form-group col-md-4">
              <label for="inputCity">Status</label>
              <input type="text" class="form-control" id="status" placeholder="099999999" name="status" value="<?php echo $account->status ?>" readonly>
            </div>
          </div>
          <?php if ($account->usertype =='Admin'){
            echo '<!--';
          }?>
      <div class="form-row" style="display: none;">
        <div class="form-group col-md-12">
          <div class="float-right">    
            <div id="editTools" style="display: none;">      
            <button name="save" type="submit" class="btn btn-danger">Save</button>
            <a class="btn btn-secondary" href="viewoneaccount.php?userId=<?php echo $userId;?>&loc=<?php echo $loc;?>" role="button">Cancel</a>
            </div>
            <input type="button" class="btn btn-danger" value="Edit" name="edit" id="edit">
          </div>
        </div>

      </div>
      <?php if ($account->usertype =='Admin'){
            echo '-->';
          }?>

       <div class="form-row text-right">
            <div class="form-group col-md-12">
              <?php  if($account->status == 'Active'){
                echo '<button name="deactivate" type="submit" class="btn btn-danger">Deactivate</button>';
              }else if($account->status == 'Inactive'){
                echo '<button name="activate" type="submit" class="btn btn-danger">Activate</button>';
              }
              ?>
              <a href='deleteaccount.php?userId=<?php echo $userId ?>&loc=$loc=<?php echo $userId ?>' class='btn btn-secondary' onclick=' return confirm("Are you sure?"); '>Delete</a>
            </div>
          </div>
        

        </div>
        
      </form>
  </div>
</body>
<script type="text/javascript">
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
</script>