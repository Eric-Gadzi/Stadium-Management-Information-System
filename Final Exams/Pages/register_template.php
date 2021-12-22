
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Register Event</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<!-- <link type="text/css" rel="stylesheet" href="../Styling/registerBootstrap.min.css" /> -->

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="../Styling/registerStyle.css" />

	<style type="text/css">
	h3{
	font-size: 30px;
	text-transform: uppercase;
	font-weight: 600;
	color: #ffc001;
	margin-top: 15px;
	margin-bottom: -15px;
}
	body{
	background-image: url("../Assets/event_registration_background.jpg");
	background-size: cover;
}

	</style>
</head>

<body>
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<div class="form-header">
							<h3>Register Event</h3>
						</div>


						<!-- FORMS BEGIN HERE -->
						<form method="POST" action="register_event.php">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<span class="form-label">Event Name</span>
										<input name="event_name" class="form-control" type="text" placeholder="Enter Event Name here" required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<span class="form-label">Venue</span>
										<select name="venue" id="meal_preference" class="form-control" required>
                                            <option value="1">Baba Yayra Sports Stadium</option>
                                            <option value="2">Accra Sports Stadium</option>
                                            <option value="5">Cape Coast Stadium</option>
                                        </select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<span class="form-label">Date</span>
								<input name="date" class="form-control" type="date" placeholder="Select Date" required>
							</div>

							<div class="form-group">
								<span class="form-label">Ticket Type</span>
								<select name="ticket_type" id="meal_preference" class="form-control" required>
                                    <option value="regular">Regular</option>
                                    <option value="VIP">VIP</option>
                                 </select>
							</div>

							<div class="form-group">
								<span class="form-label">Ticket Price</span>
								<input name="ticket_price" class="form-control" type="number" placeholder="Enter your ticket unit price" required>
							</div>

							<div class="form-group">
								<span class="form-label">Seats Available</span>
								<input name="number_of_seats" class="form-control" type="number" placeholder="Enter number eg: 001"  pattern=" (?=.*0-9).{4}" required>
							</div>

							<div class="form-group">
								<span class="form-label">Event Type</span>
								<select name="event_type" class="form-control" required>
                                    <option value="non-sporting">non-sporting</option>
                                    <option value="sporting">sporting</option>
                                 </select>
							</div>
							<div class="row">
								<div class="col-sm-5">
									<div class="form-group">
									</div>
								</div>
							</div>
							<div class="form-btn">
								<input type="submit" name="submit" class="submit-btn" value = 'Register Event'>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>




