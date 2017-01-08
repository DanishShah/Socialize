<?php

	session_start();

	unset($_SESSION['username']);

	header("Location: http://www.socialize.16mb.com/Socialize/include/news_feed.php");
?>
