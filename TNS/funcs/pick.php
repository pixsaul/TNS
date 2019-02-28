<?php 			

	function pickTeams() {
		
		require('db.php');
		
		$sql = "SELECT id, name, r, playing FROM players WHERE playing='Y' ORDER BY RAND()";
		$result = $conn->query($sql);
		$resultcount = $result->num_rows;
	
		$teamARating = 0;
		$teamBRating = 0;

	
		while($row = $result->fetch_assoc()) {
					
					if($i%2 == 0)
					{
						$team = "B";
	   				}
	   				else
	   				{
	   					$team = "A";
	   				}
					
					$id = $row["id"];
					$rating = $row["r"];
					
					$sqlUpdate = "UPDATE players SET team='".$team."' WHERE id='".$id."' AND playing='Y'";
					$resultUpdate = $conn->query($sqlUpdate);
					
					if($team == "A") {
						$teamARating += $rating;
					}
					
					if($team == "B") {
						$teamBRating += $rating;
					}
					
					if($i%2 == 1){
						$team = "B";
					}
					
				$i++;
	    		}
	    		
	    		if ( abs($teamARating - $teamBRating) <= 2 ) {
		    		exit();
	    		}
	    		else {
		    		pickTeams();
	    		}
	    		
	    }		
    
    pickTeams();		
	
	
?>