<?php
include_once 'header.php';
include_once 'classes/account.php';
include_once 'config/connection.php';

date_default_timezone_set('Asia/Manila');

$email= isset ($_GET ['email']) ? $_GET['email']: die('ERROR: missing ID.');
$key= isset ($_GET ['key']) ? $_GET['key']: die('ERROR: missing ID.');
$action= isset ($_GET ['action']) ? $_GET['action']: die('ERROR: missing ID.');

$database = new Database();
$db = $database->getConnection();

$curDate = date("Y-m-d H:i:s");

$account = new Account($db);
$stmt = $account->getkeyexp($key);

if ($stmt->rowCount()<1){
  echo "<script type='text/javascript'>alert('This link is expired and is no longer useable'); location='login.php';</script>";
}

while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
extract($row);

if ($expDate <=$curDate){
  $account->deletekey($curDate);
  echo "<script type='text/javascript'>alert('This link is expired and is no longer useable'); location='login.php';</script>";
}

}



$account->email = $email;
$account->readoneaccount2();

if (isset($_POST['save'])){

    $account->password= $_POST['password2'];
    
      if ($account->updateUser()){
      echo "<script type='text/javascript'>alert('Successfully Updated!'); location='login.php';</script>";
        }
        else {
            echo "<script type='text/javascript'>alert('Try Again!'); location='login.php';</script>";
        }
  }
?>


<body>
    <br> <br>
    <div class="container">
    <h1 style="margin-bottom: 0;">Reset Password: </h1>
    <h4 class="text-danger" style="margin: 0;"><?php echo $account->fname." ".$account->lname?></h4>
    <br>
   <div class="card border-secondary mb-5" style="max-width: 90rem;">
      <form method="POST" action="reset-password.php?key=<?php echo $key ?>&email=<?php echo $email ?>&action=<?php echo $key ?>" name="cpass">
        <div class="card-body text-dark">
  

        <div class="form-row" id="toshow">

          <input type="hidden" class="form-control" id="password1" name="password1" value="<?php echo $account->password?>" readonly>

          <div class="form-group col-md-4" >
            
          </div>

          <div class="form-group col-md-4">
            <label for="password2">New Password</label>
            <input type="password" class="form-control" id="password2" placeholder="New Password" name="password2" title="Must contain at least one number and one uppercase letter, and at least 8 or more characters" >
          </div>

          <div class="form-group col-md-4" >
            
          </div>
          <div class="form-group col-md-4" >
            
          </div>

          <div class="form-group col-md-4">
            <label for="password3">Confirm New Password</label>
            <input type="password" class="form-control" id="password3" placeholder="Confirm New Password" name="password3" title="Must contain at least one number and one uppercase letter, and at least 8 or more characters"  >
          </div>
          
          <div class="form-group col-md-4" >
            
          </div>
          <div class="form-group col-md-4" >
            
          </div>
          <div class="form-group col-md-4 text-right" >
            <button name="save" type="submit" class="btn btn-danger" onclick="return checkform();">Save</button>
          </div>
          
        </div>
          
        </div>
        
        
      </form>
      </div>
  </div>

  </body>

  <script type="text/javascript">
    
 function checkform() {
  var old = "<?php echo $account->password ?>";
    if(document.cpass.password2.value == '' || document.cpass.password3.value == ''){
      alert("Please enter the fields required.");
      return false;
    }else if(old == document.cpass.password2.value) {
      alert("Your old password cannot be your new one.");
      return false;
    }else if(document.cpass.password2.value != document.cpass.password3.value){
      alert("The new passwords entered does not match.");
      return false;
    } else {
        document.cpass.submit();
    }
}
  </script>