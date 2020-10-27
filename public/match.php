<?php
session_start();

require_once("header.php");
require_once("../dbfunctions/dbconnection.php");
require_once("../dbfunctions/auth.php");
require_once("../layout/match.php");

match_get_info($link);

check_loginstatus();

page_begin("Match Results");
?>
	<?php include("navbar_final.php"); ?>
	<div class="match-search-overlay">
		<div class="match-search-overlay-content">
			<div class="closebox shadow" onclick="toggleOverlay();">x</div>

			<div class="overlay-popup match-content-box shadow"></div>

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
		<?php match_get_status(); ?>
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
			<div class="match-content-box shadow team1">
				<?php match_team_box(["team" => "Teams.TEAM1"], "Team 1 (you)", 0); ?>
			</div>
			<div class="match-content-box shadow">
				<h4>Participants:</h4>
				<div class="match-participants team1">
					<?php
						match_participant_box(["index" => 0, "team" => "Teams.TEAM1"]);
						match_participant_box(["index" => 1, "team" => "Teams.TEAM1"]);
						match_participant_box(["index" => 2, "team" => "Teams.TEAM1"]);
						match_participant_box(["index" => 3, "team" => "Teams.TEAM1"]);
						match_participant_box(["index" => 4, "team" => "Teams.TEAM1"]);
					?>
				</div>
			</div>

			<br><div class="line-wide"></div>

			<div class="match-content-box shadow team2">
				<?php match_team_box(["team" => "Teams.TEAM2"], "Team 2 (opponent)", 1); ?>
			</div>

			<div class="match-content-box shadow">
				<h4>Participants:</h4>
				<div class="match-participants team2">
					<?php
						match_participant_box(["index" => 0, "team" => "Teams.TEAM2"]);
						match_participant_box(["index" => 1, "team" => "Teams.TEAM2"]);
						match_participant_box(["index" => 2, "team" => "Teams.TEAM2"]);
						match_participant_box(["index" => 3, "team" => "Teams.TEAM2"]);
						match_participant_box(["index" => 4, "team" => "Teams.TEAM2"]);
					?>
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

			<?php match_submit_box([]); ?>
