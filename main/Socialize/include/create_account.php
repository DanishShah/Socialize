<!DOCTYPE html>
<html>
<body>
<?php

	session_start();

	$_SESSION['username'] = $_POST['username'];
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['password'] = $_POST['password'];

	header("Location: http://www.socialize.16mb.com/Socialize/edit_info.html");
?>	
</body>
</html>
