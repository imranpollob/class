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

function renderForm($course_id, $course_name, $teacher_id, $error)
{
//cheching session
session_start();

if ($_SESSION['user_id']) {
	//echo $_SESSION['user_id'];
}else{
	header("Location: ../login.php?status=not");
}/* checking session end */

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
 			<legend>Add new course</legend>
 		
 			<div class="form-group">
 				<label for="">Course ID: *</label>
 				<input type="text" class="form-control" id="" placeholder="" name="course_id" value="<?php echo $course_id; ?>">
 			</div>
 		
 			<div class="form-group">
 				<label for="">Course Name: *</label>
 				<input type="text" class="form-control" id="" placeholder="" name="course_name" value="<?php echo $course_name; ?>">
 			</div>

 			<div class="form-group">
 			<label for="">Teacher ID: *</label>
			<select name="teacher_id" id="" class="form-control" required="required">
			<?php 
			$result2 = mysqli_query($con,"SELECT teacher_id FROM teacher")
			 		or die(mysqli_error()); 

			while ($row2 = mysqli_fetch_array($result2)) {
				$t_id=$row2['teacher_id'];
				echo "<option value=\"$t_id\" >$t_id</option>";
			} ?>
			</select>
			</div>
 		
 		<p>* required</p>
 			<input type="submit" name="submit" class="btn btn-primary" value="Submit">

 		</form>

<?php 
}/* end of renderForm fiunction*/

?>



<?php

include('../connection.php');
// connect to the database

$page = $_GET['page'];
// check if the form has been submitted. If it has, start to process the form and save it to the database
if (isset($_POST['submit']))
{ 
// get form data, making sure it is valid
	$course_id = mysqli_real_escape_string($con,htmlspecialchars($_POST['course_id']));
	$course_name = mysqli_real_escape_string($con,htmlspecialchars($_POST['course_name']));
	$teacher_id = mysqli_real_escape_string($con,htmlspecialchars($_POST['teacher_id']));

// check to make sure both fields are entered
	if ($course_id == ''|| $course_name=='' || $teacher_id=='')
	{
// generate error message
		$error = 'ERROR: Please fill in all required fields!';

// if either field is blank, display the form again
		renderForm($course_id, $course_name, $teacher_id, $error);
	}
	else
	{
// save the data to the database

		mysqli_query($con,"INSERT course SET course_id='$course_id', course_name='$course_name',teacher_id='$teacher_id'")
		or die(mysqli_error($con)); 

// once saved, redirect back to the view page
		header("Location: course_section.php?page=$page"); 
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