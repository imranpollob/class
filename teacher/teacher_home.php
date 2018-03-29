<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Teacher Home</title>
	<link href='../css/fullcalendar.css' rel='stylesheet' />
	<link href='../css/fullcalendar.print.css' rel='stylesheet' media='print' />
	<script src='../js/moment.min.js'></script>
	<script src='../js/jquery.min.js'></script>
	<script src='../js/fullcalendar.min.js'></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>
	<style type="text/css">

	.container{
		background-color:#ecf0f1;
		
		
	}
	body {
		background-color:#34495e;
		margin: 0;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#script-warning {
		display: none;
		background: #eee;
		border-bottom: 1px solid #ddd;
		padding: 0 10px;
		line-height: 40px;
		text-align: center;
		font-weight: bold;
		font-size: 12px;
		color: red;
	}

	#loading {
		display: none;
		position: absolute;
		top: 10px;
		right: 10px;
	}

	#calendar {
		max-width: 900px;
		margin: 40px auto;
		padding: 0 10px;
	}
	</style>
	<script>

	$(document).ready(function() {
	
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			//defaultDate: '2015-02-12',
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events: {
				//url: 'php/get-events.php',
				url: 'myjson2.php',
				error: function() {
					$('#script-warning').show();
				}
			},
			loading: function(bool) {
				$('#loading').toggle(bool);
			}
		});
		
	});

</script>

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
        <li><a href="#"><span class="glyphicon glyphicon-user"></span>Home</a></li>
        <li><a href="teacher_profile.php"><span class="glyphicon glyphicon-user"></span>My Profile</a></li>
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- navbar end -->


<div class="container">
	
<h1 class="text-center">Wellcome Teacher</h1>


<div class="row">
<!-- 1st col -->
<div class="col-md-4">
<h2 class="well">My Courses</h2>


<?php
/*==========================================
=            course via session            =
==========================================*/

$course1=$_SESSION['course1'];
$course2=$_SESSION['course2'];
$course3=$_SESSION['course3'];
$course4=$_SESSION['course4'];
$course5=$_SESSION['course5'];

if ($course1!="") {

	echo "<a href=\"course_view.php?course=course1\" class=\"btn btn-primary\">$course1</a><br><br>";
}

if ($course2!="") {

	echo "<a href=\"course_view.php?course=course2\" class=\"btn btn-primary\">$course2</a><br><br>";
}

if ($course3!="") {

	echo "<a href=\"course_view.php?course=course3\" class=\"btn btn-primary\">$course3</a><br><br>";
}

if ($course4!="") {

	echo "<a href=\"course_view.php?course=course4\" class=\"btn btn-primary\">$course4</a><br><br>";
}

if ($course5!="") {

	echo "<a href=\"course_view.php?course=course5\" class=\"btn btn-primary\">$course5</a><br><br>";
}


/*-----  End of course via session  ------*/
?>
</div><!-- end of col -->
<!-- 1st col end -->


<!-- 2nd col -->
<div class="col-md-offset-2 col-md-6">	
	<div class="notice">
	<h2 class="text-right well">Notice</h2>
	<?php 
	$result=mysqli_query($con,"SELECT * FROM notice ORDER BY notice_id DESC")
		or die(mysqli_error($con));

	while ($row = mysqli_fetch_array($result)) {
		echo "<div class=\"panel panel-default\">";
		echo "<div class=\"panel-body\">";
		echo $row['notice'] ."<br>";
		echo "</div>";
		echo "</div>";
		}
	 ?>
	</div><!-- end of notice -->
</div><!-- end of colume -->
<!-- 2nd col end -->
</div><!-- end of row -->


<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div id='script-warning'><code>php/get-events.php</code> must be running.</div>

		<div id='loading'>loading...</div>

		<div id='calendar'></div>
	</div>
</div>


</div><!-- container end -->
<div class="clearfix visible-lg"></div>
</body>
</html>

