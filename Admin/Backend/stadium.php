<?php
	
	require_once 'db_connection.php';


	$stadium_name;
	$capacity = null;
	$stadium_type;
	$club_associated;
	$location;
	$email;
	$contact;
 	$stadium_id;

 	
 	function createNewStadium($stadium_name, $capacity, $stadium_type, $club_associated, $location, $email, $contact, $year_built){

 		$conn = $GLOBALS['conn'];

 		$sql = "INSERT INTO `stadium`( `stadium_name`, `stadium_type`, `capacity`, `Club_associated_with`, `ghgps_code`, `year_built`, `contact`, `email`) VALUES ('$stadium_name','$stadium_type','$capacity','$club_associated','$location','$year_built','$contact','$email')";

 		$result = $conn->query($sql);

 		if($result){
 			echo "
 			<script>
 				alert('new stadium inserted successfully!');
 			</script>
 			";
 		}
 		else{
 			echo "
 			<script>
 				alert('ERROR!!! Could not insert stadium');
 			</script>
 			";
 		}

 	}

 	createNewStadium('TNA Park', 200, 'stadium', 'Medeama', 'Tarkwa', 'tna@gmail.com', '0558270332', '20-12-1990');


	



?>