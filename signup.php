<?php
include_once'header.php';
include_once 'config/connection.php';
include_once 'classes/account.php';

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$stmt = $account->signup();

if(isset($_POST['register'])){
	$account = new Account($db);

	$account->fname = $_POST['fname'];
	$account->lname = $_POST['lname'];
	$account->contact = $_POST['contact'];
	$account->userType = $_POST['userType'];
	$account->status = $_POST['status'];
	$account->password = $_POST['password'];
	$account->email = $_POST['email'];
	$account->userId = $_POST['userId'];

	  if($account->signup()){
    echo "<script type='text/javascript'>alert('Successfully Registered!'); location='home.php';</script>";
  }
  else{
    echo "<script type='text/javascript'>alert('Try Again!');</script>";
  }

}

?>

<br>

<body>

    <br><br>
    <div class="container">

   <div class="card border-danger mb-5" style="max-width: 90rem;">
  <div class="card-header"><h1><p class="text-center">Registration</p></h1></div>
      <form method="POST" action="signup.php">
                <br>
                <div class="card-body text-dark">
        <div class="form-row">

          <div class="form-group col-md-6">
            <label for="inputEmail4">First Name *</font></label>
            <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" required>
          </div>

          <div class="form-group col-md-6">
            <label for="inputPassword4">Last Name *</font></label>
            <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Email *</font></label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid Email Please Enter Valid Email (eg. johndoe@email.com)" required>
          </div>

          <div class="form-group col-md-6">
            <label for="inputPassword4">Password *</font></label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCity">Mobile Phone Number *</font></label>
            <input type="Number" class="form-control" id="contact" placeholder="099999999" name="contact" required>
          </div>


          <div class="form-group col-md-6">
            <label for="inputCity">ID Number *</font></label>
            <input type="Number" class="form-control" id="userId" placeholder="20100000" name="userId" required>
          </div>
        </div>
        <p hidden>Account Status</p><input type="hidden" id="status" name="status" value="Active">
        <p hidden>Account Type</p><input type="hidden" id="userType" name="userType" value="Student">
        <br>
        <button name="register" type="submit" class="btn btn-danger">Register</button>
        <br><br>

        </div>
        
      </form>
  </div>

  </body>



<?php
include_once 'footer.php';
?>