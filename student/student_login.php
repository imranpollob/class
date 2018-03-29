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
	


	if (isset($_POST['submit_student'])) 
	{	
		$id=$_POST['id'];
		$pass=$_POST['pass'];

		$sql="SELECT * FROM STUDENT WHERE STUDENT_ID='$id' AND PASSWORD=$pass";

		$result=mysqli_query($con,$sql);

		if ($result) {
			while ($row=mysqli_fetch_array($result)) {
				$batch = $row['batch'];				
				$_SESSION['user_id']=$id;/* session start */
				$_SESSION['batch']=$batch;

				//header("Location: student_home.php");
				//die();
			}

			/* finding course list */
			
			$student_id = $id;
			$batch = $batch;

			$_SESSION['course1']="";
			$_SESSION['course2']="";
			$_SESSION['course3']="";
			$_SESSION['course4']="";
			$_SESSION['course5']="";

			$result=mysqli_query($con,"SELECT * FROM batch WHERE batch_id='$batch'")
			or die(mysqli_error($con));

			while ($tableRow = mysqli_fetch_assoc($result)) {

			    foreach ($tableRow as $key => $value) {
			    	if ($key!="batch_id") {
			    		$_SESSION[$key]=$tableRow[$key];
			    		//echo $tableRow[$key]."  <br>".$key."<br>";
			    		//echo "<a href=\"course_view.php?course_id=$tableRow[$key]\">$tableRow[$key]</a><br>";
			    		header("Location: student_home.php");

			    	}
			        
			    }
			}/* finding course list end */
			

		}/* end of checking */
		else{
			header("Location: ../login.php?status=error");
			//echo "ID or Password is invalid";
		}

	}/* end of submit student */

	

}

 ?>