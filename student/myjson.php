<?php  
header('Content-type:application/json');
session_start();
$course_id=$_SESSION['course_id'];

$con = mysqli_connect('localhost','root','','iba')
or die(mysqli_error($con));

$result=mysqli_query($con,"select * from task where course_id='$course_id'");

$rows = array();

while ($row=mysqli_fetch_array($result)) {
	$rows[] = array('title'=>$row['title'],'start'=>$row['date']); //$row;
}

echo json_encode($rows);


?>