<?php 
session_start(); 
include "db.php";

$username = ($_POST['username']);
$pass = ($_POST['password']);

$sql = "SELECT * FROM useradmin WHERE username='$username' AND password='$pass'";

$result = mysqli_query($mysqli, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['username'] === $username && $row['password'] === $pass) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['adminid'] = $row['adminid'];

        if (isset($_SESSION['adminid'])) {
            $adminid = $_SESSION['adminid'];

            $sql = "SELECT adminid FROM useradmin WHERE adminid = '$adminid'";

            $result = mysqli_query($mysqli, $sql);

            if (mysqli_num_rows($result) === 1) {
                foreach ($result as $row) {
                    header("Location: admindashboard.php");
                }
            }
        }

        exit();
    } else {
        header("Location: adminlogin.php?error=Incorrect username or password");
        exit();
    }
} else {
    header("Location: adminlogin.php?error=Incorrect username or password");
    exit();
}
?>