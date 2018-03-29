<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($first, $last, $error)
 {
 	?>
 	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 	<html>
 	<head>
 		<title>New Record</title>
 	</head>
 	<body>
	<?php //cheching session
session_start();

if ($_SESSION['user_id']) {
	echo $_SESSION['user_id'];
}else{
	header("Location: ../login.php?status=not");
}


 ?>
 <a href="../logout.php" title="Logout">Logout</a>
 
 		<?php 
 // if there are any errors, display them
 		if ($error != '')
 		{
 			echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 		}
 		?> 
 		
 		<form action="" method="post">
 			<div>
 				<strong>Name: *</strong> <input type="text" name="name" value="<?php echo $first; ?>" /><br/>
 				<strong>Phone: *</strong> <input type="text" name="phone" value="<?php echo $last; ?>" /><br/>
 				<p>* required</p>
 				<input type="submit" name="submit" value="Submit">
 			</div>
 		</form> 
 	</body>
 	</html>
 	<?php 
 }
 
 
 

 // connect to the database
 include('connection.php');
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
 	$name = mysqli_real_escape_string($conDB,htmlspecialchars($_POST['name']));
 	$phone = mysqli_real_escape_string($conDB,htmlspecialchars($_POST['phone']));
 	
 // check to make sure both fields are entered
 	if ($name == '' || $phone == '')
 	{
 // generate error message
 		$error = 'ERROR: Please fill in all required fields!';
 		
 // if either field is blank, display the form again
 		renderForm($name, $phone, $error);
 	}
 	else
 	{
 // save the data to the database
 		mysqli_query($conDB,"INSERT student SET name='$name', phone='$phone'")
 		or die(mysqli_error()); 
 		
 // once saved, redirect back to the view page
 		header("Location: view.php"); 
 	}
 }
 else
 // if the form hasn't been submitted, display the form
 {
 	renderForm('','','');
 }
 ?>