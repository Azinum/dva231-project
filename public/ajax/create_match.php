<?php
	require_once("../../dbfunctions/dbconnection.php");
	require_once("../../dbfunctions/get_specteaminfo.php");
	require_once("../../dbfunctions/modify_match.php");

	header("Content-type: application/json;");

	$json = file_get_contents("php://input");
	$data = json_decode($json);

	if (isset($data->team1) && isset($data->team2) && isset($data->result) && isset($data->participants)) {
		$teamdata = get_specteaminfo($link, $data->team1);
        session_start();
        if (!$_SESSION["isLoggedin"] || ($_SESSION["uid"] != $teamdata["leader"] && !$_SESSION["admin"])) {
			http_response_code(403);
			echo json_encode(["status" => "not authorized"]);
			exit();
        }

		$result = match_create($link, [
			"team1" => $data->team1,
			"team2" => $data->team2,
			"result" => $data->result,
			"participants" => $data->participants
		]);
		if ($result) {
			echo json_encode(["status" => "success", "id" => $result]);
			exit();
		}
		else {
			http_response_code(400);
			echo json_encode(["status" => "error"]);
			exit();
		}
	}
	http_response_code(400);
	echo json_encode(["status" => "error"]);
?>
