<?php
	require ('Database_connection.php');

	session_start();

	$_SESSION['username'] = null;
	$_SESSION['DOB'] = null;
	$_SESSION['gender'] = null;
	$_SESSION['nationality'] = null;
	$_SESSION['email'] = null;
	$_SESSION['phone'] = null;
	$_SESSION['address'] = null;
	$_SESSION['userID'] = null;
	$_SESSION['organiser_id'] = null;


	function validateFromDB($value_to_validate, $db_table_attribute, $db_table){
		require('Database_connection.php');
		$sql = "SELECT * FROM $db_table WHERE $db_table_attribute = '$value_to_validate'";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			return TRUE;
		}
		else{
		
			return FALSE;
		}
	}

	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(validateFromDB($email, 'email', 'sign_up')){
			$get_password = "SELECT `email`, `signUpTime`, `password` FROM `sign_up` WHERE email = '$email'";
			$password_result = $conn->query($get_password);

			if($password_result->num_rows > 0){
				$row = $password_result->fetch_assoc();
				$db_password = $row['password'];

				// checking if password match;
				if($password === $db_password){
					
					// // echo "the passwords matches";
					echo "
						<script>
							alert('login successful'); 
						</script>

					";
				 header("Location: ../trials.html") ;
					 

					$get_userinfo = "SELECT `Participant_id`, `First_name`, `Last_name`, `DOB`, `Gender`, `Nationality`, `Email`, `phone_number`, `address` FROM `participant` WHERE email = '$email'";

					$result_userinfo = $conn->query($get_userinfo);

					if($result_userinfo->num_rows > 0){
						$row = $result_userinfo->fetch_assoc();
						$_SESSION['username'] = $row['First_name']." ".$row['Last_name'];
						$_SESSION['DOB'] = $row['DOB'];
						$_SESSION['gender'] = $row['Gender'];
						$_SESSION['nationality'] = $row['Email'];
						$_SESSION['email'] = $row['Email'];
						$_SESSION['phone'] = $row['phone_number'];
						$_SESSION['address'] = $row['address'];
						$_SESSION['userID'] = $row['Participant_id'];

						echo $_SESSION['username'];

					}
					else{

						echo $conn->error;
						echo "Error in processing";
					}
					}
				else{
					echo "
						<script>
							alert('incorrect password'); 
						</script>

					";

				}
			}
			else{
				echo "could not get the password for real";
			}


		}else{
			echo "email not found";
		}
	
	}
	else{
		echo "this page is not accessible";
	}

?>