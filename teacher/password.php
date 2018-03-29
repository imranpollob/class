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
<div class="container">
	<div class="row">
		<div class="col-md-offset-3 col-md-6 col-md-offset-3">
			<div class="panel panel-default">

				<div class="panel-heading" style=" background-color: ;">
				<h3 class="text-center" style="padding:3px; font-weight:bold; color:#34495e">Change Password</h3>
				</div><!-- end of panel heading-->

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
					<input type="button" class="btn btn-primary btn-block" name="submit" value="Change Password">
				</div>

			</div><!-- end of panel -->

		</div>
	</div>
</div>
</body>
</html>