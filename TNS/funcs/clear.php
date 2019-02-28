<?php require('db.php');		
	
  if (isset($_GET['clear'])) {

          // spit out the boolean INSERT result for use by client side JS
          if(mysqli_query($conn, "UPDATE players SET playing='', team='' ")) {
              echo '<h1 style="	font-family: Helvetica Neue,Helvetica,Arial,sans-serif;">Cleared!</h1>';
              exit;
          } else {
              echo 'Error!';
              exit;
          }
  }
	?>