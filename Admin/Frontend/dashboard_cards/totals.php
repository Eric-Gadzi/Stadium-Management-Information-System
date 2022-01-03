<?php


	function getTotalNumberOfStadiums(){
		require ('C:\xampp\htdocs\Stadium_Management_Systems\Admin\Frontend\db_connection.php');
		$sql_stadiums = 'SELECT * FROM `stadium`';
		$stadium_result = $conn->query($sql_stadiums); 

		if($stadium_result){
			return mysqli_num_rows($stadium_result);

		}else{
			echo $conn->error();
		}

	}


	function getTotalNumberOfEvents(){
		require ('C:\xampp\htdocs\Stadium_Management_Systems\Admin\Frontend\db_connection.php');
		$sql_events = 'SELECT * FROM `event`';
		$events_result = $conn->query($sql_events); 

		if($events_result){
			return mysqli_num_rows($events_result);

		}else{
			echo $conn->error();
		}

	}



	function getTotalNumberOfTickets(){
		require ('C:\xampp\htdocs\Stadium_Management_Systems\Admin\Frontend\db_connection.php');
		$sql_tickets = 'SELECT * FROM `ticket`';
		$tickets_result = $conn->query($sql_tickets); 

		if($tickets_result){
			return mysqli_num_rows($tickets_result);

		}else{
			echo $conn->error();
		}

	}


	function getTotalNumberOfEventRequest(){

	}

	function getTotalNumberOfUsers(){
	   require ('C:\xampp\htdocs\Stadium_Management_Systems\Admin\Frontend\db_connection.php');
		$sql_participant = 'SELECT * FROM `participant`';
		$participant_result = $conn->query($sql_participant); 

		if($participant_result){
			return mysqli_num_rows($participant_result);

		}else{
			echo $conn->error();
		}

	}


?>
