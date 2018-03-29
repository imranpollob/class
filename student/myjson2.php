<?php  
header('Content-type:application/json');
session_start();

$con = mysqli_connect('localhost','root','','iba')
or die(mysqli_error($con));

$rows = array();

if ($_SESSION['course1']!="") {

	$course_id=$_SESSION['course1'];
	$result=mysqli_query($con,"select * from task where course_id='$course_id'");

	while ($row=mysqli_fetch_array($result)) {
		$rows[] = array('title'=>$row['title'],'start'=>$row['date']); //$row;
	}

}

if ($_SESSION['course2']!="") {
	
	$course_id=$_SESSION['course2'];
	$result=mysqli_query($con,"select * from task where course_id='$course_id'");

	while ($row=mysqli_fetch_array($result)) {
		$rows[] = array('title'=>$row['title'],'start'=>$row['date']); //$row;
	}

}

if ($_SESSION['course3']!="") {
	
	$course_id=$_SESSION['course3'];
	$result=mysqli_query($con,"select * from task where course_id='$course_id'");

	while ($row=mysqli_fetch_array($result)) {
		$rows[] = array('title'=>$row['title'],'start'=>$row['date']); //$row;
	}

}

if ($_SESSION['course4']!="") {
	
	$course_id=$_SESSION['course4'];
	$result=mysqli_query($con,"select * from task where course_id='$course_id'");

	while ($row=mysqli_fetch_array($result)) {
		$rows[] = array('title'=>$row['title'],'start'=>$row['date']); //$row;
	}

}

if ($_SESSION['course5']!="") {
	
	$course_id=$_SESSION['course5'];
	$result=mysqli_query($con,"select * from task where course_id='$course_id'");

	while ($row=mysqli_fetch_array($result)) {
		$rows[] = array('title'=>$row['title'],'start'=>$row['date']); //$row;
	}

}


echo json_encode($rows);


?>