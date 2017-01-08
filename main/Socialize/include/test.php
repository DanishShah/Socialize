<?php 
	
include($_SERVER['DOCUMENT_ROOT'] . '/Socialize/include/DBConnect.php');
	$con = new DB_Connect();
    $db = $con->connect();

	$query = "SELECT * FROM `users`";
	$res = mysqli_query($db, $query);
	$result = array("success" => false);
	if ($res!=null) {
		
		$json = array();

		while ($user = mysqli_fetch_assoc($res)) {
			$json[] = $user;
		}

		$result['success'] = true;
		
		$result['user'] = $json;

		//echo json_encode($result);
				
	}else {
		echo "$result";
	}

	mysqli_close($db);


?>

<!DOCTYPE html>
<html>
<head>
	<title>Socialize</title>

	<script src="https://use.fontawesome.com/ce2f362aa8.js"></script>

		<link href='https://fonts.googleapis.com/css?family=Open+Sans:600' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">

	<style type="text/css">
		
		:root{
			
			--100: #FAFAFA;
			--200: #F5F5F5;
			--300: #EEEEEE;
			--400: #E0E0E0;
			--500: #616161;
			--600: #212121;
			
		}

		body{
			background-color: var(--100);
			padding: 0 ;
			margin: 0 ;			
		}

		.name{
			margin: 0;
			font-size: 20px;
			font-family: 'Roboto', sans-serif;
			color: var(--500);
		}

		.prof_pic{
			margin: 5px;
			float: left;
			width: 30px;
			height: 30px;
			border-radius: 50%;
			display: inline-block;			
			box-shadow: 0 2px 2px 0 rgba(0,0,0,0.2);
			
		}


	</style>
</head>
<body>

	<script type="text/javascript">
		var json = <?php echo json_encode($result); ?>;
		for(var i=0;i<json.user.length ;i++){
			var users = json.user[i];
			console.log(users.name + "\n" + users.prof_pic);

			var img = document.createElement("IMG");
			img.setAttribute("src", users.prof_pic);
			img.className += "prof_pic";
			document.body.appendChild(img);
			// var content_img = document.getElementById("profiles");
			// if (content_img != null) {
			// 	document.contetn_img.appendChild(img);
			// }

			var para = document.createElement("P");
			var text = document.createTextNode(users.name);
			para.appendChild(text);
			para.className += "name";
			document.body.appendChild(para);
			// var content_name = document.getElementById("prof_details");
			// if (content_name != null) {
			// 	document.content_name.appendChild(para);	
			// }
			

			
		}


	</script>

	<div id="profiles">		
		<div id="prof_details">
		</div>
	</div>
		
</body>
</html>
