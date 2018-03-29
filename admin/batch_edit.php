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
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($batch_id, $course1, $course2, $course3, $course4, $course5, $error)
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
 			<input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>"/>
 		
 			<div class="form-group">
 				<label for="">Batch ID: *</label>
 				<input type="text" class="form-control" id="" disabled="disabled" placeholder="" name="batch_id" value="<?php echo $batch_id;; ?>">
 			</div>
 		
 			<div class="form-group">
 			<label for="">Course 1: </label>
 				<select name="course1" id="" class="form-control" required="required">
 					<?php if ($course1!="") {
 						echo "<option value=\"$course1\" selected=\"selected\">$course1</option>";
 					} ?>
 					<option value="NULL" >Null</option>
 					<?php 
 					$result2 = mysqli_query($con,"SELECT course_id FROM course")
 					or die(mysqli_error()); 

 					while ($row2 = mysqli_fetch_array($result2)) {
 						$c_id=$row2['course_id'];
 						echo "<option value=\"$c_id\">$c_id</option>";
 					} ?>
 				</select>
 			</div>

 			<div class="form-group">
 			<label for="">Course 2: </label>
 				<select name="course2" id="" class="form-control" required="required">
 					<?php if ($course2!="") {
 						echo "<option value=\"$course2\" selected=\"selected\">$course2</option>";
 					} ?>
 					<option value="NULL" >Null</option>
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
 					<?php if ($course3!="") {
 						echo "<option value=\"$course3\" selected=\"selected\">$course3</option>";
 					} ?>
 					<option value="NULL" >Null</option>
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
 					<?php if ($course4!="") {
 						echo "<option value=\"$course4\" selected=\"selected\">$course4</option>";
 					} ?>
 					<option value="NULL" >Null</option>
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
 					<?php if ($course5!="") {
 						echo "<option value=\"$course5\" selected=\"selected\">$course5</option>";
 					} ?>
 					<option value="NULL" >Null</option>
 					<?php 
 					$result2 = mysqli_query($con,"SELECT course_id FROM course")
 					or die(mysqli_error()); 

 					while ($row2 = mysqli_fetch_array($result2)) {
 						$c_id=$row2['course_id'];
 						echo "<option value=\"$c_id\" >$c_id</option>";
 					} ?>
 				</select>
 			</div>
 		
 		<p>* required</p>
 			<input type="submit" name="submit" class="btn btn-primary" value="Submit">

 		</form>

 	

 
 <?php
 }

$page=$_GET['page'];

 // connect to the database
 include('../connection.php');
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 //	if (is_numeric($_POST['id']))
 //	{
 // get form data, making sure it is valid
 		$batch_id = $_POST['batch_id'];
 		$course1 = mysqli_real_escape_string($con,htmlspecialchars($_POST['course1']));
 		$course2 = mysqli_real_escape_string($con,htmlspecialchars($_POST['course2']));
 		$course3 = mysqli_real_escape_string($con,htmlspecialchars($_POST['course3']));
 		$course4 = mysqli_real_escape_string($con,htmlspecialchars($_POST['course4']));
 		$course5 = mysqli_real_escape_string($con,htmlspecialchars($_POST['course5']));

 		$sql="UPDATE batch SET batch_id='$batch_id' ";

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

 		$sql = $sql." WHERE batch_id='$batch_id';";
		mysqli_query($con,$sql)
 		or die(mysqli_error($con)); 

 // once saved, redirect back to the view page
 			header("Location: batch_section.php?page=$page"); 

 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {

 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 	if (isset($_GET['batch_id']))
 	{
 // query db
 		$batch_id = $_GET['batch_id'];
 		$result = mysqli_query($con,"SELECT * FROM batch WHERE batch_id='$batch_id'")
 		or die(mysqli_error()); 
 		$row = mysqli_fetch_array($result);

 // check that the 'id' matches up with a row in the databse
 		if($row)
 		{

 // get data from db
 			$course1 = $row['course1'];
 			$course2 = $row['course2'];
 			$course3 = $row['course3'];
 			$course4 = $row['course4'];
 			$course5 = $row['course5'];
 // show form
 			renderForm($batch_id, $course1, $course2, $course3, $course4, $course5, '');
 		}
 		else
 // if no match, display result
 		{
 			echo "No results!";
 		}
 	}
 	else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 	{
 		echo 'Error!!';
 	}
 }
 ?>


 		</div>
	</div>


 </div>

 </body>
</html>