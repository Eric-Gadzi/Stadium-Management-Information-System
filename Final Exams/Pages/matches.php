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
                  <a href="Tickets.php" class="nav-link"> Ticket</a>
                </li>
                 <li class="nav-item">
                    <a href="register_event.php" class="nav-link"> Register Event </a>
                </li>

                <li class="nav-item">
                    <a href="matches.php" class="nav-link active"> Matches </a>
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
              <?php 

                  require "matches_display.php";
                  

              ?>



            </main>
       </div>
    </div>
  </body>
</html>