<?php
	require_once("../../dbfunctions/dbconnection.php");
	require_once("../../dbfunctions/modify_match.php");

	header("Content-type: application/json;");

	// TODO(lucas): Authorization checks!!!
	// Which team are trying to delete the match?
	if (isset($_GET["id"]) && isset($_GET["team"])) {
		if (match_delete($link, $_GET["id"]), $_GET["team"]) {
			echo json_encode(["status" => "success"]);
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
