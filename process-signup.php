<?php

if ( ! filter_var($_POST["emailadd"], FILTER_VALIDATE_EMAIL)) {
    header("Location: index.php?error=Valid email is required");
	exit();
}

if (strlen($_POST["password"]) < 8) {
    header("Location: index.php?error=Password must be at least 8 characters");
	exit();
}

if ($_POST["password"] !== $_POST["confirmpass"]) {
    header("Location: index.php?error=Passwords must match");
	exit();
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);




$mysqli = require __DIR__ . "/db.php";

$email = $_POST["emailadd"];
$pass = $_POST["password"];
$bday = $_POST["bday"];
$name = $_POST["fullname"];
$add = $_POST["address"];
$age = $_POST["age"];
$gender = $_POST["gender"];
$contnum = $_POST["contactnum"];

$pass = md5($pass);

$sql = "SELECT * FROM user WHERE emailadd='$email' ";
		$result = mysqli_query($mysqli, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: index.php?error=Email already used");
	exit();
		}else {
           $sql2 = "INSERT INTO user(emailadd,name,birthday,address,age,gender,contactnum,password) VALUES('$email','$name','$bday','$add','$age','$gender','$contnum','$pass')";
           $result2 = mysqli_query($mysqli, $sql2);
           if ($result2) {
            echo "<script>alert('Account successfully created!');</script>";
        echo "<script>setTimeout(function(){window.location.href='index.php'}, 1000);</script>";
            exit();
          }else {
	           	header("Location: index.php?error=Unknown error occurred");
		        exit();
           }
        }









