<?php

require_once("../dbfunctions/get_match.php");

$match_info = [];

// TODO(lucas): Do more checks to see if the user can access the page, check to see if the match exists e.t.c. Redirect when nessesary.
// TODO(lucas): Fix so that anyone (no login required) can access match view page!
function match_get_info($link) {
	$info = $GLOBALS["match_info"];
	if ($info) {
		// We shouldn't really get to this place because this function should only be called once
		return;
	}
	$info = [];
	$view = $_GET["view"];
	$modify = $_GET["modify"];
	if ($view) {
		$info["view"] = true;
		$info["id"] = $view;
	}
	else if ($modify) {
		$info["modify"] = true;
		$info["id"] = $modify;
	}
	$info["uid"] = $_SESSION["uid"];
	$info["match"] = get_match_info($link, $info["id"]);
	if (!$info["match"] && ($info["view"] || $info["modify"])) {
		header("Location: /match.php");
		exit();
	}
	$teams = $info["match"]["teams"];
	$info["team_participants"] = [
		get_match_participants($link, $info["id"], $teams[0]["name"]),
		get_match_participants($link, $info["id"], $teams[1]["name"])
	];

	if ($info["match"]["is_verified"] && $modify) {
		header("Location: /match.php?view=" . $info["id"]);
		exit();
	}

	$GLOBALS["match_info"] = $info;
	echo '<script>var matchData = ' . json_encode($info) . ';</script>';
}


function match_get_info_state() {
	return $GLOBALS["match_info"];
}

function match_team_box($state, $default_name, $team_index) {
	$info = match_get_info_state();
	$team_info = $info["match"]["teams"][$team_index];

	if ($info["view"] || $info["modify"]) {
		echo '<h2>' . $team_info["display_name"] . '</h2>';
		$img = $team_info["image"] ? $team_info["image"] : "img/default_profile_image.svg";
		echo '
			<div class="match-team-content">
				<img class="match-team-img" src="' . $img . '">
			</div>
		';
	}
	else {
		echo '
			<h2>' . $default_name . '</h2>
			<div class="match-team-content">
				<img class="match-team-img basic-interactive" src="img/default_profile_image.svg" onclick="selectTeam(this, ' . $state["team"] . ');">
			</div>
		';
	}
}

function match_get_status() {
	$info = match_get_info_state();
	$match_state = $info["match"];
	if (!$match_state) {
		echo '<p>Status: Creating match</p>';
	}
	else if ($match_state["is_verified"]) {
		echo '<p>Status: Verified</p>';
	}
	else {
		echo '<p>Status: Under revision</p>';
	}
}

// Create match: You have the ability to select teams, team participants and match results.
// Modify match: You only have the ability to edit team members and match results.
// TODO(lucas): Add match not found page (when trying to access a match page that doesn't exist, both for viewing and modifying)
function match_participant_box($state, $team_index) {
	$info = match_get_info_state();
	$team_participants = $info["team_participants"][$team_index];
	$user = $team_participants[$state["index"]];

	if ($info["view"]) {
		$img = $user["image"] ? $user["image"] : "img/default_profile_image.svg";
		echo '
			<div class="match-player-img">
				<img src="' . $img . '">
				<p>' . $user["name"]. '</p>
			</div>
		';
	}
	else if ($info["modify"]) {
		$img = $user["image"] ? $user["image"] : "img/default_profile_image.svg";
		echo '
			<div class="match-player-img basic-interactive" onclick="selectPlayer(this, ' . $state["team"]. ', ' . $state["index"] . ');">
				<img src="' . $img . '">
				<p>' . $user["name"]. '</p>
			</div>
		';
	}
	else {
		echo '
			<div class="match-player-img basic-interactive" onclick="selectPlayer(this, ' . $state["team"]. ', ' . $state["index"] . ');">
				<img src="img/default_profile_image.svg">
				<p></p>
			</div>
		';
	}
}

function match_result_label_checked($statement, $text, $is_disabled) {
	echo '
		<label>
			<input type="radio" ' . ($statement ? "checked" : "") . ' name="match_result" ' . ($is_disabled ? "disabled" : "") .'>
			' . $text . '
		</label>
		<br>
	';
}

// TODO(lucas): Display which team you are (in case one would forget who they are lol)
function match_result_box($state) {
	$info = match_get_info_state();
	$match = $info["match"];
	$teams = $match["teams"];

	if ($info["view"] || $info["is_verified"]) {
		$result = $match["result"];
		echo '<div id="match-result">';
			match_result_label_checked($result == "Team1Win", $teams[0]["display_name"] . " Won", true);
			match_result_label_checked($result == "Tie", "Game Was Tied", true);
			match_result_label_checked($result == "Team2Win", $teams[1]["display_name"] . " Won", true);
		echo '</div>';
	}
	else if ($info["modify"]) {
		$result = $match["result"];
		echo '<div id="match-result">';
			match_result_label_checked($result == "Team1Win", $teams[0]["display_name"] . " Won", false);
			match_result_label_checked($result == "Tie", "Game Was Tied", false);
			match_result_label_checked($result == "Team2Win", $teams[1]["display_name"] . " Won", false);
		echo '</div>';
	}
	else {
		echo '<div id="match-result">';
			match_result_label_checked(true, "You Won", false);
			match_result_label_checked(false, "Game Was Tied", false);
			match_result_label_checked(false, "Opponent Won", false);
		echo '</div>';
	}
}

function match_submit_box($state) {
	$info = match_get_info_state();

	if ($info["view"]) {
	}
	else if ($info["modify"]) {
		echo '<div class="match-button button button-accept" onclick="verifyMatchResults();">Verify Results</div>';
		echo '<div class="match-button button button-submit" onclick="submitMatchChanges();">Submit Changes</div>';
		// TODO(lucas): We really should have an error prevention mechanism here; a popup window or the like.
		// Maybe even having an error prevention mechanisms on all of these buttons would be advantageous!
		echo '<div class="match-button button button-deny" onclick="declineMatch();">Decline</div>';
	}
	else {
		echo '<div class="match-button button button-submit" onclick="submitMatch();">Submit</div>';
	}
}
