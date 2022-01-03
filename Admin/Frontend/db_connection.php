<?php
	
	$server = 'localhost';
	$username = 'root';
	$password = '';
	$db_name = 'stadium_mgt_information_system';

	$conn = mysqli_connect($server, $username, $password, $db_name);

	if(!$conn){
		echo "
			<script>
				alert('Could not connect to the database');
			</script>
		".$conn->error();
	 }
		// else{
	// 	echo " 
	// 		<script>
	// 			alert('Connected to the database Successfully');
	// 		</script>

	// 	";

	// }

?>