<?php 
require '../connection.php';
session_start();

if (isset($_SESSION['user_id'])) 
{

header("Location: logout.php");
} /* checking session */


else {
	if (isset($_GET['status'])) {
		echo "<h2>Login First</h2>";
	}/* controling user from auto view */
	
	if (isset($_POST['submit_teacher'])) 
	{
		$id=$_POST['id'];
		$pass=$_POST['pass'];

		$sql="SELECT * FROM TEACHER WHERE TEACHER_ID='$id' AND PASSWORD=$pass";

		$result=mysqli_query($con,$sql);

		if ($result) {
			while ($row=mysqli_fetch_array($result)) {
				$teacher_id = $row['teacher_id'];
				$_SESSION['user_id']=$teacher_id;
				//header("Location: teacher_home.php");
				//die();

			}

			$_SESSION['course1']="";
			$_SESSION['course2']="";
			$_SESSION['course3']="";
			$_SESSION['course4']="";
			$_SESSION['course5']="";

				$result=mysqli_query($con,"SELECT * FROM course WHERE teacher_id='$teacher_id'")
				or die(mysqli_error($con));

				$counter=1;
				$c = "course".$counter;
				while ($tableRow = mysqli_fetch_assoc($result)) {
					$c = "course".$counter;
					$_SESSION[$c] = $tableRow['course_id'];
					//echo $c."   ".$row['course_id']."<br>";
					$counter++;

			}/* finding course list end */
				header("Location: teacher_home.php");

		}else{
			header("Location: ../login.php?status=error");
			//echo "ID or Password is invalid";
		}
	}


}


?>