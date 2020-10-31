<?php

// match_data: participants, result, teams
// NOTE(lucas): Team 1 is the team that created the match!
// Returns true for success, false for failure
function match_create($link, $match_data) {
	if (!$match_data) {
		return false;
	}
	// echo var_dump($match_data);
	$team1 = mysqli_real_escape_string($link, $match_data["team1"]);
	$team2 = mysqli_real_escape_string($link, $match_data["team2"]);
	$result = mysqli_real_escape_string($link, $match_data["result"]);
	$query = 'INSERT INTO Matches (Matches.IsVerified, Matches.Result, Matches.Team1, Matches.Team2, Matches.Team2ShouldVerify) ' .
		' VALUES(0, "' . $result . '", "' . $team1 . '", "' . $team2 . '", TRUE);';
	if ($result = mysqli_query($link, $query)) {
		return true;
	}
	return false;
}


// Exclude participants in a team that haven't accepted their invite yet, just in case.
function match_add_participants($link, $id, $participants, $team) {
	$id = mysqli_real_escape_string($link, $id);
	$team = mysqli_real_escape_string($link, $team);
	$query = '';
}

function match_modify($link, $id, $match_data, $team) {
	$id = mysqli_real_escape_string($link, $id);
	$team = mysqli_real_escape_string($link, $team);

	return false;
}

function match_verify($link, $id, $team) {
	$id = mysqli_real_escape_string($link, $id);
	$team = mysqli_real_escape_string($link, $team);

	return false;
}

function match_delete($link, $id, $team) {
	$id = mysqli_real_escape_string($link, $id);
	$team = mysqli_real_escape_string($link, $team);
	$query = 'DELETE FROM Matches WHERE Id = ' . $id . ';';

	return false;
}

?>
