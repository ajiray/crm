<?php 
session_start(); 
include "db.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$email = validate($_POST['email']);
	$pass = validate($_POST['password']);

	
		// hashing the password
        $pass = md5($pass);

        
		$sql = "SELECT * FROM user WHERE emailadd='$email' AND password='$pass'";

		$result = mysqli_query($mysqli, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['emailadd'] === $email && $row['password'] === $pass) {
            	$_SESSION['email'] = $row['emailadd'];
            	$_SESSION['customer_id'] = $row['customer_id'];
				
				if(isset($_SESSION['customer_id'])){
                    $customerid = $_SESSION['customer_id'];
					
					$sql = "SELECT customer_id FROM user WHERE customer_id = '$customerid'";
                    
                    $result = mysqli_query($mysqli, $sql);
            
                    if(mysqli_num_rows($result)===1)
                    {
                        foreach($result as $row)
                        {
                            header("Location: shop.php");
                        }
                    } 
                } 
            	
		        exit();
            }else{
				header("Location: index.php?error=Incorrect Email or password");
		        exit();
			}
		}else{
			header("Location: index.php?error=Incorrect Email or password");
	        exit();
		}
	}
	
else{
	header("Location: index.php");
	exit();
}