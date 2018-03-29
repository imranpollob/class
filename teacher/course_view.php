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

<link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css"/ >
<script src="../js/jquery.datetimepicker.js"></script>

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
		max-width: 700px;
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


<?php 	/* session check */
require '../connection.php';
require '../function.php';

session_start();
ob_start();

if ($_SESSION['user_id']) {
	//echo $_SESSION['user_id'];

}else{
	header("Location: ../login.php?status=not");
}

$teacher_id = $_SESSION['user_id'];

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
        <li><a href="teacher_home.php"><span class="glyphicon glyphicon-user"></span>Home</a></li>
        <li><a href="teacher_profile.php"><span class="glyphicon glyphicon-user"></span>My Profile</a></li>
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- navbar end -->



<div class="container">
	
<!--============================
=            row1            =
============================-->

<div class="row">
	<!-- 1st col -->
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

		<div class="files">
		<h3 class="well">Course Materials</h3>
		<table class="table table-stripped table-hover">

	<?php
	//showing uploaded files
	$teacher_id = $_SESSION['user_id'];
	$course_id = $_SESSION['course_id'];

	if (isset($_SESSION['course_id'])) 
	{
		$course_id = $_SESSION['course_id'];
		if (!file_exists("../uploads/$course_id")) 
		{
				 mkdir("../uploads/$course_id", 0777, true);
		}else{
			if ($handle = opendir("../uploads/$course_id/"))
			{
			    while (false !== ($entry = readdir($handle))) 
			    {
			        if ($entry != "." && $entry != "..") 
			        {
			            //echo "$entry<br>";
			            echo "<tr><td><a href=\"http://localhost/iba/uploads/$course_id/$entry\" download=\"\">$entry</a></td>";
			            echo "<td><a href=\"delete.php?file=$entry&folder=$course_id&course=$course\" class=\"btn btn-warning btn-xs\">Delete</a></td></tr>";
			        }
			    }
			    closedir($handle);
			} 
		}	 

	} /* showing uploaded file end */

	?>
	</table>

	<!-- form for file upload -->


	<form action="" method="POST" enctype="multipart/form-data">

		<input type="file" name="file" class="btn btn-default btn-xm"><br>
		<input type="submit" name="file_submit" value="Upload" class="btn btn-default btn-md">
		
	</form><!-- form for file upload -->

	<?php 

	if (isset($_POST['file_submit']))/* upload file */

	{
		$course_id = $_SESSION['course_id'];
		//$_SESSION['course_id']=$course_id;
		$name = $_FILES['file']['name'];
		$size = $_FILES['file']['size'];
		$max_size = 10000000;
		$type = $_FILES['file']['type'];
		$ext = strtolower(substr($name, strpos($name,'.')+1));
		$tmp_name = $_FILES['file']['tmp_name'];
		//$error = $_FILES['file']['error'];

		//file upload
		if (isset($name)) {
			if (!empty($name)) {
				if (($ext=='jpg'||$ext=='jpeg'||$ext=='pdf'||$ext=='docx'||$ext=='doc'||$ext=='xlsx'||$ext=='pptx'||$ext=='ppsx'||$ext=='txt'||$ext=='ppt') && ($type=='image/jpeg'||$type=='application/pdf'||$type=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'||$type=='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'||$type=='application/vnd.openxmlformats-officedocument.presentationml.presentation'||$type=='application/vnd.openxmlformats-officedocument.presentationml.slideshow'||$type=='text/plain'||$type=='application/vnd.ms-powerpoint'||$type=='application/msword')) 
				{
					if ($size>=$max_size) {
						echo "Error!! Size Limit is 2MB";
					}else{
						
						$location = "../uploads/$course_id/";

						if(move_uploaded_file($tmp_name, $location.$name))
						{
							//uploaded 
							header("Refresh: 0");
						}else{
						echo "There was an error";
						}
						
					}
					
				}else{
					echo "File Type Error";
				}

			}else{
				echo "Please choose a file";
			}
		}


	}/* upload of a file end */

		
	 ?>

	</div><!-- files -->
	</div>
	<!-- 1st col end -->


	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<div id='script-warning'><code>php/get-events.php</code> must be running.</div>

			<div id='loading'>loading...</div>

			<div id='calendar'></div>
	</div><!-- 2nd col end -->
	
	
</div>

<!-----  End of row1  ------>


	
<!-- 2nd row start -->
<div class="row">
	<!-- 1st col -->
	<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">

	<?php 


	if (isset($_SESSION['user_id']) && isset($_SESSION['course_id']))
	{
		$teacher_id = $_SESSION['user_id'];
		$course_id = $_SESSION['course_id'];

		?>
		<h2>Upcoming Exams</h2>

		
	<?php


		$result = mysqli_query($con, "SELECT * FROM task WHERE teacher_id='$teacher_id' AND course_id='$course_id' ORDER BY date")
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
				echo "<div class=\"btn-group btn-group-justified\">";
				echo "<span class=\"btn btn-default disabled\">$date</span>";
				echo '<a href="task_edit.php?task_id='.$task_id.'&course='.$course.'" class="btn btn-success">Edit</a>';
				echo '<a href="task_delete.php?task_id='.$task_id.'&course='.$course.'" class="btn btn-danger">Delete</a>';
				echo "</div>";
				echo "</div>";
				echo "</div>";
			}
		} else {
			echo "No records are found.";
		}
	}
		?>
	

	</div>
	<!-- end of 1st col -->

	<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
		
	<h2>Create new task</h2>
	<form action="" method="POST" role="form">
		
		
		<div class="form-group">
		<select name="task_type" id="inputTask_type" class="form-control" required="required">
			<option value="exam" selected="selected">Exam</option>
			<option value="ass">Assignment</option>
		</select>
		</div>

		<div class="form-group">
			<input type="text" class="form-control" name="title" placeholder="Title">
		</div>
	
		<div class="form-group">
			<input type="text" class="form-control" name="content" placeholder="Description">
		</div>	

		<div class="form-group">
			<input type="text" class="form-control" name="date" id="datetimepicker" placeholder="Date">
		</div>

	
		<p>* Field requird</p>
		<br>
		<input type="submit" name="submit_task" value="submit" class="btn btn-primary">

	</form>




	<?php 
	if (isset($_POST['submit_task'])) {
		$datetime = $_POST['date'];
		//$time = $_POST['time'];
		//$datetime = "$date $time:00";

		$task_type = $_POST['task_type'];
		$title = $_POST['title'];
		$content = $_POST['content'];

		if ($title=='' || $datetime== '') {

			echo "required fields empty";
		}else{
			if ($batch_id=='') {
				$result = mysqli_query($con,"SELECT batch_id FROM batch WHERE course1='$course_id' OR course2='$course_id' OR course3='$course_id' OR course4='$course_id' OR course5='$course_id'")
				or die(mysqli_error($con));

				$row = mysqli_fetch_array($result);
				$batch_id = $row['batch_id'];
			}

			mysqli_query($con,"INSERT INTO task(teacher_id,batch_id,course_id,task_type,title,content,date) 
				VALUES ('$teacher_id','41','$course_id','$task_type','$title','$content','$datetime')")
			or mysqli_error($con);

			header("Location: course_view.php?course=$course");
		}
	}


	?>	
	</div><!-- end 0f 2nd col -->

</div>
<!-- end of 2nd row -->

</div><!-- end of container -->
</body>

<script>
	$('#datetimepicker').datetimepicker({
		format:'Y-m-d H:i'
	});
</script>
</html>