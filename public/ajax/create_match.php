<?php
	require_once("../../dbfunctions/dbconnection.php");
	require_once("../../dbfunctions/modify_match.php");

	header("Content-type: application/json;");

	// TODO(lucas): Authorization checks!!!
	if (isset($_GET["team1"]) && isset($_GET["team1"]) && isset($_GET["result"])) {
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
