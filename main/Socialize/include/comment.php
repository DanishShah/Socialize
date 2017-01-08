<?php

	session_start();
	ob_start();

	include($_SERVER['DOCUMENT_ROOT'] . '/Socialize/include/DBConnect.php');
	$con = new DB_Connect();
    $db = $con->connect();

    $post_id = $_GET['post_id'];
    $comment = $_GET['comment'];

    if($comment != null){

	    $query = "INSERT INTO `comments`(`post_id`, `user_name`, `comment`) VALUES ('".$post_id."','".$_SESSION['username']."','".$comment."')";
		$row = mysqli_query($db, $query);
		ob_clean();
		if ($row != null) {
			echo "Inserted";
			header("Location: http://www.socialize.16mb.com/Socialize/include/news_feed.php");
			exit();
		}

	}else{
		header("Location: http://www.socialize.16mb.com/Socialize/include/news_feed.php");
		exit();
	}
	

	mysqli_close($db);

?>