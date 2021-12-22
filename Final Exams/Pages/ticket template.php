<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ticket trial</title>
</head>
<style type="text/css">
  @import url('https://fonts.googleapis.com/css?family=Oswald');
* {
    margin: 0;
    padding: 0;
    border: 0;
    box-sizing: border-box
}

body {
    background-color: #dadde6;
    font-family: arial
}

.fl-left {
    float: left
}

.fl-right {
    float: right
}

h1 {
    text-transform: uppercase;
    font-weight: 900;
    border-left: 10px solid #fec500;
    padding-left: 10px;
    margin-bottom: 30px
}

.row {
    overflow: hidden
}

.card {
    display: table-row;
    width: 40%;
    background-color: #fff;
    color: #989898;
    margin-bottom: 10px;
    font-family: 'Oswald', sans-serif;
    text-transform: uppercase;
    border-radius: 4px;
    position: relative
}

.card+.card {
    margin-left: 2%
}

.date {
    display: table-cell;
    width: 25%;
    position: relative;
    text-align: center;
    border-right: 2px dashed #dadde6
}

.date:before,
.date:after {
    content: "";
    display: block;
    width: 30px;
    height: 30px;
    background-color: #DADDE6;
    position: absolute;
    top: -15px;
    right: -15px;
    z-index: 1;
    border-radius: 50%
}

.date:after {
    top: auto;
    bottom: -15px
}

.date time {
    display: block;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%)
}

.date time span {
    display: block
}

.date time span:first-child {
    color: #2b2b2b;
    font-weight: 600;
    font-size: 250%
}

.date time span:last-child {
    text-transform: uppercase;
    font-weight: 600;
    margin-top: -10px
}

.card-cont {
    display: table-cell;
    width: 75%;
    font-size: 85%;
    padding: 10px 10px 30px 50px
}

.card-cont h3 {
    color: #3C3C3C;
    font-size: 130%
}

.row:last-child .card:last-of-type .card-cont h3 {
    text-decoration: line-through
}

.card-cont>div {
    display: table-row
}

.card-cont .even-date i,
.card-cont .even-info i,
.card-cont .even-date time,
.card-cont .even-info p {
    display: table-cell
}

.card-cont .even-date i,
.card-cont .even-info i {
    padding: 5% 5% 0 0
}

.card-cont .even-info p {
    padding: 30px 50px 0 0
}

.card-cont .even-date time span {
    display: block
}

.card-cont a {
    display: block;
    text-decoration: none;
    width: 80px;
    height: 30px;
    background-color: #D8DDE0;
    color: #fff;
    text-align: center;
    line-height: 30px;
    border-radius: 2px;
    position: absolute;
    right: 10px;
    bottom: 10px
}

.row:last-child .card:first-child .card-cont a {
    background-color: #037FDD
}

.row:last-child .card:last-child .card-cont a {
    background-color: #F8504C
}

@media screen and (max-width: 860px) {
    .card {
        display: block;
        float: none;
        width: 100%;
        margin-bottom: 10px
    }
    .card+.card {
        margin-left: 0
    }
    .card-cont .even-date,
    .card-cont .even-info {
        font-size: 75%
    }
}


</style>

<body>
  <section class="container">
<h1>My Tickets</h1>
  <div class="row">
  </div>
</section>

  <?php
    acceptedTicket('GVMA', '24-12-2021', 'T01', 'Vodafone', 'Accra Sports Stadium');
  ?>

</body>
</html>




<?php

  function acceptedTicket($event_name, $event_Date, $ticket_id, $event_organiser, $event_venue){
    $event_Date = strtotime($event_Date);
    $day = date('d', $event_Date);
    $month = date('M', $event_Date);
    $full_date = date('l d M Y' , $event_Date);
    echo "
        <article class='card fl-left'>
      <section class='date'>
        <time datetime='$event_Date'>
          <span>$day</span><span>$month</span>
        </time>
      </section>
      <section class='card-cont'>
        <small>$ticket_id</small>
        <h3>$event_name</h3>
        <div class='even-date'>
         <i class='fa fa-calendar'></i>
         <time>
           <span>$event_organiser</span>
           <span>$full_date</span>
         </time>
        </div>
        <div class='even-info'>
          <i class='fa fa-map-marker'></i>
          <p>
            $event_venue
          </p>
        </div>
        <form>
          <input type='hidden' value = '$ticket_id' name = 'ticket_id'>
          <button type = 'submit' style = 'background:red;' name = 'delete'>delete</button>
        </form>
      </section>
    </article>

    ";
  }

  if(isset($_GET['delete'])){
      require "..\Database_connection.php";
      $deletesql = "DELETE FROM `ticket` WHERE ticket_id = $ticket_id and Participant_id = $participant_id";
      $deleteresult = $conn->query($deletesql);
      if($deleteresult){
        echo "
          <script>
            alert('ticket deleted successfully');
          </script?
        ";
      }
  }

?>