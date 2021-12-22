<?php
	
	$event_name = null;
	$ticket_type = null;
	$number_of_tickets_available = null;
	$price = null;
  $event_id = null;
  $ticket_id = null;

	if (isset($_POST['buy_ticket'])) {
		$event_name = $_POST['event_name'];
		$ticket_type = $_POST['ticket_type'];
		$number_of_tickets_available = $_POST['number_of_tickets'];
		$price = $_POST['ticket_price'];
    $event_id = $_POST['event_id'];
    $ticket_id = $_POST['ticket_id'];
	}


?>







<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BUY TICKET</title>

	<style type="text/css">
		
body{
  background: #000070;
}

form{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  background: rgba(0,0,0,.1);
  padding: 100px;
}

label{
 font-family: sans-serif;
  letter-spacing: 6px;
  text-transform: uppercase;
  font-size: .8em;
  color: #FFF;
}

input{
  display: inline-block;
  border: none;
  text-align: left;
  box-shadow: 3px 2px rgba(121, 83, 210,.3 );
  padding: 10px;
  width: 350px;
  margin: 10px 0;
  background: transparent;
  color: #FFF;
}

input[type = radio]{
  display: inline-block;
  border: none;
  text-align: left;
  /*box-shadow: 3px 2px rgba(121, 83, 210,.3 );*/
  padding: 10px;
  width: 50px;
  margin: 0;
  background: transparent;
  color: #FFF;
}

input:focus{
  background: none;
  border: none;
  color: #FFF;
}

span{
   font-family: sans-serif;
  letter-spacing: 1px;
  text-transform: uppercase;
  font-size: .8em;
  color: #FFF;
  margin-right: 10px;
  margin-top: 10px;

}

button{
  background: transparent;
  color: #FFF;
  font-family: sans-serif;
  text-transform: uppercase;
  letter-spacing: 3px;
  margin: 20px 0;
  padding: 10px 30px;
  border: 2px solid #FFF;
}

button:hover{
  background: transparent;
  border: 2px solid rgba(69, 39, 160, .4);
}

	</style>


</head>
<body>
	<form>
  <label> Event Name: </label> <br>

  <input name = "event_name" type="text" placeholder="" value=' 
  <?php echo $event_name ?>' readonly /> <br>

  <input type="hidden" name="ticket_price" value='<?php echo $price ?>'>

  <input type="hidden" name="event_id" value='<?php echo $event_id ?>'>

  <input type="hidden" name="ticket_id" value="<?php echo $ticket_id ?>">

  <label> Ticket Type: </label> </br>

  <input  name = 'ticket_type' type="text" placeholder="" value=' 
  <?php echo $ticket_type ?>'readonly/><br>

  <label> Price </label> </br>
  <input type="number" placeholder="" name="number_purchased" value="<?php echo $price ?>" readonly /><br>
  
  <label> Bank Name </label> </br><br>
  <input  type="radio" name="bank" value="ecobank" checked><span>Ecobank</span>
  <input  type="radio" name="bank" value="GCB"><span>GCB</span>

  <br><br><label>Card Type</label><br><br>
  <input  type="radio" name="card" value="visa" checked><span>visa</span>
  <input  type="radio" name="card" value="mastercard"><span>Mastercard</span>

  <br><br><label>Card number</label><br>
  <input type="text" name="card_number" pattern = ".{8,}"  title = "enter at least 8 characters" required>

<br>
<button type="submit" name="buy"> Buy </button>
</form>

</body>
</html>



<?php 
  require "../Database_connection.php";
  if(isset($_GET['buy'])){
    $ticket_id = $_GET['ticket_id'];
    $event_name = $_GET['event_name'];
    $event_id = $_GET['event_id'];
    $price = $_GET['ticket_price'];
    $ticket_type = $_GET['ticket_type'];
    $bank_name = $_GET['bank'];
    $card_type = $_GET['card'];
    $card_number = $_GET['card_number'];
    session_start();
    $userid = $_SESSION['userID'];
    $number_of_tickets = 1;
    $amount = intval($price)*intval($number_of_tickets);

    $insert_payment = "INSERT INTO `payment`(`ticket_id`, `Participant_id`, `Amount`, `card_number`, `card_name`, `card_type`, `nummber_of_ticket`) VALUES ('$ticket_id','$userid','$amount','$card_number','$bank_name','$card_type','$number_of_tickets') ";

    echo " 
      <script>
       let confirm = confirm('Do you want to make payment of <h4> GHC $amount </h4>', 'PAY', CANCEL);
      </script>

      ";

      $result_insert_payment = $conn->query($insert_payment);
    if($result_insert_payment){
      
      echo " 
        <script>
          alert('Payment of $amount is completed for event $event_name');
          window.location.href='/Final Exams/Pages/events.php';
        </script>
      ";


    }else{

      echo " 
        <script>
          alert('Payment could not be made');
        </script>
      ";
    }



  }



 ?>