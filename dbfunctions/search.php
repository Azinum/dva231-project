<?php

    function search_users($link, $query_string) {
        $query = 'SELECT * FROM User WHERE Username LIKE "%' . mysqli_real_escape_string($link, $query_string) . '%";';
        $return = [];
        if ($result = mysqli_query($link, $query)) {
            while ($res_array = mysqli_fetch_assoc($result)) {
                if ($res_array['Id'] !== NULL) {
                    array_push($return, [
                       "name" => $res_array['Username'],
                       "img_url" => $res_array['ProfileImageUrl'],
                       "bio" => $res_array['Bio'],
                       "is_admin" => $res_array['IsAdmin'],
                       "is_banned" => $res_array['IsBanned'],
                       "user_id" => $res_array['Id']
                    ]);
                }
            }
        }
        return $return;
    }

	function search_users_in_team($link, $team, $query_string) {
		$teamName = mysqli_real_escape_string($link, $team);
		$userName = mysqli_real_escape_string($link, $query_string);
		$query = 'SELECT * FROM User, TeamMemberships WHERE User.Id = TeamMemberships.Member AND TeamMemberships.TeamName = "' . $teamName .'" AND User.Username LIKE "%' . $userName . '%";';
		$final_result = [];
		if ($result = mysqli_query($link, $query)) {
			while ($res_array = mysqli_fetch_assoc($result)) {
				array_push($final_result, [
					"name" => $res_array['Username'],
					"mail" => $res_array['Email'],
					"img_url" => $res_array['ProfileImageUrl'],
					"bio" => $res_array['Bio'],
					"is_admin" => $res_array['IsAdmin'],
					"is_banned" => $res_array['IsBanned'],
					"user_id" => $res_array['Id']
				]);
			}
		}
		return $final_result;
	}

	function get_users_in_team($link, $team) {
		$teamName = mysqli_real_escape_string($link, $team);
		$query = 'SELECT * FROM User, TeamMemberships WHERE User.Id = TeamMemberships.Member AND TeamMemberships.TeamName = "' . $teamName .'";';
		$final_result = [];
		if ($result = mysqli_query($link, $query)) {
			while ($res_array = mysqli_fetch_assoc($result)) {
				array_push($final_result, [
					"name" => $res_array['Username'],
					"mail" => $res_array['Email'],
					"img_url" => $res_array['ProfileImageUrl'],
					"bio" => $res_array['Bio'],
					"is_admin" => $res_array['IsAdmin'],
					"is_banned" => $res_array['IsBanned'],
					"user_id" => $res_array['Id']
				]);
			}
		}
		return $final_result;
	}

	function search_teams($link, $query_string) {
		$teamName = mysqli_real_escape_string($link, $query_string);
		$query = 'SELECT * FROM Team WHERE TeamName LIKE "%' . $teamName . '%";';
		$final_result = [];
		if ($result = mysqli_query($link, $query)) {
			while ($res_array = mysqli_fetch_assoc($result)) {
				if (!$res_array['IsBanned']) {
					array_push($final_result, [
						"name" => $res_array['TeamName'],
						"img_url" => $res_array['TeamImage'],
						"bio" => $res_array['Bio'],
						"team_ranking" => $res_array['TeamRanking']
					]);
				}
			}
		}
		return $final_result;
	}
?>
