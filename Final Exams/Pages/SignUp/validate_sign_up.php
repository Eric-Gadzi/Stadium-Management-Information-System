<?php
	
	require('Database_connection.php');
	// function to check validation from database
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

	// function getCurrentAge($date){

	// 	$bday = new DateTime($date); // Your date of birth
	// 	$today = new Datetime(date('m.d.y'));
	// 	$diff = $today->diff($bday);
		

	// }

?>



<?php
	
	if(isset($_POST['submit1'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$date = $_POST['birthday'];
		$date = date('d-m-y', strtotime($date));
		$gender = $_POST['gender'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirmPassword = $_POST['confirmPassword'];
		$address = $_POST['address'];
		$organiser_id = substr($fname, 0, 1).substr($lname, 0, 2).rand(10, 100);

		$today = date('d-m-y');


		// checking if any of the 
		if(empty($fname) || empty($lname) || empty($phone) || empty($phone) || empty($date) || empty($gender) || empty($email) || empty($password) || empty($confirmPassword) || empty($address)){
					echo "
						<script>
							window.alert('Some of the provided is null or empty');
						</script>
						<script>
							window.open('SignUp.html');
						</script>
			
					";
		}
		else if($date > $today){
			echo "
				<h1>
					Invalid Date of Birth provided
					Must be 18+
				</h1>

				<a href = 'SignUp.html'>Go back</a>
			";

		}
		else{

			// // Checking if above 18
			// $age = getCurrentAge($date);
			// echo $age;
			// if($age < 18){
			// 	echo "
			// 		<script>
			// 			alert('Your are less than 18 years old. Cannot procceed with registation');

			// 		</script>

			// 	";
			// }
			// else{
			// 	echo $age;

			// }

			// check if email exist
			$value_to_validate = $email;
			$db_table_attribute = 'Email';
			$db_table = 'participant';

			$result = validateFromDB($value_to_validate, $db_table_attribute, $db_table);
			
			// if mail and phone number does exist in db
			if(!$result && !validateFromDB($phone, 'phone_number', $db_table ) ){
				
				// check if passwords are equal
				if($password === $confirmPassword){
					
					// insert into address
					$address_insert = "
						INSERT INTO `address`(`Ghgps_code`) VALUES ('$address');
					";

					$address_insert_result = $conn->query($address_insert);

					if($address_insert_result){
						echo "insertion into address";

						// insert Data Into the participant table
						$insert_participant = "INSERT INTO `participant`(`First_name`, `Last_name`, `DOB`, `Gender`, `Nationality`, `Email`, `phone_number`, `address`) 
							VALUES 
							('$fname','$lname','$date','$gender','Ghanaian','$email','$phone','$address')";

						$insert_participant_result = $conn->query($insert_participant);
						if($insert_participant_result){
						echo "result inserted";

							// Insert into the signUp table

						// $password_encryption = md5($password);	
						$insert_signUp = "INSERT INTO `sign_up`(`email`, `password`) VALUES ('$email','$password')";
						$signUp_result = $conn->query($insert_signUp);

						if($signUp_result){
							$organiser_name = $fname." ".$lname;
							$insert_organiser = "INSERT INTO `organiser`(`organiser_id`, `organiser_name`, `email`, `telephone`, `address`) VALUES ('$organiser_id','$organiser_name','$email','$phone','$address')";

							$result_organiser = $conn->query($insert_organiser);

							if($result_organiser){
							echo "
								<script>
									alert('Account created succcessfully!!');
									window.open('../Login/Login.php');
								</script>
							";

								header('Location: ../Login/Login.php');
							
						}
						else{
							echo $conn->error;
							echo "
								<script>
									alert('The insertion did not work well');
									
								</script>
							";
						}
					}
						else{
							
							echo $conn->error;
							echo "
								<script>
									alert('Account could not be created!');
								</script>
							";

							echo "
								<h1> Account could not be Created </h1>
								<a href = 'SignUp.html'> Go Back </a> 
							";
						}


						}
						else{
							echo "
									<script>
										could not register you.
										<a href = 'SignUp.html'> go back </a>
									</script>
							";
							echo $conn->error;
						}
						}
						else{
							echo $conn->error;
							echo "could not insert";
						}

						}
					else{
						echo "<h1 style = 'color:red;'>password does not match!! </h1>";

					}

			}
			else{
				echo "
					<h2 style = 'color:red;'>Error!! Mail or phone number Used </h2>
					<a href = 'SignUp.html'> Go back </a>
				";
			}
			

		}





	}
	else{
		echo "
			<script>
				window.alert('Data could not be accessed. ERROR!!');

			</script>

		";
	}


?>