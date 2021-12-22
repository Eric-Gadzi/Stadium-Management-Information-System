<?php

  function checkStatus($event_status){
    if($event_status === '0'){
      return " 
       <div class='d-inline-block p-2 bg-success text-white'>
            upcoming
        </div>

      ";
    }else{
    return "
     <div class='d-inline-block p-2 bg-danger text-white'>
        passed
      </div>
    ";
  }
  }

  function displayEven($row_number, $event_name, $event_date, $stadium_name, $town, $region, $organiser, $event_id, $stadium_id, $event_status){
  
    echo "
           <tbody>

                  <tr>
                    <th>$row_number</th>
                    <td>$event_name</td>
                    <td>$event_date</td>
                    <td>$stadium_name</td>
                    <td>$town</td>
                    <td>$region</td>
                    <td>$organiser</td>
                    <td>
                      $event_status
                    </td>
                    <td>
                      <form action = 'Tickets.php'>
                        <input type='hidden' name='event_id' value = '$event_id'>
                        <input type = 'hidden' name = 'stadium_id' value = '$stadium_id'>
                        <input type = 'hidden' name = 'event_name' value = '$event_name'>
                        <input type = 'hidden' name = 'stadium_name' value = '$stadium_name'>
                        
                        <button type='submit' class='btn btn-primary' name = 'buy'>Buy</button>
                      </form>
                    </td>
                    <td>
                    <button type='button' class='btn btn-secondary'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='12' height='16' fill='currentColor' class='bi bi-box-arrow-up-right' viewBox='0 0 16 16'>
                      <path fill-rule='evenodd' d='M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z'/>
                      <path fill-rule='evenodd' d='M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z'/>
                    </svg>
                    </button>
                    </td>      
                </tr>


              </tbody>


    ";
  }



   $sql_without_stadium_id = "SELECT event.Event_id,event.Event_name, event.Date_of_event,event.Is_done, stadium.stadium_name, stadium.Stadium_id,address.town,address.Region, organiser.organiser_name from event,stadium,address,organiser,event_organiser where 
    event.venue = stadium.Stadium_id 
    and stadium.ghgps_code=address.Ghgps_code 
    and organiser.organiser_id = event_organiser.Organiser_id 
    and event_organiser.Event_id = event.Event_id
    ORDER BY event.Is_done ASC
    ";

   
   



    function mainDisplay($sql){ 
      require '..\Database_connection.php';

    $select_event = $sql;
    $select_event_result = $conn->query($select_event);
    if($select_event_result->num_rows > 0){
        $row_number = 1;
      while ($row = $select_event_result->fetch_assoc()) {
          $event_name = $row['Event_name'];
          $event_id = $row['Event_id'];
          $event_date = $row['Date_of_event'];
          $event_status = $row['Is_done'];
          $stadium_name = $row['stadium_name'];
          $stadium_id = $row['Stadium_id'];
          $town = $row['town'];
          $region = $row['Region'];
          $organiser = $row['organiser_name'];
            $status = checkStatus($event_status);
          displayEven($row_number, $event_name, $event_date, $stadium_name, $town, $region, $organiser, $event_id, $stadium_id, $status);
          $row_number++;    
      }
    }
    else{
      echo "
      <script>
        alert('Could not load events');
      </script>

      ";
    }
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

    <title>Event</title>

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
                <img src="https://impreza.us-themes.com/wp-content/uploads/paolo-bendandi-D-8XODEIr_s-unsplash.jpg" alt="profile picture" class="img-fluid rounded-circle my-4 p-1 d-none d-md-block shadow"/>
               <a href="#" class="navbar-brand mx-0 font-weight-bold  text-nowrap" >
                 <?php
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
                  <a href="Tickets.php" class="nav-link"> Ticket</a>
                </li>
                 <li class="nav-item">
                    <a href="register_event.php" class="nav-link"> Register Event </a>
                </li>

                <li class="nav-item">
                    <a href="matches.php" class="nav-link"> Matches </a>
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
              <table class="table table-striped table-responsive-md btn-table table-hover">
            
              <thead>
                <tr>
                    <th>#</th>
                    <th>Event Name</th>
                    <th>Date of Event</th>
                    <th>Venue</th>
                    <th>Town</th>
                    <th>Region</th>
                    <th>Organisor</th>
                    <th>Status</th>
                    <th>Buy Ticket</th>
                    <th>more...</th>      
                </tr>
              </thead>
              
              <?php
                if(isset($_GET['view'])){
                  $stadium_id = $_GET['stadium_id'];
                  $sql_with_stadium_id = " 
                   SELECT event.Event_id,event.Event_name, event.Date_of_event,event.Is_done, stadium.stadium_name, stadium.Stadium_id,address.town,address.Region,
                     organiser.organiser_name
                     from event,stadium,address,organiser,event_organiser 
                     where event.venue = stadium.Stadium_id 
                     and stadium.ghgps_code=address.Ghgps_code
                     and organiser.organiser_id = event_organiser.Organiser_id
                     and event_organiser.Event_id = event.Event_id
                     and stadium.Stadium_id = '$stadium_id'

                     ORDER BY event.Is_done ASC

                   ";

                   mainDisplay($sql_with_stadium_id);

                }
                else{
                  mainDisplay($sql_without_stadium_id);
                }
              ?>

              </tbody>

          </main>
      </div>
  </div>


  </body>
</html>



