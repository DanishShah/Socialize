<!DOCTYPE html>
<html>
	<head>
		<title>Socialize</title>

		<script src="https://use.fontawesome.com/ce2f362aa8.js"></script>

		<link href='https://fonts.googleapis.com/css?family=Open+Sans:600' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
		
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

		#navbar{
			width: 100%;
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

	</style>
	</head>

	<body>

		<section>	

			<nav>
			 	<div id="navbar">		
					<ul id="toolbar">
						<li id="search_item"><input id="search" type="text" name="search" placeholder="Search"></li>
						<li id="title"><a href="/Socialize/include/news_feed.php">Socialize</a></li>
						<li class="tool_items"><a href="/Socialize/profile.html"><i class="fa fa-user fa-fw" aria-hidden="true"></i></a></li>
						<li class="tool_items"><a href="#notification"><i class="fa fa-bell-o fa-fw" aria-hidden="true"></i></a></li>
					</ul>
				</div>
			</nav>

			<main>
				
				

			</main>

		</section>
		
	</body>
</html>