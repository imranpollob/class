<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link href='../css/fullcalendar.css' rel='stylesheet' />
	<link href='../css/fullcalendar.print.css' rel='stylesheet' media='print' />
	<script src='../js/moment.min.js'></script>
	<script src='../js/jquery.min.js'></script>
	<script src='../js/fullcalendar.min.js'></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>
	<style type="text/css" media="screen">
		body{
			padding-top:80px;
		}
	</style>
</head>
<body>
	
<div class="container">
	
<div class="row">
	<div class="col-md-offset-3 col-md-6 col-md-offset-3">
		


<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($student_id, $student_name, $batch, $error)
 {
 	
 //cheching session
session_start();

if ($_SESSION['user_id']) {
	//echo $_SESSION['user_id'];
}else{
	header("Location: ../login.php?status=not");
}
require '../connection.php';

 ?>

 
 		<?php 
 // if there are any errors, display them
 		if ($error != '')
 		{
 			echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 		}
 		?> 


 		<form action="" method="POST" role="form">
 			<legend>Add new student</legend>
 		
 			<div class="form-group">
 				<label for="">Student ID: *</label>
 				<input type="text" class="form-control" id="" placeholder="" name="student_id" value="<?php echo $student_id; ?>">
 			</div>
 		
 			<div class="form-group">
 				<label for="">Student Name: *</label>
 				<input type="text" class="form-control" id="" placeholder="" name="student_name" value="<?php echo $student_name; ?>">
 			</div>

 			<div class="form-group">
 			<label for="">Batch: *</label>
 				<select name="batch" id="" class="form-control" required="required">					
 					<?php 
 					$result2 = mysqli_query($con,"SELECT batch_id FROM batch")
 					or die(mysqli_error()); 

 					while ($row2 = mysqli_fetch_array($result2)) {
 						$b_id=$row2['batch_id'];
 						echo "<option value=\"$b_id\" >$b_id</option>";
 					} ?>
 				</select>
 			</div>

 			
 		
 		<p>* required</p>
 			<input type="submit" name="submit" class="btn btn-primary" value="Submit">

 		</form>


 	<?php 
 }
 
 
 

 // connect to the database
 include('../connection.php');
 $page = $_GET['page'];
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
 	$student_id = mysqli_real_escape_string($con,htmlspecialchars($_POST['student_id']));
 	$student_name = mysqli_real_escape_string($con,htmlspecialchars($_POST['student_name']));
 	$batch = mysqli_real_escape_string($con,htmlspecialchars($_POST['batch']));
 	
 // check to make sure both fields are entered
 	if ($student_id == ''|| $student_name=='' || $batch=='')
 	{
 // generate error message
 		$error = 'ERROR: Please fill in all required fields!';
 		
 // if either field is blank, display the form again
 		renderForm($student_id, $student_name, $batch, $error);
 	}
 	else
 	{
 // save the data to the database
 		
 		mysqli_query($con,"INSERT student SET student_id='$student_id', student_name='$student_name',batch='$batch'")
 		or die(mysqli_error($con)); 
 		
 // once saved, redirect back to the view page
 		header("Location: student_section.php?page=$page"); 
 	}
 }
 else
 // if the form hasn't been submitted, display the form
 {
 	renderForm('','','','');
 }
 ?>
		</div>
	</div>


 </div>

 </body>
</html>