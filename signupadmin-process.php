<?php
session_start(); 
include "db.php";

if ( ! filter_var($_POST["username"])) {
    exit();
}

if (strlen($_POST["password"]) < 8) {
    header("Location: admindashboard.php#section5?error=Password must be at least 8 characters");
    exit();
}

if ($_POST["password"] !== $_POST["confirmpassword"]) {
    header("Location: admindashboard.php#section5?error=Passwords must match");
    exit();
}

$username = $_POST["username"];
$pass = $_POST["password"];

$sql = "SELECT * FROM useradmin WHERE username='$username' ";
$result = mysqli_query($mysqli, $sql);

if (mysqli_num_rows($result) > 0) {
    header("Location: admindashboard.php#section5?error=Username already used");
    exit();
} else {
    $sql2 = "INSERT INTO useradmin(username,password) VALUES('$username','$pass')";
    $result2 = mysqli_query($mysqli, $sql2);
    if ($result2) {
        echo "<script>alert('Account successfully created!');</script>";
        echo "<script>setTimeout(function(){window.location.href='admindashboard.php#section5'}, 1000);</script>";
        exit();
    } else {
        echo "<script>setTimeout(function(){window.location.href='admindashboard.php#section5?error=Unknown error occurred'}, 1000);</script>";
        exit();
    }
}
?>








