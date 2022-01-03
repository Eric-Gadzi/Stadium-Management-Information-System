<?php



	// $connection = new Database;


	$conn;
	$conn = new mysqli('localhost', 'root',  '', 'stadium_mgt_information_system');
			if(!$conn)
			{
				echo "
					<script>
						alert('There is a db error');
					</script>
				";

				echo $conn->error();
			}else{
				echo "
					<script>
						alert('Connected Successully');
					</script>
				";
			}

?>