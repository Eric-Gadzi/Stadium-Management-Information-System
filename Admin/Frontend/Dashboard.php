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
			require "dashboard_cards/totals.php";

			// Users
			card('Users', 'images/user_icon.png', getTotalNumberOfUsers(), 'addStadium.php', 'addStadium.php');

			// stadiums
			card('Stadiums', 'images/football_stadium.svg', getTotalNumberOfStadiums(), 'addStadium.php', 'addStadium.php');

			// events
			card('Events', 'images/realCalender.svg', getTotalNumberOfEvents(), 'addStadium.php', 'addStadium.php');

			// Ticket
			card('Tickets', 'images/ticket.svg', getTotalNumberOfTickets(), 'addStadium.php', 'addStadium.php');

		?>

	</main>

</body>
</html>
