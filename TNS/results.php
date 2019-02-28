<?php include('parts/head.php'); ?>
<?php require('funcs/db.php'); ?>


<body id="home">

<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
    	<li><a href="/">Players</a></li>
    	<li><a href="/teams">Teams</a></li>
    </ul>
  </div>
</nav>

	<div class="container-fluid">
		<div class="row">
			
		<div class="col-xs-12">
			<h2 style="text-align: center; font-size: 18px; margin-bottom: 20px;">Select the winning team:</h2>	
		</div>
		
		<?php //Check if teams have been set
		$teamQuery = "SELECT id from players where team='A'";
		$teamResult = $conn->query($teamQuery);

		if ($teamResult->num_rows > 0) {

		//Get team A
		$sql = "SELECT id, name, playing, team, r FROM players WHERE playing='Y' AND team='A'  ORDER BY name";
		$result = $conn->query($sql);
		$resultcount = $result->num_rows;

		//If you've got rows, print squad
		if ($result->num_rows > 0) { ?>

			<div class="col-xs-6 teamBlock teamBlock__bibs">
				<span class="teamHeader"><img src="/i/BibernianLogo.png" width="50" style="margin-right: 28px; margin-bottom: 5px;"><br><strong><a id="bibWin" href="#">Bibernian</a></strong> <em>v</em></span>
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
			}   else {
				echo "<div class='col-xs-12'><div class='team-message alert alert-warning'>Click the button below to create teams.</div></div>";
			}

			//Get team B
			$sql = "SELECT id, name, playing, team, r FROM players WHERE playing='Y' AND team='B'  ORDER BY name";
			$result = $conn->query($sql);
			$resultcount = $result->num_rows;
	
			//If you've got rows, print squad
			if ($result->num_rows > 0) { ?>
	
			<div class="col-xs-6 teamBlock teamBlock__nobibs">
				<span class="teamHeader"><img src="/i/Bibno-logo.png" width="47" style="margin-bottom: 5px;"><br><a id="bibNoWin" href="#">Athletic Bibno</a></span>
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
				echo "<div class='col-xs-12'><div class='team-message alert alert-warning'>Click the button below to create teams.</div></div>";
			}
		$conn->close();
		?>
		<div class="col-xs-12" style="text-align: center;">
			<a href="https://thursdaynight.soccer/funcs/clear?clear=true">Click here to clear teams</a>	
		</div>
	</div>	
</div>



<?php include('parts/foot.php'); ?>