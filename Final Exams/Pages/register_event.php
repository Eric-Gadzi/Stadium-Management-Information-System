<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title> Register Event </title>

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
                
                   

               
                 ?>
                 </a>
              
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
                  <a href="events.php" class="nav-link active"> Event </a>
                </li>
                <li class="nav-item">
                    <a href="stadiums.php" class="nav-link"> Stadiums </a>
                  </li>
                <li class="nav-item">
                  <a href="Tickets.php" class="nav-link "> Ticket</a>
                </li>
                 <li class="nav-item">
                    <a href="register_event.php" class="nav-link"> Register Event </a>
                </li>

                <li class="nav-item">
                    <a href="matches.<?php  ?>" class="nav-link"> Matches </a>
                </li>

                <li class="nav-item">
                    <a href="Login/Login.php" class="nav-link"> 
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
              <?php
                require('register_template.php');
              ?>
            </main>
          </div>
        </div>
  </body>
</html>

<!-- collecting the data from the registration and inserting it -->
<?php




  if(isset($_POST['submit'])){
    require '../Database_connection.php';

    $event_name = $_POST['event_name'];
    $event_venue = $_POST['venue'];
    $event_date = $_POST['date'];
    $ticket_type = $_POST['ticket_type'];
    $ticket_price = $_POST['ticket_price'];
    $seat_available = $_POST['number_of_seats'];
    $registration_date = date("Y-m-d");
    $event_date = date("Y-m-d", strtotime($event_date));
    $is_done = 0;
    $event_type = $_POST['event_type'];



    // Inserting into the event table
    $insert_sql = "INSERT INTO `event`(`Event_name`, `Is_done`, `Date_of_registration`, `Date_of_event`, `event_Type`, `venue`) VALUES  ('$event_name','$is_done','$registration_date','$event_date','$event_type','$event_venue')
    ";

    $result_insert =  $conn->query($insert_sql);

    if($result_insert){
        // GET THE ID FOR INSERTION;
        $event_id = 0;
        $select_event_id = "SELECT `Event_id`   FROM `event` WHERE Event_name = '$event_name'";
        $event_id_result = $conn->query($select_event_id);
        if($event_id_result->num_rows > 0){
          while($row = $event_id_result->fetch_assoc()){
            $event_id = $row['Event_id'];
          }

          $ticket_id = substr($event_name, 0, 2).rand(10, 1000);
          $insert_ticket = "INSERT INTO `ticket`(`Ticket_id`, `ticker_name`, `ticket_type`, `price_per_ticket`, `Event_id`, `number_issued`) VALUES ('$ticket_id','$event_name','$ticket_type','$ticket_price','$event_id','$seat_available')";
          $result_ticket = $conn->query($insert_ticket);

          if($result_ticket){

                $organiser_name = $_SESSION['username'];
                $email = $_SESSION['email'];
                $phone = $_SESSION['phone'];
                $address = $_SESSION['address'];




                $select_org = "SELECT `organiser_id`, `organiser_name`, `email`, `telephone`, `address` FROM `organiser` WHERE email = '$email'";

                $result = $conn->query($select_org);

                if($result->num_rows > 0){
                  $row = $result->fetch_assoc();
                  $organiser_id = $row['organiser_id'];

                  $selectsql_eventid="SELECT `Event_id`  FROM `event` WHERE Event_name = '$event_name' and Date_of_event = '$event_date'";

                  $event_id_result = $conn->query($selectsql_eventid);
                  
                  if($event_id_result->num_rows > 0){
                    $row = $event_id_result->fetch_assoc();
                    $event_id = $row['Event_id'];
                    
                    $insert_event_org = "INSERT INTO `event_organiser`(`Organiser_id`, `Event_id`) VALUES ('$organiser_id','$event_id')";
                   
                    $result_event_org = $conn->query($insert_event_org);
                    if($result_event_org){
                      echo " 
                        <script>
                            alert('Registration Complete');
                        </script>
                        ";
                    }else{
                      echo $conn->error;
                      echo " 
                        <script>
                            alert('Registration not complete');
                        </script>
                        ";
                        exit();
                    }

                  }
                  else{
                    echo " 
                        <script>
                            alert('Could not insert into event_org ');
                        </script>
                        ";
                  }
                 
                }else{
                  echo $conn->error;
                }

                

            
             

            
         
          }
          else{
            echo $conn->error;
            echo " 
            <script>
          alert('Event ID not found');
        </script>
          ";
          }

        }
        else{
          echo " 
            <script>
          alert('Ticket is messing up');
        </script>
          ";
        }

      
    }else{
      echo $conn->error;
      echo " 
        <script>
          alert('Could not register');
        </script>

      ";
    }


  }
 

?>


