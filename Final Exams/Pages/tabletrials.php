<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TABLES TRIAL</title>
  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<?php
	function tableContent($row_number, $name, $type, $capacity, $year_built, $region, $town, $email, $number, $stadium_id){
		echo "<tbody>
  		 <tr>
      <th scope='row'>$row_number</th>
      <td>$name</td>
      <td>$type</td>
      <td>$capacity</td>
      <td>$year_built</td>
      <td>$region</td>
      <td>$town</td>
      <td>$email</td>
      <td>$number</td>
      <td>
        <form action = 'events.php'>
        <input type = 'hidden' name = 'stadium_id' value = '$stadium_id'>
        <input type = 'hidden' name = 'address' value = '$email'>
        <input type='submit' name = 'view' value = 'view events' class='btn btn-outline-dark'>
        </form>
      </td>
    </tr>
</tbody>";
	}


?>

  <form>
    <h3>Sort Results By</h3>

    <select name = 'sort'>
      <option value="capacity">Capacity</option>
      <option value = 'Region'>Region</option>
      <option value="year_built">Date Built</option>
      <option value="stadium_name">stadium name</option>
    </select>

    <input type="submit" name="submit_sort" value="sort">
    
  </form>


	<table class="table table-striped table-responsive-md btn-table table-hover">
  		<thead>
    		<tr>
      			<th>#</th>
      			<th>Name</th>
            <th>Type</th>
      			<th>Capacity</th>
            <th>Year built</th>
            <th>Region</th>
            <th>Town</th>
            <th>Email</th>
      			<th>Number</th>
      			<th>Events</th>
    					
    		</tr>
  		</thead>
  		<tbody>
  			<?php


          require('Database_connection.php');
          

          function displayStadiums($sort_by){
             require('Database_connection.php');
             $select_stadiums = "
            SELECT address.town, address.Region, stadium.stadium_name, stadium.Stadium_id, stadium.capacity, stadium.Club_associated_with, stadium.stadium_type, stadium.year_built, stadium.email, stadium.contact 
              FROM stadium , address where stadium.ghgps_code = address.Ghgps_code order by $sort_by desc;
          ";

          $stadium_results = $conn->query($select_stadiums);
          $row_number = 0;
          if($stadium_results->num_rows > 0){
            while($row = $stadium_results->fetch_assoc()){
              $town = $row['town'];
              $region = $row['Region'];
              $stadium_name = $row['stadium_name'];
              $stadium_id = $row['Stadium_id'];
              $capacity = $row['capacity'];
              $club = $row['Club_associated_with'];
              $type = $row['stadium_type'];
              $year_built = $row['year_built'];
              $email = $row['email'];
              $phone = $row['contact'];

              tableContent($row_number, $stadium_name, $type, $capacity, $year_built, $region, $town, $email, $phone, $stadium_id);
                $row_number += 1;

            }
          }
          else{
            echo "
              <h1 style = 'color:red;'> This page cannot be loaded </h>
            " ;
          }

          // echo tableContent();
          // echo tableContent();
        

          }

          if(isset($_GET['submit_sort'])){
            $sort_by = $_GET['sort'];
            if(!empty($sort_by)){

                echo "sorted by <b>".$sort_by."</b>.";
                displayStadiums($sort_by);
            }
            else{
                displayStadiums('capacity');
            }

          }
          else{
              displayStadiums('capacity');

          }





          ?>
         
  		</tbody>

</table>
</body>
</html>