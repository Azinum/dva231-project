<!DOCTYPE html>
<html>

<?php
require_once("../layout/shadow.php");
?>

<!-- TODO(lucas): Replace header! -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Match Results</title>

	<link href= "css/match.css" rel="stylesheet">
	<link href= "css/shadow.css" rel="stylesheet">

	<script src="js/match.js"></script>
	<script src="js/shadow.js"></script>
</head>

<body>
	<div class="match-content">
		<h1>Match Result</h1>
		<div class="line-wide"></div>

		<!-- 
			There will be four possible states that the match result page can be in:
			1) Initial (create state)
				* This state is not to be stored on the database.
				* All other states will be stored.
			2) Under revision: Either this could be directly after one team created and sent the match results to the other team, or it could be when the other team sent it back.
			3) Uncomplete: The other team saw an error in the match results, so they sent it back with edited results. The state is now back to #2.
			4) Complete
		-->
		<form>
			<div class="match-content-box match-shadow-box">
				<h2>Team 1 (you)</h2>
				<!-- TODO(lucas): Add dropdown search menus -->
				<img class="match-team-img match-border basic-interactive" src="img/tmp_team.jpeg">
			</div>
			<div class="match-content-box match-shadow-box">
				<h4>Participants:</h4>
				<!-- TODO(lucas): Add dropdown search menus -->
				<img class="match-player-img basic-interactive" src="img/tmp_team.jpeg">
				<img class="match-player-img basic-interactive" src="img/tmp_team.jpeg">
				<img class="match-player-img basic-interactive" src="img/tmp_team.jpeg">
				<img class="match-player-img basic-interactive" src="img/tmp_team.jpeg">
				<img class="match-player-img basic-interactive" src="img/tmp_team.jpeg">
			</div>

			<div class="line-wide"></div>

			<div class="match-content-box match-shadow-box">
				<h2>Team 2 (opponent)</h2>
				<img class="match-team-img match-border basic-interactive" src="img/tmp_team2.jpeg">
			</div>

			<div class="match-content-box match-shadow-box">
				<h4>Participants:</h4>
				<img class="match-player-img basic-interactive" src="img/tmp_team2.jpeg">
				<img class="match-player-img basic-interactive" src="img/tmp_team2.jpeg">
				<img class="match-player-img basic-interactive" src="img/tmp_team2.jpeg">
				<img class="match-player-img basic-interactive" src="img/tmp_team2.jpeg">
				<img class="match-player-img basic-interactive" src="img/tmp_team2.jpeg">
			</div>

			<div class="line-wide"></div>

			<h2>Result</h2>

			<label>
				<input type="radio" checked="checked" name="match_result">
				<span class="checkmark"></span>
				You won
			</label>
			<br>

			<label>
				<input type="radio" name="match_result">
				<span class="checkmark"></span>
				Tied
			</label>
			<br>

			<label>
				<input type="radio" name="match_result">
				<span class="checkmark"></span>
				Opponent won
			</label>
			<br>

			<br>

			<input value="SUBMIT" type="submit" class="match-submit button-submit"></input>
		</form>
	</div>
</body>
</html>
