<?php
$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->userId = $_SESSION['userId'];
?>

  <div class="container-fluid sideNav float-left" >
    <ul class="nav flex-column border border-light rounded bg-light">
        <li class="nav-item">
          <?php if(basename($_SERVER['PHP_SELF'])=='homestudent.php'){
            echo '<p class="nav-link active selected bg-danger current-s" style="margin:0;" >Tutorials</p>';

          }else{
            echo '<a class="nav-link" href="homestudent.php">Tutorials</a>';
          }
          ?>
          <hr style="margin:0;">
        </li>
        <li class="text-danger">
          <br>
          <!--<p class="nav-link whiteSpc" href="#" tabindex="-1" aria-disabled="true"></p>-->
        </li>

        <li class="nav-item">
          <p class="nav-link sideNav-header">Find a Tutor</p>
          <hr style="margin:0;">
        </li>
        <li class="nav-item">
          <?php if(basename($_SERVER['PHP_SELF'])=='tutors.php'){
            echo '<p class="nav-link sideNav-subitem active selected bg-danger current-s" style="margin:0;" >Tutors</p>';
          }else{
            echo '<a class="nav-link sideNav-subitem" href="tutors.php">Tutors</a>';
          }
          ?>
          <hr style="margin:0;">
        </li>
        <li class="nav-item">
          <?php if(basename($_SERVER['PHP_SELF'])=='subjects.php'){
            echo '<p class="nav-link sideNav-subitem active selected bg-danger current-s" style="margin:0;" >Subjects</p>';
          }else{
            echo '<a class="nav-link sideNav-subitem" href="subjects.php">Subjects</a>';
          }
          ?>
          <hr style="margin:0;">
        </li>
        <li class="text-danger">
          <br>
          <!--<p class="nav-link whiteSpc" href="#" tabindex="-1" aria-disabled="true"></p>-->
        </li>
        <li class="nav-item">
          <?php 
            if(basename($_SERVER['PHP_SELF'])=='myaccount.php'){
              echo '<p class="nav-link active selected bg-danger current-s" style="margin:0;" >User Profile</p>';
            }else{
              echo '<a class="nav-link" href="myaccount.php?userId='; echo $userId; echo '">User Profile</a>';
            }
            echo '<hr style="margin:0;">';
          ?>
        </li>
    </ul>
  </div>