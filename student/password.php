<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<script src='../js/moment.min.js'></script>
	<script src='../js/jquery.min.js'></script>

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>

	<style type="text/css">

	body { 
		padding-top:20px;
		background-color:#34495e;
	}

	.container{
		//background-color:#ecf0f1;	
	}

	h4{
		text-align:center;
	}

	</style>
</head>

<body>
<?php
require '../connection.php';

session_start();

if ($_SESSION['user_id']) {
	//echo $_SESSION['user_id'];
}else{
	header("Location: ../login.php?status=not");
}

 ?>



<div class="container">
	<div class="row">
		<div class="col-md-offset-3 col-md-6 col-md-offset-3">
			<div class="panel panel-default">

				<div class="panel-heading" style=" background-color: ;">
				<h3 class="text-center" style="padding:3px; font-weight:bold; color:#34495e">Change Password</h3>
				</div><!-- end of panel heading-->

				<form action="" method="post" accept-charset="utf-8">

				<div class="panel-body">

					<div class="form-group">
						<input type="password" name="current_pass" value="" placeholder="Current Password" class="form-control">
					</div>

					<br>

					<div class="form-group">
						<input type="password" name="new_pass" value="" placeholder="New Password" class="form-control">
					</div>

					<div class="form-group">
						<input type="password" name="confirm_pass" value="" placeholder="Confirm Password" class="form-control">
					</div>
				

				<div class="panel-footer">
					<input type="submit" class="btn btn-primary btn-block" name="submit" value="Change Password">
				</div>
				</form>

<?php 

if (isset($_POST['submit'])) {
	$student_id = $_SESSION['user_id'];

	$current_pass = $_POST['current_pass'];
	$new_pass = $_POST['new_pass'];
	$confirm_pass = $_POST['confirm_pass'];

	if ($current_pass=='' || $new_pass=='' || $confirm_pass=='') {
		echo "<p>* All fields required</p>";
	}else{
		$result = mysqli_query($con, "SELECT * FROM student WHERE student_id='$student_id'")
		or die(mysqli_error($con));

		$row = mysqli_fetch_array($result);

		$password = $row['password'];

		if ($current_pass==$password) {

			if ($new_pass==$confirm_pass) {
				$result = mysqli_query($con, "UPDATE student SET password='$confirm_pass' WHERE student_id='$student_id'")
				or die(mysqli_error($con));
				if ($result) {
					echo "<p>Successfully updated</p>";
					header("Location: student_profile.php?status=status");
				}

			}else{
				echo "<p>New password doesn't match</p>";
			}

		}else{
			echo "<p>Password incorrect</p>";
		}

	}

}

 ?>

			</div><!-- end of panel -->

		</div>
	</div>
</div>
</body>
</html>

