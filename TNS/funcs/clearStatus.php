<?php require('db.php');    
    
  if (isset($_POST['playerId']) && !empty($_POST['playerId'])) {

      // cast it as an integer, sql inject impossible
      $id = intval($_POST['playerId']);

      if($id) {
          // spit out the boolean INSERT result for use by client side JS
          if(mysqli_query($conn, "UPDATE players SET playing='', team='' WHERE id=$id")) {
              echo 'cleared';
              exit;
          } else {
              echo 'error';
              exit;
          }
      }
  }
  ?>