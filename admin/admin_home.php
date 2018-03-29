<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Home</title>
	<link href='../css/fullcalendar.css' rel='stylesheet' />
	<link href='../css/fullcalendar.print.css' rel='stylesheet' media='print' />
	<script src='../js/moment.min.js'></script>
	<script src='../js/jquery.min.js'></script>
	<script src='../js/fullcalendar.min.js'></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<?php //cheching session
session_start();

if ($_SESSION['user_id']) {
	//echo $_SESSION['user_id'];
}else{
	header("Location: ../login.php?status=not");
}/* checking session end */


?>
 
<!-- navbar -->
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><?php echo $_SESSION['user_id']; ?></a>
    </div>
    <div>
    
      <ul class="nav navbar-nav navbar-right">
        <li><a href="admin_home.php"><span class="glyphicon glyphicon-user"></span> Home</a></li>
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- navbar end -->
<div class="container">
	

<h1 class="text-center well">Welcome Admin</h1>


<a href="teacher_section.php" title="Teacher Section" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-knight"> Teacher Section</a><br>
<a href="course_section.php" title="Course Section" class="btn btn-info btn-lg btn-block"><span class="glyphicon glyphicon-duplicate"> Course Section</a><br>
<a href="batch_section.php" title="Batch Section" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-stats"> Batch Section</a><br>
<a href="student_section.php" title="Student Section" class="btn btn-info btn-lg btn-block"><span class="glyphicon glyphicon-apple"> Student Section</a><br>
<a href="notice_section.php" title="Notice Section" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-list-alt"> Notice Section</a><br>

</div>
</body>
</html>