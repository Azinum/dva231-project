<?php require_once("header.php"); ?>
<?php page_begin("Match Results"); ?>
	<?php include("navbar_final.php"); ?>
	<div class="match-search-overlay">
		<div class="match-search-overlay-content">
			<div class="closebox shadow" onclick="toggleOverlay();">x</div>

			<div class="overlay-popup match-content-box shadow">
				Error: This is a very big error message!
			</div>

			<div class="match-search">
				<form class="match-shadow-box">
					<input class="text-input-field" type="text" oninput="onSearchEvent();" placeholder="Search...">
				</form>
				<br>
				<div class="match-search-results">
				</div>
			</div>
		</div>
	</div>
	<div class="content-column">
		<h1>Match Result</h1>
		<div class="line-wide"></div>

		<!-- 
			There will be four possible states that the match result page can be in:
			1) Initial (create state)
				* This state is not to be stored on the database.
				* All other states will be stored.
			2) Under revision: Either this could be directly after one team created and sent the match results to the other team, or it could be when the other team sent it back.
			3) Uncomplete: The other team saw an error in the match results, so they sent it back with edited results. The state will then go back to #2.
			4) Complete
		-->
		<form>
			<div class="match-content-box shadow">
				<h2 class="team1">Team 1 (you)</h2>
				<div class="match-team-content">
					<img class="match-team-img match-box basic-interactive" src="img/default_profile_image.svg" onclick="selectTeam(this, Teams.TEAM1);">
				</div>
			</div>
			<div class="match-content-box shadow">
				<h4>Participants:</h4>
				<div class="match-participants team1">
					<img class="match-player-img basic-interactive match-box" src="img/default_profile_image.svg" onclick="selectPlayer(this, Teams.TEAM1, 0);">
					<img class="match-player-img basic-interactive match-box" src="img/default_profile_image.svg" onclick="selectPlayer(this, Teams.TEAM1, 1);">
					<img class="match-player-img basic-interactive match-box" src="img/default_profile_image.svg" onclick="selectPlayer(this, Teams.TEAM1, 2);">
					<img class="match-player-img basic-interactive match-box" src="img/default_profile_image.svg" onclick="selectPlayer(this, Teams.TEAM1, 3);">
					<img class="match-player-img basic-interactive match-box" src="img/default_profile_image.svg" onclick="selectPlayer(this, Teams.TEAM1, 4);">
				</div>
			</div>

			<br><div class="line-wide"></div>

			<div class="match-content-box shadow">
				<h2 class="team2">Team 2 (opponent)</h2>
				<div class="match-team-content">
					<img class="match-team-img match-box basic-interactive" src="img/default_profile_image.svg" onclick="selectTeam(this, Teams.TEAM2);">
				</div>
			</div>

			<div class="match-content-box shadow">
				<h4>Participants:</h4>
				<div class="match-participants team2">
					<img class="match-player-img basic-interactive match-box" src="img/default_profile_image.svg" onclick="selectPlayer(this, Teams.TEAM2, 0);">
					<img class="match-player-img basic-interactive match-box" src="img/default_profile_image.svg" onclick="selectPlayer(this, Teams.TEAM2, 1);">
					<img class="match-player-img basic-interactive match-box" src="img/default_profile_image.svg" onclick="selectPlayer(this, Teams.TEAM2, 2);">
					<img class="match-player-img basic-interactive match-box" src="img/default_profile_image.svg" onclick="selectPlayer(this, Teams.TEAM2, 3);">
					<img class="match-player-img basic-interactive match-box" src="img/default_profile_image.svg" onclick="selectPlayer(this, Teams.TEAM2, 4);">
				</div>
			</div>

			<br><div class="line-wide"></div>

			<h2>Result</h2>

			<!-- TODO(lucas): Create fancy custom radio buttons -->
			<div class="match-result">
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
			</div>

			<br>

			<!-- <input value="SUBMIT" type="submit" class="button button-submit" onclick="submitMatch();"></input> -->
			<div class="button button-submit" onclick="submitMatch();">SUBMIT</div>
		</form>
	</div>
<?php page_end(); ?>
