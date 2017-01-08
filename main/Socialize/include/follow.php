<?php

	session_start();

	ob_start();


	include($_SERVER['DOCUMENT_ROOT'] . '/Socialize/include/DBConnect.php');
	$con = new DB_Connect();
    $db = $con->connect();

    $user = $_GET['user'];

    $query1 = "INSERT INTO `following`(`user_name`, `following`) VALUES ('".$_SESSION['username']."','".$user."')";
	$row = mysqli_query($db, $query1);
	$query2 = "INSERT INTO `follower`(`user_name`, `follower`) VALUES ('".$user."','".$_SESSION['username']."')";
	$row = mysqli_query($db, $query2);

	ob_clean();

	echo "Following";

	mysqli_close($db);

?>