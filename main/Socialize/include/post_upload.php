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
	
	
	$username = $_SESSION['username'];
	$caption = $_POST['caption'];
	$location = $_POST['location'];
	$db_path = "/Socialize/images/".$username;
	$file_target = $_SERVER['DOCUMENT_ROOT'].$db_path;
        
        if (!file_exists($file_target)){
	mkdir($file_target, 0777);
	mkdir($file_target."/prof_pic", 0777);

	chmod($file_target, 0777);
	chmod($file_target."/prof_pic", 0777);	
        }
	

	if (isset($_FILES['prof_pic'])) {

		$file_name = $_FILES['prof_pic']['name'];
		$file_size = $_FILES['prof_pic']['size'];
		$file_tmp = $_FILES['prof_pic']['tmp_name'];
		$file_type = $_FILES['prof_pic']['type'];

		move_uploaded_file($file_tmp, $file_target."/".$file_name);

		if (is_uploaded_file($file_tmp)) {
			echo "File Uploaded";
		}else{
			echo "File Not Uploaded";
		}

		$query_1 = "SELECT * FROM `users` WHERE `users`.`user_name` = \"".$username."\""; 
		$res_1 = mysqli_query($db, $query_1);
		$name = mysqli_fetch_assoc($res_1);


		$query = "INSERT INTO `post`(`user_name`, `name`, `location`, `pic`, caption) VALUES ('$username','".$name['name']."','$location','".$db_path."/".$file_name."','$caption')";
				
		$res = mysqli_query($db, $query);

		if ($res) {
			echo "Data Inserted";
            header("Location: http://www.socialize.16mb.com/Socialize/include/news_feed.php");
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