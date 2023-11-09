<?php 
session_start();
include "db.php";
$customer_id = $_SESSION['customer_id'];
   //Update Function
    if (isset($_POST['Save'])) {
        $id = $customer_id;
        $sql = "SELECT * from user where customer_id = $id";
        $result = mysqli_query($mysqli, $sql);
        $info = mysqli_fetch_assoc($result);
        $name = $_POST['name'];
        $cnumber = $_POST['cnumber'];
        $address = $_POST['address'];
        $bday= $_POST['bday'];
        $sql1 = "UPDATE user set name='$name', contactnum='$cnumber', address='$address', birthday='$bday' where customer_id = '$id'";
        $result1 = mysqli_query($mysqli, $sql1);
        if ($result1) {
            echo '<script type ="text/javascript"> alert("Profile Updated") </script>';
            echo '<script>';
            echo 'window.close();'; // Close the current window
            echo '</script>';
        } else {
            echo '<script type ="text/javascript"> alert("Profile Not Updated") </script>';
        }
    }

   ?>