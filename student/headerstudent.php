<?php
include_once '../config/connection.php';
include_once '../classes/account.php';

session_start();

date_default_timezone_set('Asia/Manila');

$userId = $_SESSION['userId'];


  if (!isset($_SESSION['userId'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../home.php');
  }

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->userId = $userId;
$account->readoneaccount();
$name = $account->fname." ".$account->lname;


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/bootstrap/4.1.3/css/one.css">
    <link rel="stylesheet" href="../assets/bootstrap/4.1.3/css/two.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/apts.css">

    <title>A-Peer Tutoring System</title>
  </head>

  <style>
    body, html {
      height: 100%;
      font-family: "Helvetica", sans-serif;
    }
      .menu {
          display: none;
      }
  </style>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <a class="navbar-brand" href="#">A-PTS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
     <li class="nav-item active">
        <a class="nav-link" href="homestudent.php">Home</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="#">About</a>
      </li>

    </ul>

    <ul class="nav justify-content-end">
      <!-- Example split danger button -->

<div class="btn-group">
  <button type="button" class="btn btn-danger"><?php echo $name ?></button>
  <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="sr-only"></span>
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="homestudent.php">My Tutorials</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="tutors.php">Find Tutors</a>
    <a class="dropdown-item" href="subjects.php">Subjects Offered</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="myaccount.php?userId=<?php echo $_SESSION['userId']?>">My Account</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="../logout.php">Logout</a>
  </div>
</div>
</div>
      </div>


  </div>
</nav>
  

    <header class="bgimg w3-display-container w3-grayscale-min" id="home">
    </header>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/jquery/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="../assets/popper.js/1.14.3/umd/popper.min.js" integrity="sha384\-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="../assets/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  </body>
</html>