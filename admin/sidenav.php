<?php

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);
$account->userId = $_SESSION['userId'];
?>
<div class="container-fluid sideNav float-left" >
    <ul class="nav flex-column border border-light rounded bg-light">
        <li class="nav-item">
          <?php if(basename($_SERVER['PHP_SELF'])=='homeadmin.php'){
            echo '<p class="nav-link active selected bg-danger current-s" style="margin:0;" >Tutorials</p>';

          }else{
            echo '<a class="nav-link" href="homeadmin.php">Tutorials</a>';
          }
          ?>
          <hr style="margin:0;">
        </li>
        <li class="text-danger">
          <br>
          <!--<p class="nav-link whiteSpc" href="#" tabindex="-1" aria-disabled="true"></p>-->
        </li>

        <br>
        <li class="nav-item">
          <p class="nav-link sideNav-header">Accounts</p>
          <hr style="margin:0;">
        </li>
        <li class="nav-item">
          <?php if(basename($_SERVER['PHP_SELF'])=='tutees.php'){
            echo '<p class="nav-link sideNav-subitem active selected bg-danger current-s" style="margin:0;" >Tutees</p>';
          }else{
            echo '<a class="nav-link sideNav-subitem" href="tutees.php">Tutees</a>';
          }
          ?>
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
          <?php if(basename($_SERVER['PHP_SELF'])=='admins.php'){
            echo '<p class="nav-link sideNav-subitem active selected bg-danger current-s" style="margin:0;" >Admins</p>';
          }else{
            echo '<a class="nav-link sideNav-subitem" href="admins.php">Admins</a>';
          }
          ?>
          <hr style="margin:0;">
        </li>
        <li class="text-danger">
          <br>
          <!--<p class="nav-link whiteSpc" href="#" tabindex="-1" aria-disabled="true"></p>-->
        </li>
        <li class="nav-item">
          <?php if(basename($_SERVER['PHP_SELF'])=='subjects.php'){
            echo '<p class="nav-link active selected bg-danger current-s" style="margin:0;" >Subjects</p>';
          }else{
            echo '<a class="nav-link " href="subjects.php">Subjects</a>';
          }
          ?>
          <hr style="margin:0;">
        </li>
        <li class="text-danger">
          <br>
          <!--<p class="nav-link whiteSpc" href="#" tabindex="-1" aria-disabled="true"></p>-->
        </li>
        <li class="nav-item">
          <?php if(basename($_SERVER['PHP_SELF'])=='uploadfile.php'){
            echo '<p class="nav-link active selected bg-danger current-s" style="margin:0;" >Upload Student DB</p>';
          }else{
            echo '<a class="nav-link " href="uploadfile.php">Upload Student DB</a>';
          }
          ?>
          <hr style="margin:0;">
        </li>
        <li class="nav-item">
          <?php if(basename($_SERVER['PHP_SELF'])=='generate.php'){
            echo '<p class="nav-link active selected bg-danger current-s" style="margin:0;" >Reports</p>';
          }else{
            echo '<a class="nav-link " href="generate.php">Reports</a>';
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
            if(basename($_SERVER['PHP_SELF'])=='myaccountadmin.php'){
              echo '<p class="nav-link active selected bg-danger current-s" style="margin:0;" >User Profile</p>';
            }else{
              echo '<a class="nav-link" href="myaccountadmin.php?userId='; echo $account->userId; echo '">User Profile</a>';
            }
            echo '<hr style="margin:0;">';
          ?>
        </li>
    </ul>
  </div>