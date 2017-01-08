<?php 

	session_start();

	include($_SERVER['DOCUMENT_ROOT'] . '/Socialize/include/DBConnect.php');
	$con = new DB_Connect();
    $db = $con->connect();

	$user = $_GET['user'];

	function pluralize( $count, $text ) {
	    return $count . ( ( $count <= 1 ) ? ( " $text" ) : ( " ${text}s" ) );
	}


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
			function ffe(user){
				var action_txt = document.getElementById("btn_ffe").innerHTML;
				console.log(action_txt);
				switch(action_txt){					
					case "Follow":
						follow(user);
						break;
					case "Following":
						unfollow(user);
						break;
				}
			}

			function follow(user){
				var ajax = new XMLHttpRequest();

				ajax.onreadystatechange = function(){
						if (this.readyState == 4 && this.status == 200) {
							var text = this.responseText;
							console.log(text);
							document.getElementById("btn_ffe").innerHTML = text;
							document.getElementById("btn_ffe").className = "btn_edit_prof";
						}
					} 

				ajax.open("POST", "/Socialize/include/follow.php?user=" + user, true);
				ajax.send();

				updateFollowerCount(user);
			}

			function unfollow(user){
				var ajax = new XMLHttpRequest();

				ajax.onreadystatechange = function(){
						if (this.readyState == 4 && this.status == 200) {
							var text = this.responseText;
							console.log(text);
							document.getElementById("btn_ffe").innerHTML = text;
							document.getElementById("btn_ffe").className = "btn_follow";							
						}
					} 

				ajax.open("POST", "/Socialize/include/unfollow.php?user=" + user, true);
				ajax.send();

				updateFollowingCount(user);
			}

			function updateFollowerCount(user){
				var ajax = new XMLHttpRequest();

				ajax.onreadystatechange = function(){
						if (this.readyState == 4 && this.status == 200) {
							var count = this.responseText;
							console.log(count);
							document.getElementById("follower_count").innerHTML = count;							
						}
					} 

				ajax.open("POST", "/Socialize/include/follower_count.php?user=" + user, true);
				ajax.send();
				
			}

			function updateFollowingCount(user){
				var ajax = new XMLHttpRequest();

				ajax.onreadystatechange = function(){
						if (this.readyState == 4 && this.status == 200) {
							var count = this.responseText;
							console.log(count);
							document.getElementById("follower_count").innerHTML = count;							
						}
					} 

				ajax.open("POST", "/Socialize/include/follower_count.php?user=" + user, true);
				ajax.send();
				
			}

	</script>

	<style type="text/css">
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
			-webkit-user-select: none;
		}	
		
		#toolbar{	
			position: relative;		
			overflow: hidden;
			width: 100%;
			list-style-type: none;
			background-color: var(--200);
			padding: 0;
			margin: 0;
			display: block;
			box-shadow: 0 1px 1px 0 rgba(0,0,0,0.2);
			-webkit-user-select: none;
		}

		.tool_items{
			text-decoration: none;
			float: right;
			padding: 20px 16px;
			font-family: 'Roboto', sans-serif;
			-webkit-user-select: none;
		}

		.tool_items a{
			color: var(--500);
			-webkit-user-select: none;
		}		

		#title{
			float:left;
			padding: 5px 20px;
			font-family: 'Pacifico', cursive;
			font-size: 30px;	
			-webkit-user-select: none;
		}

		#title a{
			color: var(--500);
			-webkit-user-select: none;
		}

		#search_item{
			display: inline-block;
			padding: 13px 10%;
			-webkit-user-select: none;
		}

		#search{
			border: none;
			outline: 0;
			padding: 5px 10px;
			font-family: 'Roboto', sans-serif;
			border-radius: 3px;
			width: 400%;
			height: 30px;
			box-shadow: 0 1px 1px 0 rgba(0,0,0,0.2);
			-webkit-user-select: none;
		}

		main{
			margin: auto;
			width: 100%;
			height: 100%;
		}

		#profile{
			position: relative;
			width: 100%;
			min-width: 800px;
			height: auto;
			padding: 10px;
			margin-top: 20px;
			-webkit-user-select: none;
		}

		#profile_desc{
			display: inline-block;
			width: 100%;
			-webkit-user-select: none;
		}

		#prof_pic{			
			width: 200px;
			height: 200px;
			padding: 0;
			border-radius: 50%;
			box-shadow: 0 4px 4px 0 rgba(0,0,0,0.2);
			-webkit-user-select: none;
		}

		#prof_pic123{			
			width: 20px;
			height: 20px;
			padding: 0;
			border-radius: 50%;
			-webkit-user-select: none;
		}


		.desc_container{
		}

		#name{			
			padding: 0;
			margin: 0;
			font-size: 35px;
			font-family: 'Roboto', sans-serif;
			-webkit-user-select: none;
		}

		#bio{
			padding: 0;
			margin: 0;
			font-size: 20px;
			font-family: 'Roboto', sans-serif;
			text-decoration: none;
			-webkit-user-select: none;
		}

		#bio a{
			color: var(--300);
			-webkit-user-select: none;
		}

		li{
			list-style-type: none;
			-webkit-user-select: none;
		}

		#pics_container{
			width: 100%;
			max-width: 1000px;
			-webkit-user-select: none;
		}

		.pics{
			position: relative;
			margin: 10px;
			float: left;
			width: 100%;
			height: 100%;
			max-width: 300px;
			max-height: 300px;
			display: inline-flex;
			-webkit-user-select: none;
		}

		.pic_detail{
			position: absolute;
		    display: none;
		    width: 100%;
		    float: left;
		    max-width: 300px;
		    height: 100%;
		    max-height: 300px;
		    margin: 10px;
		    background-color: rgba(0,0,0,0.2);
		    -webkit-user-select: none;
		}
		
		.like_img{
		    margin-left: 30%;
		    margin-top: 40%;
		    width: 48px;
		    height: 48px;
		    -webkit-user-select: none;
		}

		.like_count_text{
			margin-left: 2%;
		    margin-top: 43%;
		    font-size: 25px;
		    font-family: 'Roboto', sans-serif;
		    color: white;
		    -webkit-user-select: none;
		}

		.pic_detail:hover{
			display: inline-flex;
			-webkit-user-select: none;
		}

		.tool_items123{
			text-decoration: none;
			padding: 20px 16px;
			float: right;
			font-family: 'Roboto', sans-serif;
			-webkit-user-select: none;
		}

		.btn_follow{
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
			-webkit-user-select: none;	
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
			-webkit-user-select: none;		
		}

		#ad123{
			display: inline-block;		
			padding: 0;
			-webkit-user-select: none;	
		}

	</style>
