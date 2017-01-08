<?php

	session_start();

	ob_start();

	include($_SERVER['DOCUMENT_ROOT'] . '/Socialize/include/DBConnect.php');
	$con = new DB_Connect();
    $db = $con->connect();

    $user = $_GET['user'];

    $query = "DELETE FROM `following` WHERE `user_name` = '".$_SESSION['username']."' AND `following` = '".$user."'";
	$row = mysqli_query($db, $query);
	$query = "DELETE FROM `follower` WHERE `user_name` = '".$user."' AND `follower` = '".$_SESSION['username']."'";
	$row = mysqli_query($db, $query);

	ob_clean();

	echo "Follow";

	mysqli_close($db);

?>