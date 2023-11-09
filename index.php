<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login & Registration</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="background">
      <img src="bavkground.jpg" alt="">
    </div>
	<div class="container">
  <div class="logo">
      <img src="public/external/logo.png" alt="">
      </div>
		<div id="LoginAndRegistrationForm">
			<h1 id="formTitle">Login</h1>
			<div id="formSwitchBtn">
				<button onclick="ShowLoginForm()"  id="ShowLoginBtn" class="active">Login</button>
				<button onclick="ShowRegistrationForm()"  id="ShowRegistrationBtn">Registration</button>
			</div>
			<div id="LoginFrom">
				<form action="login.php" method="post">
					<div class="center">
          <?php if (isset($_GET['error'])) { ?>
     		<p class="error-message"><?php echo $_GET['error']; ?></p>
     		<?php } ?>
						<input id="LoginEmail" class="input-text" type="text" placeholder="Email Address" name="email"> 
						<input id="LoginPassword" class="mt-10 input-text" type="password" placeholder="Password" name="password">
					</div>


					<div class="center mt-20">
						<input class="Submit-Btn" type="submit" value="Login" id="LoginBtn">
					</div>
				</form>
				<p class="center mt-20 dont-have-account">
					Don't have an account? 
					<a href="JavaScript:void(0);" onclick="ShowRegistrationForm()">Registration now</a>
				</p>
			</div>
			<div id="RegistrationFrom">
				<form action="process-signup.php" method="post">
					<div class="center">
          <?php if (isset($_GET['error'])) { ?>
     		<p class="error-message"><?php echo $_GET['error']; ?></p>
     		<?php } ?>
						<input id="RegiName" class="input-text" type="text" placeholder="Full Name" name="fullname">
						<input id="RegiEmailAddres" class="input-text mt-10" type="email" placeholder="Email Address" name="emailadd">
            <p class="textbday">Birthday</p>
            <input id="Birthday" class="input-text mt-10" type="date" placeholder="Birthday" name="bday">
            <input id="ContactNumber" class="input-text mt-10" type="text" placeholder="Contact Number" name="contactnum">
            <input id="Address" class="input-text mt-10" type="text" placeholder="Address" name="address">
            <input id="Age" class="input-text mt-10" type="number" placeholder="Age" name="age">
            <input id="Gender" class="input-text mt-10" type="text" placeholder="Gender" name="gender">
						<input id="RegiPassword" class="mt-10 input-text" type="password" placeholder="Password" name="password">
						<input id="RegiConfirmPassword" class="mt-10 input-text" type="password" placeholder="Confirm Password" name="confirmpass">
					</div>
          <p class="center mt-20 dont-have-account">
          "By Clicking Create Account You are allowing your information to be used for sales purposes, Your Data will be privatized and be only viewed for business purposes"
          </p>
					<div class="center mt-20">
						<input class="Submit-Btn" type="submit" value="Create Account" id="RegistrationitBtn">
					</div>
				</form>
				<p class="center mt-20 already-have-account">
					Already have an account? 
					<a href="#" onclick="ShowLoginForm()">Login now</a>
				</p>
			</div>
			<div id="ForgotPasswordForm">
				<form action="">
					<div class="center mt-20">
						<input class="input-text " type="email" id="forgotPassEmail" placeholder="Email Address">
					</div>
					<div class="center mt-20">
						<input class="Submit-Btn" type="submit" value="Reset Password" id="PasswordResetBtn" >
					</div>
				</form>
				<p class="center mt-20 already-have-account">
					Back to the 
					<a href="JavaScript:void(0);" onclick="ShowLoginForm()">Login page</a> | <a href="JavaScript:void(0);" onclick="ShowRegistrationForm()">Registration page</a>
				</p>
			</div>
		</div>
	</div>

	<script src="main.js" type="text/javascript"></script>
	<script src="validation.js" type="text/javascript"></script>
</body>
</html>