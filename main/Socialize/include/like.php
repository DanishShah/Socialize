<?php

	session_start();
	ob_start();

	include($_SERVER['DOCUMENT_ROOT'] . '/Socialize/include/DBConnect.php');
	$con = new DB_Connect();
    $db = $con->connect();

    $post_id = $_GET['post_id'];

    $query = "INSERT INTO `likes`(`post_id`, `user_name`) VALUES ('".$post_id."','".$_SESSION['username']."')";
	$row = mysqli_query($db, $query);
	ob_clean();
	if ($row!=null) {
		echo "INSERTED";
	}else {
		echo "NOT INSERTED";
	}

	mysqli_close($db);

?>