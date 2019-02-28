<?php
	
//Super basic login stuff
$password = "walker";
$nonsense = "bkdsbiuewibew863267i7dwn8";

//Does cookie exist?
if (isset($_COOKIE['Login'])) {
	
	//Is cookie right?	
   if ($_COOKIE['Login'] == md5($password.$nonsense)) { ?>

<?php include('parts/head.php'); ?>

<body id="home">

<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
    	<li class="active"><a href="/">Players</a></li>
    	<li><a href="/teams">Teams</a></li>
    </ul>
  </div>
</nav>
	<div class="container-fluid page__wrapper">

		<?php require('funcs/db.php');

	//Get rows
	$sql = "SELECT id, name, playing FROM players ORDER BY name";
	$result = $conn->query($sql);

	//If you've got rows, print table
	if ($result->num_rows > 0) { ?>

		<table id="players" class="table table-hover">
			<thead>
				<tr>
					<th>
						Name
					</th>
					<th>
						Playing?
					</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<? // output data of each row
					while($row = $result->fetch_assoc()) {
						$status = "";
						$Yplaying = "";
						$Nplaying = "";
						if ($row["playing"] === "Y") {$Yplaying = "CHECKED"; $status = "success";}
						else if ($row["playing"] === "N") {$Nplaying = "CHECKED"; $status = "danger";}
						echo "
					        <tr class='player_".$row["id"]." ".$status." '>
					        	<td>" . $row["name"]. "</td>
								<td><span style='display:none;'>" . $row["playing"]. "</span>
					        		<label class='radio-inline'>
									<input class='playing' type='radio' name='playing_".$row["id"]."' value='Y' ".$Yplaying.">Y</label> 
									<label class='radio-inline'><input class='playing' type='radio' name='playing_".$row["id"]."' value='N' ".$Nplaying.">N</label>
									<span class='clear'>clear</span>
								</td>
								<td class='delete-col'>
									<span class='del'>X</span>
								</td>
							</tr>";
    				} ?>
			</tbody>
			<tfoot>
				<tr class="info">
					<td><strong>Total player count:</strong></td>
					<td class="count"></td>
					<td></td>
    			</tr>
    			<!--<tr class="info">
					<td><strong>Subs:</strong></td>
					<td class="cost"></td>
					<td></td>
    			</tr>-->
    		</tfoot>
    	</table>
		
		<?php
		//If no players
		} else {
			echo "<p>0 Players</p>";
		}
		$conn->close(); ?>
	
		<form id="newPlayer">
			<div class="form-group">
				<label for="name">New Player</label>
				<input type="text" class="form-control" id="name" name="name" placeholder="Name">
		  	</div>
		  	<button type="submit" class="btn btn-success">Add Player</button>
		</form>
	
	
	</div>

<?php include('parts/foot.php'); ?>

<?php
	exit; 
	} else {
    	echo "Bad Cookie.";
		exit;
   	}
}

//Are we logging in?
if (isset($_GET['p']) && $_GET['p'] == "login") {
	if ($_POST['keypass'] != $password) {
      echo "Invalid team name";
      exit;
   } else if ($_POST['keypass'] == $password) {
      setcookie('Login', md5($_POST['keypass'].$nonsense), time() + (86400 * 300));
      header("Location: $_SERVER[PHP_SELF]");
   } else {
      echo "Error logging in...";
   }
}

// Show login
?>

<?php include('parts/head.php'); ?>

<body id="login">
	<div class="container-fluid">
		<form id="login" action="<?php echo $_SERVER['PHP_SELF']; ?>?p=login" method="post">
			<div class="form-group">
				<label for="keypass">Team name</label>
				<input type="text" class="form-control" name="keypass" id="keypass">
			</div>
			<button type="submit" class="btn btn-default">Enter</button>
		</form>
	</div>
</body>