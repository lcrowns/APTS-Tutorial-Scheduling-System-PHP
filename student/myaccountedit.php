<?php
include_once 'headerstudent.php';
include_once '../config/connection.php';
include_once '../classes/account.php';


$userId= isset ($_GET ['userId']) ? $_GET['userId']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->userId = $userId;
$account->readOneAccount();

if (isset($_POST['Save'])){
    $account = new Account($db);
    
    $account->fname=$_POST['fname'];
    $account->lname=$_POST['lname'];
    $account->contact=$_POST['contact'];
    $account->password= $_POST['password'];
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

<body style="background-color:white;">

    <br><br>
    <div class="container">

   <div class="card border-secondary mb-5" style="max-width: 90rem;">
  <div class="card-header"><h1><p class="text-center">My Account</p></h1></div>
      <form method="POST" action="myaccountedit.php?userId=<?php echo $account->userId ?>">
                <br>
                <div class="card-body text-dark">
        <div class="form-row">

          <div class="form-group col-md-6">
            <label for="inputEmail4">First Name</font></label>
            <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" value="<?php echo $account->fname?>" readonly>
          </div>

          <div class="form-group col-md-6">
            <label for="inputPassword4">Last Name</font></label>
            <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" value="<?php echo $account->lname?>">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Email</font></label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid Email Please Enter Valid Email (eg. johndoe@email.com)" value="<?php echo $account->email?>" readonly>
          </div>

          <div class="form-group col-md-6">
            <label for="inputPassword4">Password</font></label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?php echo $account->password?>" readonly>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
           <label for="inputCity">Mobile Phone Number *</font></label>
            <input type="Number" class="form-control"  name="contact" value="<?php echo $account->contact?>"required >
          </div>

          <input type="hidden" class="form-control" id="inputStatus" name="status" value="<?php echo $account->status?>" readonly>

          <input type="hidden" class="form-control" id="inputStatus" name="usertype" value="<?php echo $account->usertype?>" readonly>

          <div class="form-group col-md-6">
            <label for="inputCity">ID Number</font></label>
            <input type="Number" class="form-control" id="userId" placeholder="20100000" name="userId" value="<?php echo $account->userId?>" readonly>
          </div>
        </div>

        <div class="form-row text-right">
          <div class="form-group col-md-12">
            <button name="Save" type="submit" class="btn btn-danger">Save</button>
            <a href="myaccount.php?userId=<?php echo $account->userId ?>" class="btn btn-secondary">Cancel</a>
          </div>
        </div>
        
        

        </div>
        
      </form>
  </div>

  </body>



<?php
include_once '../footer.php';
?>