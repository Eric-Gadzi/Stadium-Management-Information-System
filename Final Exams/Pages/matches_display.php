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

  function displayFootballMatch($number, $date, $status, $stadium_name, $town,  $home_team, $away_team, $event_id, $stadium_id, $event_name){
    $location = $stadium_name.", ".$town;
    $date = strtotime($date);
    $date = date('D M j Y', $date); 
    $status =  checkStatus($status);

    echo " 
          <tr>
      <th scope='row'>$number</th>
      <td>$event_name</them>
      <td>$date</td>
      <td>$status</td>
      <td>$stadium_name</td>
      <td>$home_team</td>
      <td><b>VRS<b></td>
      <td>$away_team</td>
      <td>
      <form action = 'Tickets.php'>
      <input type='hidden' name='event_id' value = '$event_id'>
      <input type = 'hidden' name = 'stadium_id' value = '$stadium_id'>
      <input type = 'hidden' name = 'event_name' value = '$event_name'>
      <input type = 'hidden' name = 'stadium_name' value = '$stadium_name'>

      <button type='submit' class='btn ' name = 'buy'>
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
    
?>







<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Matches</title>


    <style type="text/css">
      
    </style>
  </head>
  <body>    
      <table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Competition Name</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>
      <th scope="col">Location</th>
      <th scope="col">Home Team</th>
      <th scope="col"> <b>VRS<b></th>
      <th scope="col"> Away Team</th>
      <th scope="col">Buy Ticket</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <?php
       require "../Database_connection.php";

        $sql = " SELECT event.Date_of_event, event.Event_name, event.Is_done, stadium.stadium_name, address.town, Home_Team, Away_Team, event.Event_id, stadium.Stadium_id, address.Ghgps_code FROM event, stadium, address, football_matches WHERE event.Event_id = football_matches.Event_id and event.venue = stadium.Stadium_id and address.Ghgps_code = stadium.ghgps_code ORDER BY event.Is_done ASC ";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
          $number = 0;
          while($row = $result->fetch_assoc()){
            $date = $row['Date_of_event'];
            $status = $row['Is_done'];
            $stadium_name = $row['stadium_name'];
            $town = $row['town'];
            $home_team = $row['Home_Team'];
            $away_team = $row['Away_Team'];
            $event_id = $row['Event_id'];
            $stadium_id = $row['Stadium_id'];
            $event_name = $row['Event_name'];

            displayFootballMatch($number, $date, $status, $stadium_name, $town,  $home_team, $away_team, $event_id, $stadium_id, $event_name);
            $number++;
          }


        }else{
          echo "
            <script>
              alert('PROBLEM ENCOUNTERED LOADING. REFRESH PAGE')

            </script>

          ";
        }


      ?>

    </tr>
  </tbody>
</table>

   
  </body>
</html>




<!-- SELECT event.Date_of_event, event.Event_name, event.Is_done, stadium.stadium_name, address.town, Home_Team, Away_Team, event.Event_id, stadium.Stadium_id, address.Ghgps_code FROM event, stadium, address, football_matches WHERE event.Event_id = football_matches.Event_id and event.venue = stadium.Stadium_id and address.Ghgps_code = stadium.ghgps_code ORDER BY event.Is_done ASC; -->