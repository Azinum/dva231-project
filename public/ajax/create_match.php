<?php
	require_once("../../dbfunctions/dbconnection.php");
	require_once("../../dbfunctions/get_specteaminfo.php");
	require_once("../../dbfunctions/modify_match.php");

	header("Content-type: application/json;");

	// TODO(lucas): Authorization checks!!!
	if (isset($_GET["team1"]) && isset($_GET["team2"]) && isset($_GET["result"])) {
        $teamdata = get_specteaminfo($link, $_GET["team1"]);
        session_start();
        if (!$_SESSION["isLoggedin"] || ($_SESSION["uid"] != $teamdata["leader"] && !$_SESSION["admin"])) {
			http_response_code(403);
			echo json_encode(["status" => "not authorized"]);
			exit();
        }

		$result = match_create($link, [
			"team1" => $_GET["team1"],
			"team2" => $_GET["team2"],
			"result" => $_GET["result"]
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
