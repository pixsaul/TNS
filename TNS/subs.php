<?php include('parts/head.php'); ?>
<?php require('funcs/db.php'); ?>


<body id="home">

<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
    	<li><a href="/">Players</a></li>
    	<li><a href="/teams">Teams</a></li>
    	<li class="active"><a href="/subs">Subs</a></li>
    </ul>
  </div>
</nav>

	<div class="container-fluid">
		<div class="row">
		
		<?php //Check if teams have been set
		$teamQuery = "SELECT id from players";
		$teamResult = $conn->query($teamQuery);

		if ($teamResult->num_rows > 0) {

		//Get team A
		$sql = "SELECT id, name, playing, team, r FROM players WHERE playing='Y'  ORDER BY name";
		$result = $conn->query($sql);
		$resultcount = $result->num_rows;

		//If you've got rows, print squad
		if ($result->num_rows > 0) { ?>

			<div class="col-xs-12 subsList">
				<ul style="list-style: none; margin:0; padding:0; padding-top: 30px;">

					<? // output data of each row
						$i=0;

						while($row = $result->fetch_assoc()) {
		
						$id = $row["id"];
						$team = $row["team"];
						echo "<li><label><input type='checkbox' /> <span style='font-weight:normal; display: inline-block; margin-left: 3px;'>" . $row["name"]. "</span><span class='r' style='display:none;'>" . $row["r"] . "</span></label></li>";	
						$i++;
    				}
    				?>
				</ul>
			</div>
			<?php
			}   else {
				echo "<div class='col-xs-12'><div class='team-message alert alert-warning'>No players found.</div></div>";
			}

			//Get team B
			$sql = "SELECT id, name, playing, team, r FROM players WHERE playing='Y' AND team='X'  ORDER BY name";
			$result = $conn->query($sql);
			$resultcount = $result->num_rows;
	
			//If you've got rows, print squad
			if ($result->num_rows > 0) { ?>
	
			<div class="col-xs-6 teamBlock teamBlock__nobibs">
				<span class="teamHeader">Athletic Bibno</span>
				<ul>
	
					<? // output data of each row
					$i=0;
	
					while($row = $result->fetch_assoc()) {
					
						$id = $row["id"];
						$team = $row["team"];
						echo "<li><span>" . $row["name"]. "</span><span class='r' style='display:none;'>" . $row["r"] . "</span></li>";	
						$i++;
	    			}	
	    			?>
				</ul>
			</div>
			<?php
			}         
			} else {
				echo "<div class='col-xs-12'><div class='team-message alert alert-warning'>No players found.</div></div>";
			}
		$conn->close();
		?>
		
	</div>	
</div>



<?php include('parts/foot.php'); ?>