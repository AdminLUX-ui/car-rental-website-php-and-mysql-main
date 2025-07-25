<?php
session_start();

// IF THE USER HAS ALREADY LOGGED IN
if(isset($_SESSION['username_yahya_car_rental']) && isset($_SESSION['password_yahya_car_rental']))
{
	header('Location: dashboard.php');
	exit();
}

// ELSE
// LOGIN LOGIC BEFORE ANY OUTPUT
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signin-button']))
{
	include 'connect.php';
	include 'Includes/functions/functions.php';
	$username = test_input($_POST['username']);
	$password = test_input($_POST['password']);
	$hashedPass = sha1($password);
	$stmt = $con->prepare("Select user_id, username,password from users where username = ? and password = ?");
	$stmt->execute(array($username,$hashedPass));
	$row = $stmt->fetch();
	$count = $stmt->rowCount();
	if($count > 0)
	{
		$_SESSION['username_yahya_car_rental'] = $username;
		$_SESSION['password_yahya_car_rental'] = $password;
		$_SESSION['user_id_yahya_car_rental'] = $row['user_id'];
		header('Location: dashboard.php');
		die();
	}
	// If login fails, set a flag to show error after HTML starts
	$login_error = true;
}

$pageTitle = 'Admin Login';
include 'connect.php';
include 'Includes/functions/functions.php';
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin Login</title>
		<!-- FONTS FILE -->
		<link href="Design/fonts/css/all.min.css" rel="stylesheet" type="text/css">

		<!-- Nunito FONT FAMILY FILE -->
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

		<!-- CSS FILES -->
		<link href="Design/css/sb-admin-2.min.css" rel="stylesheet">
		<link href="Design/css/main.css" rel="stylesheet">
	</head>
	<body>
		<div class="login">
			<form class="login-container validate-form" name="login-form" method="POST" action="index.php">
				<span class="login100-form-title p-b-32">
					Admin Login
				</span>

				<!-- PHP SCRIPT WHEN SUBMIT -->

				<?php if(isset($login_error) && $login_error): ?>
				<div class="alert alert-danger">
					<button data-dismiss="alert" class="close close-sm" type="button">
						<span aria-hidden="true">×</span>
					</button>
					<div class="messages">
						<div>Username and/or password are incorrect!</div>
					</div>
				</div>
				<?php endif; ?>

				<!-- USERNAME INPUT -->

				<div class="form-input">
					<span class="txt1">Username</span>
					<input type="text" name="username" class = "form-control" autocomplete="off">
				</div>
				
				<!-- PASSWORD INPUT -->

				<div class="form-input">
					<span class="txt1">Password</span>
					<input type="password" name="password" class="form-control" autocomplete="new-password">
				</div>
				
				<!-- SIGN IN BUTTON -->

				<p>
					<button type="submit" name="signin-button" >Sign In</button>
				</p>

				<!-- FORGOT YOUR PASSWORD LINK -->

				<span class="forgotPW">Forgot your password ? <a href="#">Reset it here.</a></span>
			</form>
		</div>
		
		<!-- Footer -->
		<footer class="sticky-footer bg-white">
			<div class="container my-auto">
		  		
			</div>
	  	</footer>
		<!-- End of Footer -->

		<!-- INCLUDE JS SCRIPTS -->
		<script src="Design/js/jquery.min.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="Design/js/bootstrap.bundle.min.js"></script>
		<script src="Design/js/sb-admin-2.min.js"></script>
		<script src="Design/js/main.js"></script>
	</body>
</html>
