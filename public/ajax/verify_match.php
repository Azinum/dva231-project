<?php
	require_once("../../dbfunctions/dbconnection.php");
	require_once("../../dbfunctions/modify_match.php");

	header("Content-type: application/json;");

	// TODO(lucas): Authorization checks!!!
	if (isset($_GET["id"])) {
		$result = match_verify($link, $_GET["id"]);
		if ($result) {
			echo json_encode(["status" => "success", "result" => $result]);
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
