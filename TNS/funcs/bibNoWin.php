<?php require('db.php');
	
	$sql = "SELECT id, name, playing FROM players WHERE playing='Y' ORDER BY RAND()";
	$result = $conn->query($sql);
	$resultcount = $result->num_rows;			
	
				
				$sqlUpdate = "UPDATE players SET played = played + 1 WHERE playing='Y'";
				$resultUpdate = $conn->query($sqlUpdate);
				
				$sqlUpdate2 = "UPDATE players SET won = won + 1 WHERE playing='Y' AND team ='B'";
				$resultUpdates = $conn->query($sqlUpdate2);
				

    		
	exit;
	
?>