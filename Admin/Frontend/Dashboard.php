<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link rel="icon" type="icon/img" href="images/Coat_of_arms_of_Ghana.svg.png">
	<link rel="stylesheet" type="text/css" href="styles/Dashboard.css">
	<link rel="stylesheet" type="text/css" href="styles/active.css">
	
</head>
<body>
	<header>
		<nav>
			<ul>
				<li>
					<img src="images/Coat_of_arms_of_Ghana.svg.png">
				</li>
				<li id="dash" >
					<a href="#" class="active">
						DashBoard
					</a>
				</li>
				<li>
					<a href="#">
						Events
					</a>
					
				</li>
				<li>
					<a href="#">
						Stadiums
					</a>
				</li>
				<li>
					<a href="#">
						Users
					</a>
					
				</li>
				<li>
					<button> 
						Logout
					</button>
				</li>
			</ul>
		</nav>
	</header>

	<main>
		
		<?php 
			require 'cards.php';

			card('Football Matches', 'images/Coat_of_arms_of_Ghana.svg.png', '200', 'addStadium.php', 'addStadium.php');
		?>

	</main>

</body>
</html>

