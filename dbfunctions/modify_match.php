<?php

// match_data: participants, result, teams
// NOTE(lucas): Team 1 is the team that created the match!
// Returns true for success, false for failure
function match_create($link, $match_data) {
	if (!$match_data) {
		return false;
	}
	$team1 = mysqli_real_escape_string($match_data["team1"]);
	$team2 = mysqli_real_escape_string($match_data["team2"]);
	$result = mysqli_real_escape_string($match_data["result"]);
	$query = 'INSERT INTO Matches (Matches.IsVerified, Matches.Result, Matches.Team1, Matches.Team2, Matches.Team2ShouldVerify) ' .
			' VALUES(0, "' . $result . '", "' . $team1. '", "' . $team2 . '", TRUE);';
	if ($result = mysqli_query($link, $query)) {
		return true;
	}
	return false;
}

function match_add_participants($link, $id, $participants, $team) {
	$id = mysqli_real_escape_string($id);
	$team = mysqli_real_escape_string($team);
	$query = '';
}

// $team is for seeing who is modifying the match
function match_modify($link, $id, $match_data, $team) {
	$id = mysqli_real_escape_string($id);
	$team = mysqli_real_escape_string($team);

	return false;
}

function match_verify($link, $id, $team) {
	$id = mysqli_real_escape_string($id);
	$team = mysqli_real_escape_string($team);

	return false;
}

function match_delete($link, $id, $team) {
	$id = mysqli_real_escape_string($id);
	$team = mysqli_real_escape_string($team);
	$query = 'DELETE FROM Matches WHERE Id = ' . $id . ';';

	return false;
}

?>
