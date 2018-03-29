<!DOCTYPE html>
<?php 
require 'connection.php';
session_start();
ob_start();
 ?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/half-slider.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>


<style type="text/css" media="screen">

html {
  position: relative;
  min-height: 100%;
}
body {
  background-image:url('images/sativa.png');
}
.footer {
	background-color:red;
	text-align:center;
	clear: both;
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #f5f5f5;
}


	</style>
</head>
<body>

<!-- slider -->
    <!-- Half Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" style="background-image:url('images/aaa2.jpg');"></div>
                <div class="carousel-caption">
                    <h2></h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('images/bbb.jpg');"></div>
                <div class="carousel-caption">
                    <h2></h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('images/ccc.jpg');"></div>
                <div class="carousel-caption">
                    <h2></h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('images/ddd.jpg');"></div>
                <div class="carousel-caption">
                    <h2></h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>
<!-- slider end -->



<div class="container">


<!-- tab start -->
<ul class="nav nav-tabs col-md-offset-4 col-md-4 col-md-offset-4" style=" padding-top:50px;">
  <li class="active"><a href="#teacher" class="btn btn-danger" data-toggle="tab" aria-expanded="true">Teacher Login</a></li>
  <li class=""><a href="#student" class="btn btn-danger" data-toggle="tab" aria-expanded="false"></span>Student Login</a></li>
  <li class=""><a href="#admin" class="btn btn-danger" data-toggle="tab" aria-expanded="false">Admin Login</a></li>
</ul><!-- tabs end -->


	<div id="myTabContent" class="tab-content col-md-offset-4 col-md-4 col-md-offset-4" style=" padding-top:20px; ">


	  <div class="tab-pane fade active in" id="teacher">
		<form action="teacher/teacher_login.php" method="POST" role="form">
			
		
			<div class="form-group">
				
				<input type="text" class="form-control" id="id" name="id" placeholder="Teacher ID">
			</div>
		
			<div class="form-group">
			
				<input type="password" class="form-control" id="pass" name="pass" placeholder="Teacher Password">
			</div>

			<button type="submit" class="btn btn-danger btn-block btn-lg" name="submit_teacher">Submit</button>
		
		</form>
	  </div><!-- teacher form end -->

	  <div class="tab-pane fade" id="student">
		<form action="student/student_login.php" method="POST" role="form">
			
		
			<div class="form-group">
				
				<input type="text" class="form-control" id="id" name="id" placeholder="Student ID">
			</div>
		
			<div class="form-group">
				
				<input type="password" class="form-control" id="pass" name="pass" placeholder="Student Password">
			</div>

			<button type="submit" class="btn btn-danger" name="submit_student">Submit</button>
		
		</form>
	  </div><!-- student form end -->

	  <div class="tab-pane fade" id="admin">
		<form action="" method="POST" role="form">
			
		
			<div class="form-group">
				
				<input type="text" class="form-control" id="id" name="id" placeholder="Admin ID">
			</div>
		
			<div class="form-group">
				
				<input type="password" class="form-control" id="pass" name="pass" placeholder="Admin Password">
			</div>

			<button type="submit" class="btn btn-danger" name="submit_admin">Submit</button>
		
		</form>
	  </div><!-- admin form end -->

	</div><!-- myTabContent end -->
		

</div><!-- container end -->




<?php 

if (isset($_SESSION['user_id'])) 
{

header("Location: logout.php");
} /* checking session */


else {
	if (isset($_GET['status'])) {
		
		if ($_GET['status']=="not") {
			echo "<h4 style=\"text-align:center; color:red;\">Login First</h4>";
		}

		if ($_GET['status']=="error") {
			echo "<h4 style=\"text-align:center; color:red;\">ID or Password is invalid</h4>";
		}
		
	}/* controling user from auto view */
	


//admin
	if (isset($_POST['submit_admin'])) 
	{
		$id=$_POST['id'];
		$pass=$_POST['pass'];

		$sql="SELECT * FROM ADMIN WHERE ID='$id' AND PASSWORD=$pass";

		$result=mysqli_query($con,$sql);

		if ($result) {
			while ($row=mysqli_fetch_array($result)) {
				$_SESSION['user_id']=$id;
				header("Location: admin/admin_home.php");
				die();
			}

		}else{
			header("Location: login.php?status=error");
			//echo "<h2>ID or Password is invalid</h2>";
		}
	}

}
	?>


  <div class="footer">
  	<p style="padding-top:15px; color:#567;">Copyright Imran Pollob <?php echo date("Y") ?></p>
  </div>
</body>
<script>
	$('.carousel').carousel({
    interval: 5000 //changes the speed
})

</script>

</html>