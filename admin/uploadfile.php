<?php    
include_once 'headeradmin.php';
include_once '../classes/account.php';
include_once '../config/connection.php';

if(isset($_POST['SubmitButton']) && !empty($_FILES["filepath"])){ //check if form was submitted

if($_FILES["filepath"]["name"] != 'students.xlsx'){
	echo  "<script type='text/javascript'>alert('Incorrect file name. Try Again.'); window.location='uploadfile.php';</script>";
}
$conn = new mysqli("localhost", "root", "", "apts");
$sql = "DELETE FROM temporary";
$conn->query($sql);


$target_dir = '../uploads/';
$target_file = $target_dir . basename($_FILES["filepath"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

move_uploaded_file($_FILES["filepath"]["tmp_name"], $target_file);

require_once dirname(__FILE__) . '/../assets/PHPExcel/IOFactory.php';

$inputFileType = PHPExcel_IOFactory::identify($target_file);

$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($target_file);



require_once dirname(__FILE__) . '/../assets/phpSpreadsheet/samples/reader/05_Simple_file_reader_using_the_read_data_only_option.php';


$conn = new mysqli("localhost", "root", "", "apts");
//delete unenrolled students
$sql = "DELETE accounts FROM accounts left JOIN temporary ON accounts.userId = temporary.userId WHERE accounts.usertype='Student' and TEMPORARY.userId is null ";
$conn->query($sql);


//delete duplicate from new table

$sql = "DELETE `temporary` FROM `temporary` Inner join accounts on temporary.userId = accounts.userId WHERE temporary.usertype='Student' ";
$conn->query($sql);

//insert new data

$futureDate=date('Y-m-d', strtotime('+1 year'));
$account = new Account($db);
$stmt = $account->viewNewTutees();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
extract($row);

$sql = "INSERT INTO accounts (userid, fname, mname, lname, contact, usertype, status, password, email, expDate, firstLogin) VAlUES ('{$userId}', '{$fname}', '{$mname}', '{$lname}', '{$contact}', 'Student', 'Active', '{$mname}', '{$email}', '{$futureDate}', 1)";
$conn->query($sql);


}

if(mysqli_affected_rows($conn)>0){
	echo  "<script type='text/javascript'>alert('Students Updated!')</script>";
}elseif(mysqli_affected_rows($conn)==0){
	echo  "<script type='text/javascript'>alert('No changes occured.')</script>";
}else{
	echo  "<script type='text/javascript'>alert('An error occured. Please check that you have the correct file and try again.')</script>";
}
}
?>

<body>
	<?php include_once 'sidenav.php';?>
	<div class="container-fluid main-content float-left" style="background-color: white;">
		<p style="font-size: 28px; color: #383535; margin-top: 5px; ">Upload Student Database:</p>
		<form action="" method="post" enctype="multipart/form-data">
		<input type="file"  name="filepath" id="filepath" required /></td><td><input class='btn btn-danger' type="submit" name="SubmitButton"/>
		<br><br>
	</div>

	<div class="container-fluid main-content float-left" style="background-color: white;">
		<h3>Note:</h3>
		<ul>
			<li>The file to be uploaded must have a file name extension of '.xlsx'.</li>
			<li>The file must be named 'students.xlsx'.</li>
			<li>Table headers must be placed at the first row only. Data regarding the students must start at the second row.</li>
			<li>The table should contain six columns. These are (in order): </li>
			<ol>
				<li>Student ID</li>
				<li>First Name</li>
				<li>Middle Name</li>
				<li>Last Name</li>
				<li>Contact No.</li>
				<li>Email Address</li>
			</ol>
			<li>Student records that appear in both the old table and the one to be uploaded will be retained.</li>
			<li>Student records which are present in the one to be uploaded but not in the old one will be deleted.</li>
			<li>New student records from the uploaded table will be added to the old one.</li>
		</ul>
	</div>
</body>