<?php

require_once("../dbfunctions/get_match.php");

$match_info = [];

function match_get_info($link) {
	$info = $GLOBALS["match_info"];
	if ($info) {
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
	$info["match"] = get_match_info($link, $info["id"]);
	$teams = $info["match"]["teams"];
	$info["team_participants"] = [
		get_match_participants($link, $info["id"], $teams[0]["name"]),
		get_match_participants($link, $info["id"], $teams[1]["name"])
	];

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
		echo '<h2>' . $team_info["name"] . '</h2>';
		$img = $team_info["image"] ? $team_info["image"] : "img/default_profile_image.svg";
		echo '
			<div class="match-team-content">
				<img class="match-team-img match-box" src="' . $img . '">
			</div>
		';
	}
	else {
		echo '
			<h2>' . $default_name . '</h2>
			<div class="match-team-content">
				<img class="match-team-img match-box basic-interactive" src="img/default_profile_image.svg" onclick="selectTeam(this, ' . $state["team"] . ');">
			</div>
		';
	}
}

function match_get_status() {
	$info = match_get_info_state();
	$match_state = $info["match"];
	if (!isset($match_state["is_verified"])) {
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
// TODO(lucas): Redirect to page not found (of maybe to match view) when trying to modify a match that has already been verified
function match_participant_box($state, $team_index) {
	$info = match_get_info_state();
	$team_participants = $info["team_participants"][$team_index];
	$user = $team_participants[$state["index"]];

	if ($info["view"]) {
		$img = $user["image"] ? $user["image"] : "img/default_profile_image.svg";
		echo '
			<img class="match-player-img match-box" src="' . $img . '">
			<small>' . $user["name"]. '</small>
		';
	}
	else if ($info["modify"]) {
		$img = $user["image"] ? $user["image"] : "img/default_profile_image.svg";
		echo '
			<img class="match-player-img match-box basic-interactive" src="' . $img . '" onclick="selectPlayer(this, ' . $state["team"]. ', ' . $state["index"] . ');">
			<small>' . $user["name"]. '</small>
		';
	
	}
	else {
		echo '
			<img class="match-player-img match-box basic-interactive" src="img/default_profile_image.svg" onclick="selectPlayer(this, ' . $state["team"]. ', ' . $state["index"] . ');">
		';
	}
}

function match_submit_box($state) {
	$info = match_get_info_state();

	if ($info["view"]) {

	}
	else if ($info["modify"]) {
		echo '<div class="match-button button button-accept" onclick="alert();">Verify Results</div>';
		echo '<div class="match-button button button-submit" onclick="submitMatch();">Submit Changes</div>';
	}
	else {
		echo '<div class="match-button button button-submit" onclick="submitMatch();">Submit</div>';
	}
}
