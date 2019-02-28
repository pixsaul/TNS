<?php require('db.php');			
	
  if (isset($_POST['playing']) && !empty($_POST['playing'])) {

      // sql injection sucks
      $playing = mysqli_real_escape_string($conn, $_POST['playing']);

      // cast it as an integer, sql inject impossible
      $id = intval($_POST['playerId']);

      if($id) {
          // spit out the boolean INSERT result for use by client side JS
          if(mysqli_query($conn, "UPDATE players SET playing='$playing' WHERE id=$id")) {
              echo 'saved';
              exit;
          } else {
              echo 'error';
              exit;
          }
      }
  }
	?>