</head>
<body>

	<section>

		<?php
			
			if ($_SESSION['username']==$user) {				

				echo "<nav>
				 	<div id=\"navbar\">		
						<ul id=\"toolbar\">
							<li id=\"search_item\"><input id=\"search\" type=\"text\" name=\"search\" placeholder=\"Search\"></li>
							<li id=\"title\"><a href=\"/Socialize/include/news_feed.php\">Socialize</a></li>
							<li class=\"tool_items\"><a href=\"/Socialize/include/logout.php\"><i class=\"fa fa-sign-out fa-fw\" aria-hidden=\"true\"></i></a></li>
							<li class=\"tool_items\"><a href=\"#notification\"><i class=\"fa fa-bell-o fa-fw\" aria-hidden=\"true\"></i></a></li>
						</ul>
					</div>
				</nav>";

			}else{

				$query_2 = "SELECT `prof_pic`FROM `users` WHERE `users`.`user_name` = '".$_SESSION['username']."'";
				$user_prof = mysqli_query($db, $query_2);
				$prof = mysqli_fetch_assoc($user_prof);

				echo "<nav>
					 	<div id=\"navbar\">		
							<ul id=\"toolbar\">
								<li id=\"search_item\"><input id=\"search\" type=\"text\" name=\"search\" placeholder=\"Search\"></li>
								<li id=\"title\"><a href=\"/Socialize/include/news_feed.php\">Socialize</a></li>
								<li class=\"tool_items\"><a href=\"/Socialize/include/profile.php?user=".$_SESSION['username']."\"><img id=\"prof_pic123\" src=\"".$prof['prof_pic']."\"></a></li>
								<li class=\"tool_items\"><a href=\"#notification\"><i class=\"fa fa-bell-o fa-fw\" aria-hidden=\"true\"></i></a></li>
							</ul>
						</div>
					</nav>";							

			}

		?>

	<main>

		<div id="profile">


			<?php

			$query1 = "SELECT * FROM `users` WHERE `user_name` = \"".$user."\"";
			$result1 = mysqli_query($db, $query1);
			

			if ($result1 != null) {

				while ($data = mysqli_fetch_assoc($result1)) {

					echo "<center><div id=\"profile_desc\">
						<img id=\"prof_pic\" src=\"".$data['prof_pic']."\">
						<br><br>
						<div class=\"desc_container\">
						<p id=\"name\">".$data['name']."</p>						
						<p id=\"bio\">".$data['bio']."</p>
						</div>
					</div></center>";

				}

			}

			$query2 = "SELECT * FROM `post` WHERE  `user_name` =  \"".$user."\" ORDER BY  `post`.`time` ";
			$result2 = mysqli_query($db, $query2);
			$post_count = mysqli_num_rows($result2);

			$follower = "SELECT DISTINCT * FROM `follower` WHERE `user_name` = \"".$user."\"";
			$result = mysqli_query($db, $follower);
			$follower_count = mysqli_num_rows($result);

			$following = "SELECT DISTINCT * FROM `following` WHERE `user_name` = \"".$user."\"";
			$result = mysqli_query($db, $following);
			$following_count = mysqli_num_rows($result);

			if ($_SESSION['username'] == $user) {
				$btn_style = "btn_edit_prof";
				$btn_text = "Edit Profile";
			}else {				
				$chk_follo = "SELECT * FROM `following` WHERE `user_name` = '".$_SESSION['username']."' AND `following` = '".$user."'";
				$res_follo = mysqli_query($db, $chk_follo);
				if (mysqli_num_rows($res_follo) >= 1) {
					$btn_style = "btn_edit_prof";
					$btn_text = "Following";
				}else{
					$btn_style = "btn_follow";
					$btn_text = "Follow";
					
				}
			}
			
			echo "<center>

				<div id=\"details\">
					<ul id=\"ad123\">

						<li class=\"tool_items123\">
						<div>
							<span id=\"following_count\">".$following_count."</span>
							<p>FOLLOWINGS</p>
						</div>
						</li>
						
						<li class=\"tool_items123\">
						<div>
							<span id=\"follower_count\">".$follower_count."</span>
							<p>FOLLOWERS</p>
						</div>
						</li>
						
						<li class=\"tool_items123\">
						<div>
							<span>".$post_count."</span>
							<p>POST</p>
						</div>
						</li>
					</ul>
					<br><br><br>					

					<button onclick=\"ffe('".$user."')\" id=\"btn_ffe\" class=\"".$btn_style."\">".$btn_text."</button>
				</div>

				</center>";

		?>


		<br><br><br>
		<br><br><br>

		<div>
				<ul id="pics_container">

				<?php 

					$query2 = "SELECT * FROM `post` WHERE  `user_name` =  \"".$user."\" ORDER BY  `post`.`time` ";
					
					$result2 = mysqli_query($db, $query2);	
		


					if($result2 != null){						

						while($row = mysqli_fetch_assoc($result2)){

							$like_query = "SELECT DISTINCT `user_name` FROM  `likes` WHERE `likes`.`post_id` = ".$row['_id'];
							$like_row = mysqli_query($db, $like_query);

							$row_count = mysqli_num_rows($like_row);
							$row_count = pluralize($row_count, "like");
							
							echo "<li>
							<div class=\"pics\">

							<img onmouseover=\"showDetail(".$row['_id'].")\" class=\"pics\" src=\"".$row['pic']."\">
							<div onmouseout=\"hideDetail(".$row['_id'].")\" class=\"pic_detail\" id=\"".$row['_id']."\">								
								<img onmouseover=\"showDetail(".$row['_id'].")\" class=\"like_img\" src=\"/Socialize/liked_1x.png\">
								<p onmouseover=\"showDetail(".$row['_id'].")\" class=\"like_count_text\">".$row_count."</p>								
							</div>

							</div>

							</li>";

								
						}

					}

				mysqli_close($db);


				?>

				</ul onclick="ffe('hashim_hs46', 'Following')">


				<script type="text/javascript">
					
					function showDetail(post_id){
						var div = document.getElementById(post_id).style.display = "inline-flex";
					}

					function hideDetail(post_id){
						var div = document.getElementById(post_id).style.display = "none";
					}


				</script>
		</div>
	</div>

	</main>

	</section>

</body>
</html>