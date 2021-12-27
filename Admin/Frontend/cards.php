<link rel="stylesheet" type="text/css" href="styles/cards.css">
<?php

  function card($title, $image_url, $number, $add_url, $view_url){
    echo "<div id='card'>
      <div id='top_img'>
        <img src='$image_url' title='image' alt='image'>

      </div>
      <div id='card_text'>
        <div id='card_name'>
          <small>$title: </small>
        </div>
        <div>
          <h2 id='number'>
          $number
          </h2>
          </div>
        <div>
          <a href='$add_url''>
            add
          </a>
          <a href='$view_url'>
            View
          </a>
        </div>
      
      </div>

    </div> ";
  };

?>

