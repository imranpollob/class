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
 function renderForm($notice_id, $notice,  $error)
 {
 	//cheching session
session_start();

if ($_SESSION['user_id']) {
	//echo $_SESSION['user_id'];
}else{
	header("Location: ../login.php?status=not");
}


 ?>

 
 		<?php 
 // if there are any errors, display them
 		if ($error != '')
 		{
 			echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 		}
 		?> 
 		<form action="" method="POST" role="form">
 			<legend>Edit notice</legend>
 		<input type="hidden" name="notice_id" value="<?php echo $notice_id; ?>"/>

 			<div class="form-group">
			  <label for="">Notice: *</label>
			  <textarea class="form-control" rows="5" id="" name="notice" ><?php echo $notice; ?></textarea>
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
 		$notice_id = $_POST['notice_id'];
 		$notice = mysqli_real_escape_string($con,htmlspecialchars($_POST['notice']));


 // check that firstname/lastname fields are both filled in
 		if ($notice == '')
 		{
 // generate error message
 			$error = 'ERROR: Please fill in all required fields!';

 //error, display form
 			renderForm($notice_id, $notice, $error);
 		}
 		else
 		{
 // save the data to the database
 			mysqli_query($con,"UPDATE notice SET notice='$notice', date=now() WHERE notice_id='$notice_id'")
 			or die(mysqli_error()); 

 // once saved, redirect back to the view page
 			header("Location: notice_section.php?page=$page"); 
 		}
 /*	}
 	else
 	{
 // if the 'id' isn't valid, display an error
 		echo 'Error!';
 	}
 */
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {

 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 	if (isset($_GET['notice_id']))
 	{
 // query db
 		$notice_id = $_GET['notice_id'];
 		$result = mysqli_query($con,"SELECT * FROM notice WHERE notice_id='$notice_id'")
 		or die(mysqli_error()); 
 		$row = mysqli_fetch_array($result);

 // check that the 'id' matches up with a row in the databse
 		if($row)
 		{

 // get data from db
 			$notice = $row['notice'];


 // show form
 			renderForm($notice_id, $notice,  '');
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