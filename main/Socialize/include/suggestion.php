<?php 

	session_start();	

	include($_SERVER['DOCUMENT_ROOT'] . '/Socialize/include/DBConnect.php');
	$con = new DB_Connect();
    $db = $con->connect();
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Socialize</title>

		<script src="https://use.fontawesome.com/ce2f362aa8.js"></script>

		<link href='https://fonts.googleapis.com/css?family=Open+Sans:600' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">		

	<script type="text/javascript">
			function ffe(user, id){
				var action_txt = document.getElementById(id).innerHTML;
				console.log(action_txt);
				switch(action_txt){					
					case "Follow":
						follow(user, id);
						break;
					case "Following":
						unfollow(user, id);
						break;
				}
			}

			function follow(user, id){
				var ajax = new XMLHttpRequest();

				ajax.onreadystatechange = function(){
						if (this.readyState == 4 && this.status == 200) {
							var text = this.responseText;
							console.log(text);
							document.getElementById(id).innerHTML = text;
							document.getElementById(id).className = "btn_edit_prof";
						}
					} 

				ajax.open("POST", "/Socialize/include/follow.php?user=" + user, true);
				ajax.send();

			}

			function unfollow(user, id){
				var ajax = new XMLHttpRequest();

				ajax.onreadystatechange = function(){
						if (this.readyState == 4 && this.status == 200) {
							var text = this.responseText;
							console.log(text);
							document.getElementById(id).innerHTML = text;
							document.getElementById(id).className = "btn_follow";							
						}
					} 

				ajax.open("POST", "/Socialize/include/unfollow.php?user=" + user, true);
				ajax.send();

			}			

	</script>


	<style>
		:root{
			
			--100: #FAFAFA;
			--200: #F5F5F5;
			--300: #EEEEEE;
			--400: #E0E0E0;
			--500: #616161;
			--600: #212121;
			--green: #A7FFEB;

		}
		body{
			background-color: var(--100);
			padding: 0 ;
			margin: 0 ;			
		}

		a{
			text-decoration: none;
			font-style: none;
		}	

		#navbar{
			width: 100%;
		}
		
		#toolbar{
			position: relative;		
			overflow: hidden;
			width: 100%;
			z-index: 1;
			list-style-type: none;
			background-color: var(--200);
			padding: 0;
			margin: 0;
			display: block;
			box-shadow: 0 2px 2px 0 rgba(0,0,0,0.2);
		}

		.tool_items{
			text-decoration: none;
			float: right;
			padding: 20px 16px;
			display: inline-flex;
			font-family: 'Roboto', sans-serif;
		}

		.tool_items a{
			color: var(--500);
		}

		.tool_items:hover{
			background-color: var(--200);
		}


		#title{
			float:left;
			padding: 5px 20px;
			margin: 0;
			font-family: 'Pacifico', cursive;
			font-size: 30px;	

		}

		#title a{
			color: var(--500);
		}

		#search_item{
			width: 50%;
			margin: auto;
			display: inline-block;
			padding: 13px 10%;
		}

		#search{
			outline: 0;
			border: none;
			padding: 5px 10px;
			font-family: 'Roboto', sans-serif;
			color: var(--500);
			border-radius: 3px;
			display: inline-flex;
			width: 100%;
			height: 30px;
			box-shadow: 0 1px 1px 0 rgba(0,0,0,0.2);
		}

		.prof_pic_213{
			width: 20px;
			height: 20px;
			border-radius: 50%;
		}

		#container{
			position: relative;
			width: 100%;
			height: 100%;
			max-width: 800px;
			margin: auto;
		}

		li{
			list-style-type: none;
		}

		.prof_pic {
			float: left;
		    position: relative;
		    width: 40px;
		    height: 40px;
		    margin-right: 10px;
		    border-radius: 50%;
		    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.2);
		}

		#details{
			position: relative;
			display: inline-block;
		}
		.name{
		    position: relative;
		    padding: 0;
		    margin: 0;
		    font-size: 20px;
		    font-family: 'Roboto', sans-serif;
		}

		.bio{
		    position: relative;
		    padding: 0;
		    margin: 0;
		    font-size: 16px;
		    font-family: 'Roboto', sans-serif;
		}

		.btn_follow {
		    position: relative;
		    outline: 0;
		    background-color: var(--green);
		    font-family: 'Open Sans', sans-serif;
		    font-size: 16px;
		    color: var(--100);
		    border: none;
		    padding: 3px;
		    width: 100px;
		    height: 40px;
		    border-radius: 0px;
		    float: right;
		}

		.profile{
			position: relative;
			margin: 10px;
			padding: 10px;
		}

		.btn_edit_prof{
			outline: 0;
			background-color: var(--400);
			font-family: 'Open Sans', sans-serif;
			font-size: 16px;
			color: var(--100);
			border: none;
			padding: 3px;
			width: 100px;
			height: 40px;
			border-radius: 0px;			
			float: right;
		}

		#news_feed{
			background-color: var(--500);
			font-family: 'Open Sans', sans-serif;
			font-size: 16px;
			color: var(--100);
			border: none;
			padding: 3px;
			width: 100px;
			height: 40px;
			border-radius: 0px;
		}	

		
	</style>
	</head>

	<body>	
		
		
		<section>				

			<?php		

			$query_2 = "SELECT `prof_pic`FROM `users` WHERE `users`.`user_name` = '".$_SESSION['username']."'";
			$user_prof = mysqli_query($db, $query_2);

			$prof = mysqli_fetch_assoc($user_prof);

			echo "<nav>
			 	<div id=\"navbar\">		
					<ul id=\"toolbar\">
						<li id=\"search_item\"><input id=\"search\" type=\"text\" name=\"search\" placeholder=\"Search\"></li>
						<li id=\"title\"><a href=\"/Socialize/include/news_feed.php\">Socialize</a></li>
						<li class=\"tool_items\"><a href=\"/Socialize/include/profile.php?user=".$_SESSION['username']."\"><img class=\"prof_pic_213\" src=\"".$prof['prof_pic']."\"></a></li>
						<li class=\"tool_items\"><a href=\"#notification\"><i class=\"fa fa-bell-o fa-fw\" aria-hidden=\"true\"></i></a></li>
					</ul>
				</div>
			</nav>";		
				
			?>

			<main>		 	

			<div id="container">

			<?php

			$query = "SELECT * FROM  `users` WHERE `user_name` != 'socialize' AND `user_name` != '".$_SESSION['username']."' ORDER BY  `users`.`_id` ASC LIMIT 0 , 50";
			$result = mysqli_query($db, $query);

			while ($user = mysqli_fetch_assoc($result)) {
				
				echo "<div class=\"profile\">
						<div><img class=\"prof_pic\" src=\"".$user['prof_pic']."\"></div>
						<div id=\"details\">
							<p class=\"name\">".$user['name']."</p>
							<p class=\"bio\">".$user['bio']."</p>
						</div>
						<span><button onclick=\"ffe('".$user['user_name']."', '".$user['_id']."')\" id=\"".$user['_id']."\" class=\"btn_follow\">Follow</button></span>						
				</div>";

			}
			

			mysqli_close($db);

			?>		

			</div>
				<center>

				<div>
					<button onclick="news_feed()" id="news_feed">Let's Go</button>
				</div>

				</center>

			</main>

			<script type="text/javascript">
				function news_feed(){
					window.location.href = "/Socialize/include/news_feed.php";
				}
			</script>

		 </section>
		 
	</body>

</html>