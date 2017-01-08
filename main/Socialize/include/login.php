<?php

	session_start();
	ob_start();
	
	include($_SERVER['DOCUMENT_ROOT'] . '/Socialize/include/DBConnect.php');
	$con = new DB_Connect();
    $db = $con->connect();

	$username = $_GET['user_name'];
	$password = $_GET['pass'];
				
	$query = "SELECT * FROM `users` WHERE `user_name` = '$username'";
	$res = mysqli_query($db, $query);        
    $user = mysqli_fetch_assoc($res);  
    ob_clean();
    if (count($user) > 0) {
    	if($user["password"] == $password){				
			$_SESSION['username'] = $username;	
			ob_clean();		
			echo "Verified";			
		}else{			
			ob_clean();
			echo "Password Incorrect";
		}
    }else{    	
    	ob_clean();
    	echo "Username Not Valid";
    }		

	mysqli_close($db);

?>