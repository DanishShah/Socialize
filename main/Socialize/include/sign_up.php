<!DOCTYPE html>
<html>
<body>
<?php

	session_start();

	include($_SERVER['DOCUMENT_ROOT'] . '/Socialize/include/DBConnect.php');
	$con = new DB_Connect();
    $db = $con->connect();

    $ftp_server = "ftp.socialize.16mb.com";
    $ftp_user = "u218526953.user";
    $ftp_pass = "123456";

    $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to server $ftp_server");
    $ftp_login = ftp_login($ftp_conn, $ftp_user, $ftp_pass);
	
	$email = $_SESSION['email'];
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	$dp_name = $_POST['dp_name'];
	$bio = $_POST['bio'];	
	$db_path = "/Socialize/images/".$username;
	$file_target = $_SERVER['DOCUMENT_ROOT'].$db_path;

	mkdir($file_target, 0777);
	mkdir($file_target."/prof_pic", 0777);

	chmod($file_target, 0777);
	chmod($file_target."/prof_pic", 0777);


	if (isset($_POST['dp_name']) && isset($_POST['bio']) && isset($_FILES['prof_pic'])) {

		$file_name = $_FILES['prof_pic']['name'];
		$file_size = $_FILES['prof_pic']['size'];
		$file_tmp = $_FILES['prof_pic']['tmp_name'];
		$file_type = $_FILES['prof_pic']['type'];

		echo $file_name;

		$ext = pathinfo($file_name, PATHINFO_EXTENSION);

		$file_name = "prof_pic.".$ext;		

		echo $file_name;

		move_uploaded_file($file_tmp, $file_target."/prof_pic/".$file_name);

		if (is_uploaded_file($file_tmp)) {
			echo "File Uploaded";
		}else{
			echo "File Not Uploaded";
		}	


		$query = "INSERT INTO users (user_name, name, email, password, prof_pic, bio) VALUES ('$username', '$dp_name', '$email', '$password', '".$db_path."/prof_pic/".$file_name."', '$bio')";
		$res = mysqli_query($db, $query);

		if ($res) {
			echo "Data Inserted";

			$following_query = "INSERT INTO `following`(`user_name`, `following`) VALUES ('$username','socialize')";
	        mysqli_query($db, $following_query);
	        $follower_query = "INSERT INTO `follower`(`user_name`, `follower`) VALUES ('socialize','$username')";
	        mysqli_query($db, $follower_query);

            header("Location: http://www.socialize.16mb.com/Socialize/include/suggestion.php");
            exit();
		}else{
			echo ("Error: " . mysqli_error($db));
		}
		

		} else {
            echo "Enter the data";
        }

	mysqli_close($db);
	ftp_close($ftp_conn);

?>	
</body>
</html>