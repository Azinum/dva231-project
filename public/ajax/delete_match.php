<?php
	require_once("../../dbfunctions/dbconnection.php");
	require_once("../../dbfunctions/modify_match.php");

	header("Content-type: application/json;");

	// TODO(lucas): Authorization checks!!!
	if (isset($_GET["id"])) {
		if (match_delete($link, $_GET["id"])) {
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
