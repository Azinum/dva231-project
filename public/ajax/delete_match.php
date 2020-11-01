<?php
	require_once("../../dbfunctions/dbconnection.php");
	require_once("../../dbfunctions/get_specteaminfo.php");
	require_once("../../dbfunctions/get_match.php");
	require_once("../../dbfunctions/modify_match.php");

	header("Content-type: application/json;");

	// TODO(lucas): Authorization checks!!!
	if (isset($_GET["id"])) {
        session_start();
        if (!$_SESSION["isLoggedin"]) {
			http_response_code(403);
			echo json_encode(["status" => "not authorized"]);
			exit();
        }
        $match = get_match_info($link, $_GET["id"]);
        if (!$match["is_verified"]) {
            if (!$_SESSION["admin"]) {
                if ($match["team2_should_verify"]) {
                    $team2data = get_specteaminfo($link, $match["teams"][1]["name"]);
                    if ($_SESSION["uid"] != $team2data["leader"]) {
                        http_response_code(403);
                        echo json_encode(["status" => "not authorized"]);
                        exit();
                    }
                } else {
                    $team1data = get_specteaminfo($link, $match["teams"][0]["name"]);
                    if ($_SESSION["uid"] != $team1data["leader"]) {
                        http_response_code(403);
                        echo json_encode(["status" => "not authorized"]);
                        exit();
                    }
                }
            }
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
	}
    error_log("Disa wahn");
	http_response_code(400);
	echo json_encode(["status" => "error"]);
?>
