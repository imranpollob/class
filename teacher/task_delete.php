<?php //cheching session
session_start();

if ($_SESSION['user_id']) {
	echo $_SESSION['user_id'];
}else{
	header("Location: ../login.php?status=not");
}

$course=$_GET['course'];

 ?>
 <a href="../logout.php" title="Logout">Logout</a>

 
<?php
/* 
 DELETE.PHP
 Deletes a specific entry from the 'players' table
*/

 // connect to the database
 include('../connection.php');

 $page=$_GET['page'];
 
 // check if the 'id' variable is set in URL, and check that it is valid
 if (isset($_GET['task_id']) && is_numeric($_GET['task_id']))
 {
 // get id value
 	$teacher_id = $_GET['teacher_id'];
	$course_id = $_GET['course_id'];
 	$task_id = $_GET['task_id'];
 	
 // delete the entry
 	$result = mysqli_query($con,"DELETE FROM task WHERE task_id=$task_id")
 	or die(mysqli_error()); 
 	
 // redirect back to the view page
 	header("Location: course_view.php?course=$course");
 }
 else
 // if id isn't set, or isn't valid, redirect back to view page
 {
 	header("Location: course_view.php?course=$course");
 }
 
 ?>