<?php
session_start();

require_once("header.php");
require_once("../dbfunctions/dbconnection.php");
require_once("../dbfunctions/auth.php");
require_once("../layout/match.php");
require_once("../layout/navbar_dropdown.php");

match_get_info($link);

check_loginstatus();

page_begin("Match Results");
?>
	<div class="navbar shadow">
        <?php build_buttons(); ?>
    </div>
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
			Match states:
			1) Initial create state. Won't be stored on the database until it's sent.
			2) Under revision (a team should verify): Either this could be directly after one team created and sent the match results to the other team, or it could be when the other team sent it back. The other team saw an error in the match results, so they sent it back with edited results.
			3) Complete (verified)
		-->
		<form>
			<div class="match-content-box shadow team1">
				<?php match_team_box(["team" => "Teams.TEAM1"], "Team 1 (you)", 0); ?>
			</div>
			<div class="match-content-box shadow">
				<h4>Participants:</h4>
				<div class="match-participants team1">
					<?php
						match_participant_box(["index" => 0, "team" => "Teams.TEAM1"], 0);
						match_participant_box(["index" => 1, "team" => "Teams.TEAM1"], 0);
						match_participant_box(["index" => 2, "team" => "Teams.TEAM1"], 0);
						match_participant_box(["index" => 3, "team" => "Teams.TEAM1"], 0);
						match_participant_box(["index" => 4, "team" => "Teams.TEAM1"], 0);
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
						match_participant_box(["index" => 0, "team" => "Teams.TEAM2"], 1);
						match_participant_box(["index" => 1, "team" => "Teams.TEAM2"], 1);
						match_participant_box(["index" => 2, "team" => "Teams.TEAM2"], 1);
						match_participant_box(["index" => 3, "team" => "Teams.TEAM2"], 1);
						match_participant_box(["index" => 4, "team" => "Teams.TEAM2"], 1);
					?>
				</div>
			</div>

			<br><div class="line-wide"></div>

			<h2>Result</h2>

			<?php match_result_box([]); ?>

			<?php match_submit_box([]); ?>
		</form>
	</div>
<?php page_end(); ?>
