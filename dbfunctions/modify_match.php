<?php

// match_data: participants, result, teams
// TODO(lucas): Put participants in match_data, and call match_add_participants from here!
// NOTE(lucas): Team 1 is the team that created the match!
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
		return $link->insert_id;
	}
	return false;
}

function match_add_participants($link, $id, $participants, $team) {
	$id = mysqli_real_escape_string($link, $id);
	$team = mysqli_real_escape_string($link, $team);
	$query = 'DELETE FROM MatchParticipation WHERE Matches = ' . $id . ' AND Team = "' . $team . '";';
	if (!mysqli_query($link, $query)) {
		return false;
	}
	$status = true;
	for ($i = 0; $i < count($participants); ++$i) {
		$user_id = mysqli_real_escape_string($participants[$i]);
		$query = 'INSERT INTO MatchParticipation (User, Matches, Team) VALUES(' . $user_id . ', ' . $id . ', "' . $team . '")';
		if (!mysqli_query($link, $query)) {
			$status = false;
		}
	}
	return $status;
}

// match_data: participants, result
// TODO(lucas): Put participants in match_data, and call match_add_participants from here!
// NOTE(lucas): Modify results, team participants and then toggle the value of Team2ShouldVerify to pass on the control to the other team
function match_modify($link, $id, $match_data) {
	$id = mysqli_real_escape_string($link, $id);
	$result = mysqli_real_escape_string($link, $match_data["result"]);
	$query = 'UPDATE Matches SET Result = "' . $result . '" Team2ShouldVerify = !Team2ShouldVerify WHERE Id = ' . $id . ';';
	if (!mysqli_query($link, $query)) {
		return false;
	}
	// TODO(lucas): Participants
	return false;
}

function match_verify($link, $id) {
	$id = mysqli_real_escape_string($link, $id);

	return false;
}

function match_delete($link, $id) {
	$id = mysqli_real_escape_string($link, $id);
	$query = 'DELETE FROM MatchParticipation WHERE Matches = ' . $id . ';';
	if (mysqli_query($link, $query)) {
		$query = 'DELETE FROM Matches WHERE Id = ' . $id . ';';
		if (mysqli_query($link, $query)) {
			return true;
		}
	}
	return false;
}
