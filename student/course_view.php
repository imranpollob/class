<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link href='../css/fullcalendar.css' rel='stylesheet' />
	<link href='../css/fullcalendar.print.css' rel='stylesheet' media='print' />
	<script src='../js/moment.min.js'></script>
	<script src='../js/jquery.min.js'></script>
	<script src='../js/fullcalendar.min.js'></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>

<?php 	/* session */

require '../connection.php';
session_start();

if ($_SESSION['user_id']) {
	//echo $_SESSION['user_id'];
}else{
	header("Location: ../login.php?status=not");
}


$course = $_GET['course'];

if ($course=="course1") {
	$_SESSION['course_id']=$_SESSION['course1'];
}

if ($course=="course2") {
	$_SESSION['course_id']=$_SESSION['course2'];
}

if ($course=="course3") {
	$_SESSION['course_id']=$_SESSION['course3'];
}

if ($course=="course4") {
	$_SESSION['course_id']=$_SESSION['course4'];
}

if ($course=="course5") {
	$_SESSION['course_id']=$_SESSION['course5'];
}

//echo $_SESSION['course_id'];

/* checking session */

?>

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
		url: 'myjson.php',
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
<style>
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
	max-width: 700px;
	margin: 40px auto;
	padding: 0 10px;
}

</style>

</head>
<body>

<!-- navbar -->
 <nav class="navbar navbar-inverse ">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><?php echo $_SESSION['user_id']; ?></a>
    </div>
    <div>
    
      <ul class="nav navbar-nav navbar-right">
        <li><a href="student_home.php"><span class="glyphicon glyphicon-user"></span>Home</a></li>
        <li><a href="student_profile.php"><span class="glyphicon glyphicon-user"></span>My Profile</a></li>
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- navbar end -->

<div class="container">
	

<div class="row">

	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<div class="files">
		<h3 class="well">Course Materials</h3>
		<table class="table table-striped table-hover">

			<?php
			//showing uploaded files
			if (isset($_SESSION['course_id'])) 
			{
				$course_id = $_SESSION['course_id'];
				if (!file_exists("../uploads/$course_id")) 
				{
					echo "No Files";
				}else{
					if ($handle = opendir("../uploads/$course_id/"))
					{
						while (false !== ($entry = readdir($handle))) 
						{
							if ($entry != "." && $entry != "..") 
							{
							//echo "$entry<br>";
								echo "<tr><td><a href=\"http://localhost/iba/uploads/$course_id/$entry\" download=\"\">$entry</a></tr></td>";
							}
						}
						closedir($handle);
					} 
				}	 

			} 
			?>
		</table>
	</div><!-- end of showing uploaded files -->
	</div><!-- 1str col end -->

	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<div id='script-warning'><code>php/get-events.php</code> must be running.</div>

			<div id='loading'>loading...</div>

			<div id='calendar'></div>
	</div><!-- 2nd col end -->
	
</div><!-- 1st row end -->
	


<div class="row">
	<div class="col-md-offset-2 col-md-8 col-md-offset-2">
				
	<h2>Upcoming...</h2><br>

	<?php
	$course_id = $_SESSION['course_id'];

	$result = mysqli_query($con, "SELECT * FROM task WHERE course_id='$course_id' ORDER BY date ASC")
	or die(mysqli_error($con));

	if (mysqli_num_rows($result) != 0) 
	{

		while ($row = mysqli_fetch_array($result)) 
		{
				$task_id = $row['task_id'];
				$batch_id = $row['batch_id'];
				$task_type = $row['task_type'];
				$title = $row['title'];
				$content = $row['content'];
				$date = $row['date'];

				if ($task_type=="exam") {
					echo "<div class=\"panel panel-danger\">";
					echo "<div class=\"panel-heading\">";
					echo "Class Test";
					echo "</div>";
				}

				else if ($task_type=="ass") {
					echo "<div class=\"panel panel-info\">";
					echo "<div class=\"panel-heading\">";
					echo "Assignment";
					echo "</div>";

				}
				
				echo "<div class=\"panel-body\">";
				echo "<h4>$title</h4>";
				echo "$content";
				echo "</div>";

				echo "<div class=\"panel-footer\">";
				echo "<span class=\"text-center\">$date</span>";
				echo "</div>";
				echo "</div>";
		}
	} else {
		echo "No records are found.";
	}


	?>
	


	</div>
</div><!-- 2st row end -->
	

</div>
</body>
</html>