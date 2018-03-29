<!DOCTYPE HTML>
 	<html>
 	<head>
 			<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>

<script src='../js/moment.min.js'></script>
<script src='../js/jquery.min.js'></script>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<script src="../js/bootstrap.min.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css"/ >
<script src="../js/jquery.datetimepicker.js"></script>
 	</head>
 	<body>

<div class="container">
	<div class="row">
		<div class="col-md-offset-4 col-md-4 col-md-offset-4">
			

<?php //cheching session
session_start();

if ($_SESSION['user_id']) {
	//echo $_SESSION['user_id'];
}else{
	header("Location: ../login.php?status=not");
}

$course=$_GET['course'];


 function renderForm($task_id, $title, $content, $date, $task_type, $error)
 {
 	
 // if there are any errors, display them
 		if ($error != '')
 		{
 			echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 		}
 		?> 
		<h2>Edit task</h2>
	<form action="" method="POST" role="form">
		
		<input type="hidden" name="task_id" value="<?php echo $task_id; ?>"/>

		<div class="form-group">
		<select name="task_type" id="inputTask_type" class="form-control" required="required" disabled="disabled">
			<option value="" selected="selected">Task type unchanged</option>}
			<option value="exam" "<?php if($task_type=="exam") echo "selected=\"selected\""; ?>">Exam</option>
			<option value="ass"  "<?php if($task_type=="ass") echo "selected=\"selected\""; ?>">Assignment</option>
		</select>
		</div>

		<div class="form-group">
			<input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $title; ?>">
		</div>
	
		<div class="form-group">
			<input type="text" class="form-control" name="content" placeholder="Description" value="<?php echo $content; ?>">
		</div>	

		<div class="form-group">
			<input type="text" class="form-control" name="date" id="datetimepicker" placeholder="Date" value="<?php echo $date; ?>">
		</div>

	
		<p>* Field requird</p>
		<br>
		<input type="submit" name="submit" value="submit" class="btn btn-primary">

	</form>


 	
 
 <?php
 }


 // connect to the database
 include('../connection.php');
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 	$teacher_id = $_SESSION['user_id'];
	$course_id = $_SESSION['course_id'];
 // confirm that the 'id' value is a valid integer before getting the form data
 	if (is_numeric($_POST['task_id']))
 	{
 // get form data, making sure it is valid
 		$task_id = $_POST['task_id'];
 		$title = mysqli_real_escape_string($con,htmlspecialchars($_POST['title']));
 		$content = mysqli_real_escape_string($con,htmlspecialchars($_POST['content']));
 		$date = mysqli_real_escape_string($con,htmlspecialchars($_POST['date']));
 		//$task_type = mysqli_real_escape_string($con,htmlspecialchars($_POST['task_type']));

 // check that firstname/lastname fields are both filled in
 		if ($title == '' || $date == '')
 		{
 // generate error message
 			$error = 'ERROR: Please fill in all required fields!';

 //error, display form
 			renderForm($task_id, $title, $content, $date, $task_type, $error);
 		}
 		else
 		{
 // save the data to the database
 		mysqli_query($con,"UPDATE task SET title='$title', content='$content', date='$date' WHERE task_id='$task_id'")
 			or die(mysqli_error($con)); 

 // once saved, redirect back to the view page
 			header("Location: course_view.php?course="); 
 		}
 	}
 	else
 	{
 // if the 'id' isn't valid, display an error
 		echo 'Error id !';
 	}
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {

 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 	if (isset($_GET['task_id']) && is_numeric($_GET['task_id']) && $_GET['task_id'] > 0)
 	{
 // query db
 		$task_id = $_GET['task_id'];
 		$result = mysqli_query($con,"SELECT * FROM task WHERE task_id='$task_id'")
 		or die(mysqli_error()); 
 		$row = mysqli_fetch_array($result);

 // check that the 'id' matches up with a row in the databse
 		if($row)
 		{

 // get data from db
 			$title = $row['title'];
 			$content = $row['content'];
 			$date = $row['date'];
 			$task_type = $row['task_type'];

 // show form
 			renderForm($task_id, $title, $content, $date, $task_type, '');
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
 		echo 'Error !!!';
 	}
 }
 ?>
		</div>
	</div>
</div>

<script>
	$('#datetimepicker').datetimepicker({
		format:'Y-m-d H:i'
	});
</script>
 </body>
 </html> 