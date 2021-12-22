
<?php
  function ticketRow($row_number, $ticket_id, $ticket_name, $ticket_price, $ticket_type, $date, $number_of_tickets, $event_name, $event_id){
    echo "

           <tr>
                    <th>$row_number</th>
                    <td>
                    $event_name
                    </td>
                    <td>$ticket_name</td>
                    <td>$ticket_price</td>
                    <td>$ticket_type</td>
                    <td>$date</td>
                    <td>$number_of_tickets</td>
                    <td>
                      <form action = 'buyticket.php' method = 'POST'>
                      <input type='hidden' name='ticket_id' value = '$ticket_id'>
                      <input type='hidden' name='event_id' value = '$event_id'>
                      <input type = 'hidden' name = 'number_of_tickets' value = '$number_of_tickets'>
                        <input type = 'hidden' name = 'event_name' value = '$event_name'>
                        <input type = 'hidden' name = 'ticket_type' value = '$ticket_type'>
                         <input type = 'hidden' name = 'ticket_price' value = '$ticket_price'>
                        
                      <button type='submit' name='buy_ticket'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='50' height='25' fill=' green' class='bi bi-ticket-detailed' viewBox='0 0 16 16'>
                        <path d='M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5ZM5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H5Z'/>
                        <path d='M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z'/>
                      </svg>
                    </button>
                    </form>

                    </td>


                </tr>

    ";
  }

  function ticketsBought($ticket_id){
    require('..\Database_connection.php');
    $sql = " 
      SELECT payment.ticket_id 
      FROM payment
      WHERE payment.ticket_id = '$ticket_id';
    ";

    $result = $conn->query($sql);
    return $result->num_rows;

  }


  

  function displayTickets($sql){
    require('..\Database_connection.php');
    

    $result = $conn->query($sql);
    if($result->num_rows > 0){
      $row_number = 1;
      while($row = $result->fetch_assoc()){
        $ticket_id = $row['Ticket_id'];
        $ticket_name = $row['ticker_name'];
        $ticket_price = $row['price_per_ticket'];
        $ticket_type = $row['ticket_type'];
        $date = $row['Date_of_event'];
        $number_of_tickets = $row['number_issued'];
        $event_name = $row['Event_name'];
        $event_id = $row['Event_id'];
        $tickets_bought = ticketsBought($ticket_id);
        $number_of_tickets = $number_of_tickets - $tickets_bought;
        ticketRow($row_number, $ticket_id, $ticket_name, $ticket_price, $ticket_type, $date, $number_of_tickets, $event_name, $event_id);
        $row_number++;
      }
    }
    else{
      echo " 
        <script>
          alert('tickets not available');
        window.location.href='Tickets.php';

        </script>
      ";
    }
  }



  function displayMyTickets(){
    
  }
  

  function tableHeads(){
    echo "
       <thead>
                <tr>
                    <th>#</th>
                    <th>Event Name</th>
                    <th>Ticket Name</th>
                    <th>Ticket price</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Seats Left</th>
                    <th>Purchase</th>     
                </tr>
              </thead>
    ";
  }


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title> Tickets</title>

    <style type="text/css">
      


    </style>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<!-- Side Nav Bar -->
<div class="container-fluid">
      <!-- SideBar -->
        <div class="row min-vh-100 flex-column flex-md-row">
          <aside class="col-12 col-md-3 col-xl-2 p-0 bg-dark ">
            <nav class="navbar navbar-expand-md navbar-dark bd-dark flex-md-column flex-row align-items-center py-2 text-center sticky-top " id="sidebar">
              <div class="text-center p-3">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyVOllElv72uovJ0L9ZqMHmeOMiwDxlhsqUrjQyKyIZVlc8jnxxWWB1P77KErv4E_z-BA&usqp=CAU" alt="profile picture" class="img-fluid rounded-circle my-4 p-1 d-none d-md-block shadow"/>
               <a href="#" class="navbar-brand mx-0 font-weight-bold  text-nowrap" ><?php
                    if (session_status() === PHP_SESSION_NONE) {
                     session_start();
                     if($_SESSION['username'] === null){
                      echo "User Name";
                     }else{
                      echo $_SESSION['username'];
                     }
                    }else{
                      session_start();
                       echo $_SESSION['username'];
                    }
                 ?></a>
              
              </div>
                  <button type="button" class="navbar-toggler border-0 order-1" data-toggle="collapse" data-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              
              <div class="collapse navbar-collapse order-last" id="nav">
                <ul class="navbar-nav flex-column w-100 justify-content-center">
                <li class="nav-item">
                  <a href="#" class="nav-link"> Edit Profile</a>
                </li>
                <li class="nav-item">
                  <a href="trials.html" class="nav-link"> DashBoard</a>
                </li>
                <li class="nav-item">
                  <a href="events.php" class="nav-link"> Event </a>
                </li>
                <li class="nav-item">
                    <a href="stadiums.php" class="nav-link"> Stadiums </a>
                  </li>
                <li class="nav-item">
                  <a href="Tickets.php" class="nav-link active"> Ticket</a>
                </li>
                <li class="nav-item">
                    <a href="register_event.php" class="nav-link"> Register Event </a>
                </li>

                <li class="nav-item">
                    <a href="matches.php" class="nav-link"> Matches </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link"> 
                        <form>
                        <button type="button" class="btn btn-dark">Logout</button>
                    	</form>
                    </a>
                </li>
              </ul>
              </div>      
            </nav>   
          </aside>

            <main class="col px-0 flex-grow-1">

              <form>
                <button type="submit" name="my_ticket"  class="btn btn-secondary" style="float:right;">My Tickets</button>
              </form>


             


              <table class="table table-striped table-responsive-md btn-table table-hover">
             
            <tbody>
              
                  <?php 

                    if(isset($_GET['buy'])){
                      $event_id = $_GET['event_id'];
                      $stadium_id = $_GET['stadium_id'];
                      $ticket = "
      SELECT event.Event_id, event.venue, event.Event_name, event.Is_done, event.Date_of_event, ticket.Ticket_id, ticket.ticker_name, ticket.ticket_type, ticket.price_per_ticket, ticket.number_issued FROM event, ticket WHERE ticket.Event_id = event.Event_id
        and event.Event_id = '$event_id' 
        and event.venue = '$stadium_id'
       ORDER BY `event`.`Date_of_event` DESC  

    ";  

                    tableHeads();
                    displayTickets($ticket);

                    }



                  else  if(isset($_GET['my_ticket'])){
                      require "ticket template.php";

                      acceptedTicket('VGMA Awards', '31-12-2020', 'TO1', 'Vodafone Ghana', 'Accra Sports Stadium');



  }

                    else{
                      tableHeads();
                    $default_display = "
      SELECT event.Event_id, event.venue, event.Event_name, event.Is_done, event.Date_of_event, ticket.Ticket_id, ticket.ticker_name, ticket.ticket_type, ticket.price_per_ticket, ticket.number_issued FROM event, ticket WHERE ticket.Event_id = event.Event_id ORDER BY `event`.`Date_of_event` DESC  

    ";
                    displayTickets($default_display);

                  }

                   ?>

            </tbody>   
            
          </table>


            </main>
       </div>
    </div>
  </body>
</html>

