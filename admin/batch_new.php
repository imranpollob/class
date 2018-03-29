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
 function renderForm($batch_id, $course1, $course2, $course3, $course4, $course5, $error)
 {
//cheching session
session_start();

if ($_SESSION['user_id']) {
	echo $_SESSION['user_id'];
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
 				<label for="">Batch ID: *</label>
 				<input type="text" class="form-control" id="" placeholder="" name="batch_id" value="<?php echo $batch_id;; ?>">
 			</div>
 		
 			<div class="form-group">
 			<label for="">Course 1: </label>
 				<select name="course1" id="" class="form-control" required="required">
 					<option value="NULL" selected="selected">Null</option>
 					<?php 
 					$result2 = mysqli_query($con,"SELECT course_id FROM course")
 					or die(mysqli_error()); 

 					while ($row2 = mysqli_fetch_array($result2)) {
 						$c_id=$row2['course_id'];
 						echo "<option value=\"$c_id\" >$c_id</option>";
 					} ?>
 				</select>
 			</div>

 			<div class="form-group">
 			<label for="">Course 2: </label>
 				<select name="course2" id="" class="form-control" required="required">
 					<option value="NULL" selected="selected">Null</option>
 					<?php 
 					$result2 = mysqli_query($con,"SELECT course_id FROM course")
 					or die(mysqli_error()); 

 					while ($row2 = mysqli_fetch_array($result2)) {
 						$c_id=$row2['course_id'];
 						echo "<option value=\"$c_id\" >$c_id</option>";
 					} ?>
 				</select>
 			</div>

 			<div class="form-group">
 			<label for="">Course 3: </label>
 				<select name="course3" id="" class="form-control" required="required">
 					<option value="NULL" selected="selected">Null</option>
 					<?php 
 					$result2 = mysqli_query($con,"SELECT course_id FROM course")
 					or die(mysqli_error()); 

 					while ($row2 = mysqli_fetch_array($result2)) {
 						$c_id=$row2['course_id'];
 						echo "<option value=\"$c_id\" >$c_id</option>";
 					} ?>
 				</select>
 			</div>

 			<div class="form-group">
 			<label for="">Course 4: </label>
 				<select name="course4" id="" class="form-control" required="required">
 					<option value="NULL" selected="selected">Null</option>
 					<?php 
 					$result2 = mysqli_query($con,"SELECT course_id FROM course")
 					or die(mysqli_error()); 

 					while ($row2 = mysqli_fetch_array($result2)) {
 						$c_id=$row2['course_id'];
 						echo "<option value=\"$c_id\" >$c_id</option>";
 					} ?>
 				</select>
 			</div>

 			<div class="form-group">
 			<label for="">Course 5: </label>
 				<select name="course5" id="" class="form-control" required="required">
 					<option value="NULL" selected="selected">Null</option>
 					<?php 
 					$result2 = mysqli_query($con,"SELECT course_id FROM course")
 					or die(mysqli_error()); 

 					while ($row2 = mysqli_fetch_array($result2)) {
 						$c_id=$row2['course_id'];
 						echo "<option value=\"$c_id\" >$c_id</option>";
 					} ?>
 				</select>
 			</div>
<!--
 			<div class="form-group">
 				<label for="">Course 1: </label>
 				<input type="text" class="form-control" id="" placeholder="" name="course1" value="<?php echo $course1; ?>">
 			</div>
-->

 		
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
 	$batch_id = mysqli_real_escape_string($con,htmlspecialchars($_POST['batch_id']));
 	$course1 = mysqli_real_escape_string($con,htmlspecialchars($_POST['course1']));
 	$course2 = mysqli_real_escape_string($con,htmlspecialchars($_POST['course2']));
 	$course3 = mysqli_real_escape_string($con,htmlspecialchars($_POST['course3']));
 	$course4 = mysqli_real_escape_string($con,htmlspecialchars($_POST['course4']));
 	$course5 = mysqli_real_escape_string($con,htmlspecialchars($_POST['course5']));
 	

 // check to make sure both fields are entered
 	if ($batch_id == '')
 	{
 // generate error message
 		$error = 'ERROR: Please fill in all required fields!';
 		
 // if either field is blank, display the form again
 		renderForm($batch_id, $course1, $course2, $course3, $course4, $course5, $error);
 	}
 	else
 	{
 // save the data to the database
 		$sql="INSERT batch SET batch_id='$batch_id' ";

 		if ($course1=="NULL") {
 			$sql = $sql.", course1=NULL";
 		}else{
 			$sql = $sql.", course1='$course1'";
 		}

 		if ($course2=="NULL") {
 			$sql = $sql.", course2=NULL";
 		}else{
 			$sql = $sql.", course2='$course2'";
 		}

 		if ($course3=="NULL") {
 			$sql = $sql.", course3=NULL";
 		}else{
 			$sql = $sql.", course3='$course3'";
 		}

 		if ($course4=="NULL") {
 			$sql = $sql.", course4=NULL";
 		}else{
 			$sql = $sql.", course4='$course4'";
 		}

 		if ($course5=="NULL") {
 			$sql = $sql.", course5=NULL";
 		}else{
 			$sql = $sql.", course5='$course5'";
 		}

 		$sql = $sql.";";

 		//echo "$sql";
 		
 		mysqli_query($con,$sql)
 		or die(mysqli_error($con)); 
 		
 // once saved, redirect back to the view page
 		header("Location: batch_section.php?page=$page"); 
 	}
 }
 else
 // if the form hasn't been submitted, display the form
 {
 	renderForm('','','','','','','');
 }
 ?>

 		</div>
	</div>


 </div>

 </body>
</html>