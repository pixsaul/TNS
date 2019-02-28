<?php require('db.php');
	
  if (isset($_POST['name']) && !empty($_POST['name'])) {

      // sql injection sucks
      $player = mysqli_real_escape_string($conn, $_POST['name']);

      if($player) {
          // spit out the boolean INSERT result for use by client side JS
          if(mysqli_query($conn, "INSERT INTO `players` (id, name, playing) VALUES ('', '$player', '')")) {
              echo 'saved';
              exit;
          } else {
              echo 'error';
              exit;
          }
      }
  }
?>