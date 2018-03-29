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

<!-- navbar -->
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><?php echo $_SESSION['user_id']; ?></a>
    </div>
    <div>
    
      <ul class="nav navbar-nav navbar-right">
        <li><a href="teacher_home.php"><span class="glyphicon glyphicon-user"></span>Home</a></li>
        <li><a href="teacher_profile.php"><span class="glyphicon glyphicon-user"></span>My Profile</a></li>
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- navbar end -->

<?php 

$teacher_id = $_SESSION['user_id'];

$result = mysqli_query($con, "SELECT * FROM teacher WHERE teacher_id='$teacher_id'")
	or die(mysqli_error($con));

$row = mysqli_fetch_array($result);

$teacher_name = $row['teacher_name'];
$designation = $row['designation'];
$email = $row['email'];
$mobile = $row['mobile'];
 ?>

<div class="container">
<div class="row">
<div class="col-md-offset-3 col-md-6 col-md-offset-3">

<div class="panel panel-primary">

  <div class="panel-heading" style=" background-color: ;">
  		<h2 class="text-center" style="padding:10px; font-weight:bold; color:">Honorable Teacher</h2>
  </div><!-- end of panel heading-->

  <div class="panel-body">
  
  	<table style="width:100%;">
  	<tr>
  		<td><h4 style="font-weight:bold;">ID: </h4></td>
  		<td><h4><?php echo $teacher_id; ?></h4></td>
  	</tr>

  	<tr>
  		<td><h4 style="font-weight:bold;">Name: </h4></td>
  		<td><h4><?php echo $teacher_name; ?></h4></td>
  	</tr>

  	<tr>
  		<td><h4 style="font-weight:bold;">Designation: </h4></td>
  		<td><h4><?php echo $designation; ?></h4></td>
  	</tr>

  	<tr>
  		<td><h4 style="font-weight:bold;">Email: </h4></td>
  		<td><h4><?php echo $email; ?></h4></td>
  	</tr>

  	<tr>
  		<td><h4 style="font-weight:bold;">Mobile: </h4></td>
  		<td><h4><?php echo $mobile; ?></h4></td>
  	</tr>
  </table>


  </div><!-- end of panel body -->

  <div class="panel-footer">
  	<a href="" class="btn btn-success btn-block" title="Change Password">Update</a>
  	<a href="password.php" class="btn btn-primary btn-block" title="Change Password">Change Password</a>
  </div><!-- end of panel footer -->

</div><!-- end of panel -->

</div><!-- end of col -->

</div><!-- end of row -->
</div><!-- end of contaier -->
</body>
</html>