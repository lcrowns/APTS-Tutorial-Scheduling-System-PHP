<?php
include_once 'header.php';
include_once 'classes/account.php';
include_once 'config/connection.php';
include_once 'config/databaseconn.php';

$database = new Database();
$db = $database->getConnection();

date_default_timezone_set('Asia/Manila');

$datenow = date('Y-m-d H:i' );
$futureDate=date('Y-m-d', strtotime('+1 year'));

$account = new Account($db);

if(isset($_SESSION['type'])){
    header('Location: login.php');
  }

  $message = ' ';
   $error = ' ';

  if(isset($_POST['login'])){

    if(empty($_POST['userId']) || empty($_POST['password'])){
      $message = "<div class='alert alert-danger'><strong>Please fill in the required fields!</strong></div>";
    }
    else{
      
      if($_POST)
        $query = "SELECT * FROM accounts WHERE userId = :userId AND password = :password";
      $stmt = $connect->prepare($query);
      $stmt->execute(array('userId' => $_POST['userId'], 'password' => $_POST['password']));
      $count = $stmt->rowCount();

     if($count > 0){

      $r = $stmt->fetch(PDO::FETCH_ASSOC);
      if($r){

        $usertype = $r['usertype'];
        $status = $r['status'];
        $_SESSION['userId'] = $r['userId'];
        $_SESSION['password'] = $r['password'];

        
        $account = new Account($db);
        $account->userId =  $r['userId'];
        $account->readOneAccount();

        $account->lastLogin= $datenow;
        $account->expDate = $futureDate;
        $account->updateUser();

        if($status == 'Active'){
          if($usertype == 'Student'){
            if($account->firstLogin == 1){
              echo "<script type='text/javascript'>alert('Hello {$account->fname}! You are required to change your password.');window.location='student/myaccount.php?userId=$account->userId'</script>";
            }else{
              echo "<script type='text/javascript'>window.location='student/homestudent.php'</script>";
            }
        }
        elseif($usertype == 'Admin'){
          if($account->firstLogin == 1){
            echo "<script type='text/javascript'>alert('Hello {$account->fname}! You are required to change your password.');window.location='admin/myaccountadmin.php?userId=$account->userId'</script>";
            }else{
           echo "<script type='text/javascript'>window.location='admin/homeadmin.php'</script>";
          }
        }
        else{
          echo "";
        }
      }else{
        $error = "<div class='alert alert-danger'><strong>Account Inactive!<br>Proceed to the SIHTM Office for details.</strong></div>";
      }
      }  
      }else{
        $error = "<div class='alert alert-danger'><strong>Invalid ID or Password!</strong></div>";
      }
    }

  }

?>

<body style="background-color:white;">

  <div class="container col-md-7" style="margin-top: 50px; padding:5px;">

  <div class="card border-secondary " style="width: 100%;">

  <div class="card-header"><h1><p class="text-center">Login</p></h1></div>
  <form method="POST" action="login.php">
    <br>
    <div class="card-body text-dark">
      <div class="form-row">
        <div class="form-group col-md-4"></div>
        <div class="form-group col-md-4">
          <?php
            echo $error;
          ?>
        </div>
      </div>
				      
      <div class="form-row">
      	<div class="form-group col-md-4">
         
        </div>

        <div class="form-group col-md-4">
          <label for="inputEmail4">ID Number *</font></label>
          <input type="text" class="form-control" id="userId" placeholder="Student/Employee ID" name="userId" required>
        </div>
      </div>

           <div class="form-row">
        	<div class="form-group col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="inputPassword4">Password *</font></label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
          </div>
        </div>

 <div class="form-row">
 	<span class="text-danger"><?php echo $message; ?></span>
      <div class="form-group col-md-4"></div>
      <div class="form-group col-md-4">
        <a class="text-danger" href="forgot-password.php" >Forgot Password?</a>
        <button name="login" type="submit" class="btn btn-danger" style="float:right;">Login</button>
    </div>
</div>
        <br><br>

        </div>
        
      </form>
  </div>

  </body>



<?php
include_once 'footer.php';
?>