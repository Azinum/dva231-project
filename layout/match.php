<?php

require_once("../dbfunctions/get_match.php");
require_once("../dbfunctions/get_specteaminfo.php");
require_once("../dbfunctions/escapes.php");

$match_info = [];

function match_get_info_script($link) {
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

	if ($info["match"]["is_verified"] && $modify) {
		header("Location: /match.php?view=" . $info["id"]);
		exit();
	}

	$teams = $info["match"]["teams"];
    $team1data = get_specteaminfo($link, $teams[0]["name"]);
    $team2data = get_specteaminfo($link, $teams[1]["name"]);
    if (!$_SESSION["admin"]) {
        if ($info["match"]["team2_should_verify"]) {
            if ($info["modify"] && $_SESSION["uid"] != $team2data["leader"]) {
                header("Location: /match.php?view=" . $info["id"]);
                exit();
            }
        } else {
            if ($info["modify"] && $_SESSION["uid"] != $team1data["leader"]) {
                header("Location: /match.php?view=" . $info["id"]);
                exit();
            }
        }
    }

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
		echo '<h2>' . htmlspecialchars($team_info["display_name"]) . '</h2>';
		$img = $team_info["image"] ? $team_info["image"] : "img/default_profile_image.svg";
		echo '
			<div class="match-team-content">
				<img class="match-team-img" src="' . htmlspecialchars($img) . '">
			</div>
		';
	}
	else {
		echo '
			<h2>' . htmlspecialchars($default_name) . '</h2>
			<div class="match-team-content">
				<img class="match-team-img basic-interactive" src="img/default_profile_image.svg" onclick="selectTeam(this, ' . equot($state["team"]) . ');">
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
				<img src="' . htmlspecialchars($img) . '">
				<p>' . htmlspecialchars($user["name"]). '</p>
			</div>
		';
	}
	else if ($info["modify"]) {
		$img = $user["image"] ? $user["image"] : "img/default_profile_image.svg";
		echo '
			<div class="match-player-img basic-interactive" onclick="selectPlayer(this, ' . equot($state["team"]). ', ' . equot($state["index"]) . ');">
				<img src="' . $img . '">
				<p>' . $user["name"]. '</p>
			</div>
		';
	}
	else {
		echo '
			<div class="match-player-img basic-interactive" onclick="selectPlayer(this, ' . equot($state["team"]). ', ' . equot($state["index"]) . ');">
				<img src="img/default_profile_image.svg">
				<p></p>
			</div>
		';
	}
}

function match_result_label_checked($statement, $text, $is_disabled, $id) {
	echo '
		<label>
			<input type="radio" ' . ($statement ? "checked" : "") . ' name="match_result" ' . ($is_disabled ? "disabled" : "") .' id="' . "match-result-" . $id . '">
			' . htmlspecialchars($text) . '
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
			match_result_label_checked($result == "Team1Win", $teams[0]["display_name"] . " Won", true, 0);
			match_result_label_checked($result == "Tie", "Game Was Tied", true, 1);
			match_result_label_checked($result == "Team2Win", $teams[1]["display_name"] . " Won", true, 2);
		echo '</div>';
	}
	else if ($info["modify"]) {
		$result = $match["result"];
		echo '<div id="match-result">';
			match_result_label_checked($result == "Team1Win", $teams[0]["display_name"] . " Won", false, 0);
			match_result_label_checked($result == "Tie", "Game Was Tied", false, 1);
			match_result_label_checked($result == "Team2Win", $teams[1]["display_name"] . " Won", false, 2);
		echo '</div>';
	}
	else {
		echo '<div id="match-result">';
			match_result_label_checked(true, "You Won", false, 0);
			match_result_label_checked(false, "Game Was Tied", false, 1);
			match_result_label_checked(false, "Opponent Won", false, 2);
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
