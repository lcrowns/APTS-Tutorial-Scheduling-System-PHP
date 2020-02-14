<?php
include_once 'headeradmin.php';

if (isset($_POST['submit'])){
  if($_POST['pdf'] != ''){
    echo "<script type='text/javascript'>location='{$_POST['pdf']}?sd={$_POST['startdate']}&ed={$_POST['enddate']}';</script>";
  }else{
    echo "<script type='text/javascript'>alert('Please select an option.');</script>";
  }
}
?>

<body>
    <?php include_once 'sidenav.php';?>

    <br><br>
    <div class="container">
    <h1 style="margin-bottom: 0;">Generate Reports</h1>
   <div class="card border-secondary mb-5" style="max-width: 90rem;">
      <form method="POST" action="" name="cpass">
        <div class="card-body text-dark">
        <div class="form-row">
          <div class="form-group col-md-12">
            <label>Select Option</label>
            <select class="form-control" name="pdf" id="pdf" required="" >
                     <option selected readonly value="" disabled>Select which report to generate</option>
                      <option value="pdf.php">List of Tutors</option>
                      <option value="pdf2.php">List of Tutorials</option>
                      <option value="pdf3.php">Feedback on Tutors</option>
                      <option value="pdf4.php">Feedback on Tutees</option>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Start Date</label>
            <input type="date" class="form-control"  id="startdate" name="startdate">
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmail4">End Date</label>
            <input type="date" class="form-control" id="enddate" name="enddate">
          </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 text-right">
              <button class="btn btn-danger" type="submit" id="submit" name="submit">Generate</button>
            </div>
          </div>

        



        
        
      </form>
      </div>
  </div>

  </body>

  <script type="text/javascript">
$(document).ready(function(){
    $('#change').click(function(){
     $('#change').toggle();
     $('#toshow').toggle();
     $('#tohide').toggle();
    });

    $('#cancel').click(function(){
     $('#change').toggle();
     $('#toshow').toggle();
     $('#tohide').toggle();

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