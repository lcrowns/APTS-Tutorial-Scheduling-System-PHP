<?php
include_once 'headeradmin.php';
include_once '../config/connection.php';
include_once '../classes/account.php';
include_once '../classes/tutor.php';

$database = new Database();
$db = $database->getConnection();

$account = new Account($db);

$stmt = $account->viewTutees();

/*if (isset($_POST['Save'])){
		$account = new Account($db);
		
		$account->fname=$_POST['fname'];
		$account->lname=$_POST['lname'];
		$account->contact=$_POST['contact'];
		$account->password= $_POST['password'];
		$account->status = $_POST['status'];
		//$account->usertype = $_POST['usertype'];
		$account->email = $_POST['email'];
		
		$account->userId = $userId;
		
			if ($account->updateUser()){
			echo "<script type='text/javascript'>alert('Successfully Updated!'); location='homeadmin.php';</script>";
				}
				else {
						echo "<script type='text/javascript'>alert('Try Again!'); location='homeadmin.php';</script>";
				}
	}*/
?>

<body>
    <div class="container">
    <h1 style="margin-bottom: 0;">Add Tutor</h1>
    <a class="text-danger" href="tutors.php">[Back]</a>
    <br><br>
   <div class="card border-secondary mb-5" style="max-width: 90rem;">
      <form method="POST" action="addtutor.php">
        <div class="card-body text-dark">
        <div class="form-row">
          <div class="form-group col-md-12">
            <h3 for="inputEmail4" class="">Select Students:</h3>
            <?php
              if(isset($_POST['search'])){
                echo '<a class="btn btn-secondary" href="addtutor.php">Reset</a>';
              }
            ?>
          </div>
        </div>
        <div style="clear:both;"></div>
        <div class="form-row">
          <div class="form-group col-md-12 input-group">
            <input type='text' class='form-control' id='search' name='search' placeholder='Search here' required>
            <input class='btn text-dark' type='submit' value='Search' style="background-color: lightgray;">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12">
          <?php 

          echo"
  
 
  <body>


   <div class='card' style='max-width: 100%; margin:0; margin-bottom: 15px;'>


<form method='POST'>

     
   
                <table class='table table-hover'>
                 <thead>
                  <tr>
                    <th scope='col'><p class='text-center'>Student ID</p></th>
                    <th scope='col'><p class='text-center'>Name</p></th>
                    <th scope='col'><p class='text-center'>Action</p></th>
                  </tr>
                 </thead>
                <tbody>";
                  if(isset($_POST['search'])){
                    if($account->searchTuteesAct($_POST['search'])->rowCount()>0){
                    $srch = $account->searchTuteesAct($_POST['search']);
                    while($row=$srch->fetch(PDO::FETCH_ASSOC)){
                    extract($row);

                    echo"

                  <tr onclick=\"window.location='viewoneaccount.php?userId={$userId}';\">
                  <td><p class='text-center'>{$userId}</p></td>
                  <td><p class='text-center'>{$fname} {$lname}</p></td>
                  <td style='padding: 5px 0;' >
                    <div class='text-center' style='margin:0; padding: 5px 0;'>";
                      echo "<a href='addtutor2.php' class='btn btn-danger'>Deactivate</a>
                    </div>
                  </td>
                  </tr>";

  }                 
}               elseif($account->searchTuteesAct($_POST['search'])->rowCount()<1){
                  echo 
                    "
                    <tr>
                      <td class='text-center' colspan='3'>Nothing to show.</td>
                    </tr>
                    ";
}}
                elseif(($stmt->rowCount())>0){
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                  extract($row);
                  echo"

                  <tr>
                  <td><p class='text-center'>{$userId}</p></td>
                  <td><p class='text-center'>{$fname} {$lname}</p></td>
                  <td style='padding: 5px 0;' >
                    <div class='text-center' style='margin:0; padding: 5px 0;'>";
                    $account->userId = $userId;
                    if (!$account->ifTutor()){
                      echo "<a name='add' class='btn btn-danger text-white' href='addtutor2.php?userId={$userId}'>Add</a>";
                    }
                    echo "
                    </div>
                  </td>
                  </tr>
                  </tbody>
                  ";
                  }
                  }else{
                    echo 
                    "
                    <tr>
                      <td class='text-center' colspan='3'>Nothing to show.</td>
                    </tr>
                    ";
                  }


                
                echo"
                </table>

  </div>


</body>";

          ?>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
  </body>



<?php
include_once '../footer.php';
?>