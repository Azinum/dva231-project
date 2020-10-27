<?php

function get_match_info($link, $id) {
	$query = 'SELECT T1.Id, T1.Result, T1.IsVerified, T1.Team2ShouldVerify, ' .
		'T1.TeamName AS T1TeamName, ' .
		'T1.DisplayName AS T1DisplayName, ' .
		'T1.TeamImage AS T1TeamImage, ' .
		'T2.TeamName AS T2TeamName, ' .
		'T2.DisplayName AS T2DisplayName, ' .
		'T2.TeamImage AS T2TeamImage ' .
		'FROM ' .
		'	(SELECT Matches.*, DisplayName, TeamName, TeamImage FROM Matches JOIN Team ON Matches.Id=' . $id .
		'	AND (Team.TeamName = Matches.Team1)) AS T1 ' .
		'JOIN ' .
		'	(SELECT Matches.*, DisplayName, TeamName, TeamImage FROM Matches JOIN Team ON Matches.Id=' . $id .
		'	AND (Team.TeamName = Matches.Team2)) AS T2;';
	$final_result = [];

	if ($result = mysqli_query($link, $query)) {
		$res_array = mysqli_fetch_assoc($result);
		$final_result = [
			"id" => $res_array["Id"],
			"result" => $res_array["Result"],
			"is_verified" => $res_array["IsVerified"],
			"team2_should_verify" => $res_array["Team2ShouldVerify"],

			"teams" => [
				[
					"name" => $res_array["T1TeamName"],
					"display_name" => $res_array["T1DisplayName"],
					"image" => $res_array["T1TeamImage"]
				],
				[
					"name" => $res_array["T2TeamName"],
					"display_name" => $res_array["T2DisplayName"],
					"image" => $res_array["T2TeamImage"]
				]
			]
		];
	}
	// echo var_dump($final_result);
	return $final_result;
}

function get_match_participants($link, $id, $team) {
	$teamName = mysqli_real_escape_string();
}

?>