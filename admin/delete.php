<?php
/* 
 DELETE.PHP
 Deletes a specific entry from the 'players' table
*/

 // connect to the database
include('../connection.php');

$page=$_GET['page'];

$id_type = $_GET['id_type'];

if ($id_type=="student_id") {
	$table="student";
	$pagename="student_section";
}

if ($id_type=="teacher_id") {
	$table="teacher";
	$pagename="teacher_section";
}

if ($id_type=="course_id") {
	$table="course";
	$pagename="course_section";
}

if ($id_type=="batch_id") {
	$table="batch";
	$pagename="batch_section";
}

if ($id_type=="notice_id") {
	$table="notice";
	$pagename="notice_section";
}
// get id value
$id = $_GET['id'];

echo "$table <br>";
echo "$id_type <br>";
echo "$id <br>";

// delete the entry
$result = mysqli_query($con,"DELETE FROM {$table} WHERE {$id_type}='{$id}'")
or die(mysqli_error($con)); 

// redirect back to the view page
header("Location: $pagename.php?page=$page");
 
 ?>