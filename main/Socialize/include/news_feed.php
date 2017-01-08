<?php 

	session_start();

	header('Access-Control-Allow-Origin: *');

	if($_SESSION['username']==null){
		header("Location: http://www.socialize.16mb.com/Socialize/login.html");
		exit();
	}

	include($_SERVER['DOCUMENT_ROOT'] . '/Socialize/include/DBConnect.php');
	$con = new DB_Connect();
    $db = $con->connect();

    $query = "SELECT * FROM  `post` ORDER BY  `post`.`time` DESC";
	$res = mysqli_query($db, $query);		

	function pluralize( $count, $text ) {
	    return $count . ( ( $count <= 1 ) ? ( " $text" ) : ( " ${text}s" ) );
	}

	function ago( $datetime ){

	    $interval = date_diff(date_create('now'), date_create($datetime) );
	    $suffix = ( $interval->invert ? ' ago' : '' );
	    if ( $v = $interval->y >= 1 ) return pluralize( $interval->y, 'year' ) . $suffix;
	    if ( $v = $interval->m >= 1 ) return pluralize( $interval->m, 'month' ) . $suffix;
	    if ( $v = $interval->d >= 1 ) return pluralize( $interval->d, 'day' ) . $suffix;
	    if ( $v = $interval->h >= 1 ) return pluralize( $interval->h, 'hour' ) . $suffix;
	    if ( $v = $interval->i >= 1 ) return pluralize( $interval->i, 'minute' ) . $suffix;
	    return pluralize( $interval->s, 'second' ) . $suffix;
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
			function validatePost(){
				var dp_pic = document.getElementById("chooser");
				var caption = document.getElementById("caption");
				var location = document.getElementById("location");

				console.log(caption.value);

				if (dp_pic.value != null && caption.value != "" && location.value != "") {
					document.getElementById("edit_form").action = "/Socialize/include/post_upload.php";
					return true;
				}else{
					if (caption.value == "") {
						caption.style.backgroundColor = "#ff8a80";
					}
					if (location.value == "") {
						location.style.backgroundColor = "#ff8a80";	
					}
					return false;
				}
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

		br{
			-webkit-user-select: none;
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
			-webkit-user-select: none;
		}

		#search_item{
			width: 50%;
			margin: auto;
			display: inline-block;
			padding: 13px 10%;
			-webkit-user-select: none;
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
			-webkit-user-select: none;
		}

		#post_container{
			overflow: auto;
			width: 100%;
			max-width: 800px;
			align-content: space-around;
			margin: auto;
			height: 100%;
			padding: 10px;
			padding-top: 50px;
		}

		.post{
			display: block;
			position: relative;
			margin-top: 30px;
			width: 100%;
			max-width: 800px;
			max-height: 1200px;
			height: auto;
			background-color: var(--100);
			border-radius: 3px;
			box-shadow: 0 2px 2px 0 rgba(0,0,0,0.2);
		}

		.post_header{
			padding: 20px;
			padding-bottom: 20px;
		}

		.prof_pic{
			width: 40px;
			height: 40px;
			border-radius: 50%;
			float: left;
			-webkit-user-select: none;
		}

		.prof_pic_213{
			width: 20px;
			height: 20px;
			border-radius: 50%;
			-webkit-user-select: none;
		}

		.name_box{
			display: inline-block;
			margin-left: 20px;
			-webkit-user-select: none;
		}

		.time{
			display: inline-block;
			float: right;
			margin-right: 10px;
			font-family: 'Roboto', sans-serif;
			color: var(--500);
			-webkit-user-select: none;
		}

		.name{
			margin: 0;
			font-size: 20px;
			font-family: 'Roboto', sans-serif;
			color: var(--500);
			-webkit-user-select: none;
		}

		.location{
			margin: 0;
			font-size: 15px;
			font-family: 'Roboto', sans-serif;
			color: var(--500);
			-webkit-user-select: none;
		}

		.post_pic{
			display: inline-block;
			width: 100%;
			height: 800px;
			box-shadow: 0 2px 2px 0 rgba(0,0,0,0.2);
			-webkit-user-select: none;
		}

		.post_activity{
			padding: 3%;
		}

		.like_container{
			display: inline-block;
			vertical-align: middle;
			padding: 5px;
		}

		.like_count{
			font-family: 'Roboto', sans-serif;
			color: var(--500);
			margin-top: 10px;
			float: right;
			-webkit-user-select: none;
		}

		.comments{
			list-style-type: none;
			padding: 0;
			margin-bottom: 10px;
			max-height: 150px;
			display: inline-flex;
			width: 100%;
			-webkit-user-select: none;
		}

		.caption{
			font-family: 'Roboto', sans-serif;
			color: var(--500);
			-webkit-user-select: none;
		}

		.caption_list{
			overflow: hidden;
			-webkit-user-select: none;
		}

		a{
			text-decoration: none;
			color: var(--500);
			-webkit-user-select: none;
		}

		.comment{
			font-family: 'Roboto', sans-serif;
			color: var(--500);
			-webkit-user-select: none;
		}

		li{
			list-style-type: none;
			padding: 5px;
			-webkit-user-select: none;
		}
		
		.post_footer{
			border-top: 1px solid var(--500);
			padding-top: 10px;
			height: auto;
		}

		.like_button{
			display: inline-block;
			float: left;
			margin-right: 10px;
			margin: 5px;
			width: 30px;
			-webkit-user-select: none;
		}			

		.comment_box {
			display: inline-block;
			height: auto;
			background-color: var(--100);
			border: none;
			-webkit-user-select: none;
		}

		footer{
			
		}

		nav{
			position: fixed;
    		width: 100%;
    		z-index: 1;
		}
		
		#fab{
			position: absolute;
			position: fixed;
			right: 16px;
			bottom: 16px;
			width: 56px;
			height: 56px;
			display: block;
			background-color: var(--500);
			box-shadow: 0 4px 4px 0 rgba(0,0,0,0.2);
			border-radius: 50%;		
			-webkit-user-select: none;	
		}

		#fab:hover{
			box-shadow: 0 4px 4px 0 rgba(0,0,0,0.4);
			background-color: #656565;
		}

		#create{
			position: absolute;
			left: 26%;
			top: 26%;			
		}

		#create_dialog {
		    display: none;
		    position: fixed;
		    z-index: 1;
		    overflow: auto;
		    left: 0;
		    right: 0;
		    top: 0;
		    bottom: 0;
		    background-color: rgba(0,0,0,0.4);
		    -webkit-user-select: none;
		}

		#dialog_content {
		    display: block;
		    border-radius: 3px;
		    background-color: var(--200);
		    margin: 7% auto;
		    padding: 20px;
		    width: 50%;
		    min-width: 600px;
		    height: 550px;
		    overflow: scroll;
		    box-shadow: 0 4px 4px 0 rgba(0,0,0,0.2);
		    -webkit-user-select: none;
		}

		#close{
			font-family: 'Roboto', sans-serif;
			float: right;
			-webkit-user-select: none;
		}

		#form {
		    position: absolute;
		    margin-bottom: 100px;
		    margin: 50px;
		    width: 100%;
		    max-width: 500px;
		}

		#prof_pic123{
			width: 200px;
			height: 200px;	
			-webkit-user-select: none;		
		}

		#chooser{
			width: 144.69px;
			height: 34px;
			opacity: 0;
			position: absolute;
			display: inline-block;
			-webkit-user-select: none;
		}

		#chooser_ph{
			border: 2px solid var(--500);
			border-radius: 5px;
			padding: 5px;
			display: inline-block;
			font-size: 18px;
			margin: 0;
			font-family: 'Roboto', sans-serif;
			-webkit-user-select: none;
		}

		#chooser_ph:hover{
			background-color: var(--500);
			color: #fff;
			transition-duration: 0.4s;
		}

		input[type="text"], textarea{
			background-color: var(--100);
			color: var(--500);
			-webkit-user-select: none;
		}

		input[type="password"], textarea{
			background-color: var(--100);
		}
		
		.in{
			border: none;
			font-family: 'Open Sans', sans-serif;
			padding: 10px;
			width: 300px;
			border-radius: 5px;
			color: var(--500);
			outline: 0;
			-webkit-user-select: none;
		}

		.in[placeholder]{
			color: var(--500);
			font-family: 'Open Sans', sans-serif;
		}	

		#save{
			background-color: var(--500);
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

		#comment_box{
			display: inline-block;
			border: none;
			font-family: 'Open Sans', sans-serif;
			padding: 10px;
			width: 80%;
			border-radius: 5px;
			color: var(--500);
			outline: 0;
			-webkit-user-select: none;
		}	

		#comment_box[placeholder]{
			color: var(--500);
			font-family: 'Open Sans', sans-serif;
		}

		#comment_button{
			float: right;
			background-color: var(--500);
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

		.show_comment {
		    height: 10px;
		    font-size: 15px;
		    font-family: 'Roboto', sans-serif;
		    color: var(--500);
		    display: block;
		    position: absolute;
		    right: 40px;
		    bottom: 90px;
		    -webkit-user-select: none;
		}

	</style>
	</head>

	<body>	
		
		
		<section>

			<div id="create_dialog">
				<section id="dialog_content">
					<header>
						<span onclick="closeDialog()" id="close">
							x
						</span>
					</header>

					<main>
						<center>
						
						<form id="form" method="post" enctype="multipart/form-data">
					
							<div>
								<img id="prof_pic123" src="/Socialize/prof_placeholder.png"><br><br>
								<div>
									<input id="chooser" type="file" name="prof_pic" onchange="handleFileSelect(this)">
									<p id="chooser_ph">Choose a picture</p>

									<script type="text/javascript">
											function handleFileSelect(evt) {
												if (evt.target.files != null) {
								       				var file = evt.target.files;
								       			}
								       			if (file) {
									       			var f = file[0];
									        		var reader = new FileReader();
											
									          		reader.onload = (function(theFile) {
									            		return function(e) {
									            		document.getElementById('prof_pic123').src = e.target.result;
									            		document.getElementById('prof_pic123').style.boxShadow = "0 2px 2px 0 rgba(0,0,0,0.2)";
									            		};
									          		})(f);
									    
									          		reader.readAsDataURL(f);
									          	}
								      		}	 

								      		document.getElementById('chooser').addEventListener('change', handleFileSelect, false);
									</script>
								</div>
							</div>
							
							<br><br>

							<div id="details">							
								<input class="in" id="caption" type="text" name="caption" placeholder="Caption"/><br><br>
								<input class="in" id="location" type="text" name="location" placeholder="Location"/>
								<br><br>
								<input id="save" type="submit" name="submit" onclick="return validatePost()" value="Post">
							</div>

						</form>
						</center>
					</main>
				</section>
			</div>

			<script type="text/javascript">
				var fab = document.getElementById("fab");

				var dialog = document.getElementById("create_dialog");

				var close = document.getElementById("close");

				function showDialog(){
					dialog.style.display = "block";
				}

				function closeDialog(){
					dialog.style.display = "none";
				}

			</script>

			<div onclick="showDialog()" id="fab">
				<img id="create" src="/Socialize/create.png">
			</div>			

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

			<main id="post_container">

				
			<?php

			if($res != null){

		    	while($post = mysqli_fetch_array($res, MYSQL_ASSOC)){

		    		$query_1 = "SELECT DISTINCT `user_name` FROM  `likes` where `likes`.`post_id` = '".$post['_id']."'";
		    		$like = mysqli_query($db, $query_1);

		    		$like_count = mysqli_num_rows($like);
		    		$like_count = pluralize($like_count, "like");

		    		$is_liked_by_user = False;		    		

		    		while ($pokemon = mysqli_fetch_assoc($like)) {
		    			for ($i=0; $i<$like_count; $i++){
			    			if($pokemon['user_name'] == $_SESSION['username']){
			    				$is_liked_by_user = True;
			    			}
		    			}
		    		}	    		

		    		if ($is_liked_by_user) {
		    			$like_icon = "/Socialize/liked_1x.png";
		    		} else {
		    			$like_icon = "/Socialize/like_1x.png";
		    		}

		    		$time = ago($post['time']);

		    		$q = "SELECT * FROM `users` WHERE `user_name` = '".$post['user_name']."'";
		    		$r = mysqli_query($db, $q);

		    		$a = mysqli_fetch_assoc($r);

		    		$comment_query = "SELECT * FROM `comments` WHERE `post_id` = ".$post['_id']." ORDER BY  `_id`";

		    		$comment_res = mysqli_query($db, $comment_query);

		    		echo "<div id=\"post_".$post['_id']."\" class=\"post\">
						<header class=\"post_header\">
							<a href=\"/Socialize/include/profile.php?user=".$post['user_name']."\"><img class=\"prof_pic\" src=\"".$a['prof_pic']."\"></a>				
							<div class=\"name_box\">
							<p class=\"name\" >".$post['name']."</p>
							<p class=\"location\">".$post['location']."</p>
							</div>
							<p class=\"time\">".$time."</p>
						</header>
						<div>
							<img ondblclick=\"likePost(".$post['_id'].")\" class=\"post_pic\" src=\"".$post['pic']."\" >				
						</div>

						<footer class=\"post_activity\">
							<section>
								<div class=\"like_container\">							
									<img class=\"".$post['_id']." like_button\" onclick=\"likePost(".$post['_id'].")\"src=\"".$like_icon."\" >							
									<p class=\"".$post['_id']." like_count\" ><b>".$like_count."</b></p>
								</div>
							</section>

							<div id=\"comment_".$post['_id']."\" class=\"comments\">
								<ul class=\"caption_list\">
								<li class=\"caption\"><a href=\"/Socialize/include/profile.php?user=".$post['user_name']."\"><b>".$post['user_name']."</b></a> :".$post['caption']." </li>";

									if ($comment_res != null) {										
									
									 	while ($comment_array = mysqli_fetch_assoc($comment_res)){									 		
									 		echo "<li class=\"caption\"><a href=\"/Socialize/include/profile.php?user=".
									 		$comment_array['user_name']."\"><b>".$comment_array['user_name']."</b></a> :".
									 		$comment_array['comment']." </li>";
			    		 				} 

		    		 				} echo"

								</ul>

								<p id=\"more_".$post['_id']."\" onclick=\"showComment(".$post['_id'].")\" class=\"show_comment\">more</p>						
								
							</div>

							<form method=\"GET\" action=\"comment.php\">

							<input onkeypress=\"return submitComment(event, ".$post['_id'].")\" id=\"comment_box\" type=\"text\" name=\"comment\" placeholder=\"Add a comment\">
							<input type=\"number\" style=\"display:none;\" name=\"post_id\" value=\"".$post['_id']."\">

							<input type=\"submit\" id=\"comment_button\" value\"Comment\"/>

							</form>
							
						</footer>

					</div>";

		    	}

		    }

			mysqli_close($db);

			?>

			<script type="text/javascript">

				function showComment(post_id){

					var post = document.getElementById("post_"+post_id);
					var comment = document.getElementById("comment_"+post_id);
					var more = document.getElementById("more_"+post_id);

					if (post.style.maxHeight != "none") {
						post.style.maxHeight = "none";
						comment.style.maxHeight = "none";
						more.innerHTML = "less";
					}else{
						post.style.maxHeight = "1200px";
						comment.style.maxHeight = "150px";
						more.innerHTML = "more";
					}

				}	

				function submitComment(e, post_id){
					if (e.keyCode == 13) {
						var comment_box = document.getElementById('comment_box');

						// if (comment_box != null){
						// 	var comment = comment_box.value;
						// 	console.log(comment);
						// 	var ajax = new XMLHttpRequest();

						// 	ajax.onreadystatechange = function(){
						// 		if (this.readyState == 4 && this.status == 200) {
						// 			console.log(this.responseText)
						// 			if (this.responseText == "Inserted") {
						// 				window.location.reload();
						// 			}
						// 		}
						// 	} 

						// 	ajax.open("GET", "/Socialize/include/comment.php?comment=" + comment + "&post_id=" + post_id, true);
						// 	ajax.send();

						// }

						return false;
					}
				}										

				function likePost(post_id){
					var ajax = new XMLHttpRequest();

					ajax.onreadystatechange = function(){
						if (this.readyState == 4 && this.status == 200) {
							console.log(this.responseText)
							if (this.responseText == "INSERTED") {
								updatePost(post_id);
							}
						}
					} 

					ajax.open("GET", "/Socialize/include/like.php?post_id=" + post_id, true);
					ajax.send();

					
				}

				function updatePost(post_id){
					var ajax1 = new XMLHttpRequest();

					ajax1.onreadystatechange = function(){
						if (this.readyState == 4 && this.status == 200) {
							var count = this.responseText;
							console.log(count);
							document.getElementsByClassName(post_id)[1].innerHTML = count;
							document.getElementsByClassName(post_id)[1].style.fontWeight = "bold";
							document.getElementsByClassName(post_id)[0].src = "/Socialize/liked_1x.png";
						}
					} 

					ajax1.open("POST", "/Socialize/include/like_count.php?post_id=" + post_id, true);
					ajax1.send();
				}

			</script>

			</main>	

			<footer>
				
			</footer>	


		 </section>
		 
	</body>

</html>