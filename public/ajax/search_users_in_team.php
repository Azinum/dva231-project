<?php
	require_once("../../dbfunctions/dbconnection.php");
	require_once("../../dbfunctions/get_specteaminfo.php");
    require_once("../../dbfunctions/search.php");

    header("Content-type: application/json;");
	if (isset($_GET["q"]) && strlen($_GET["team"]) >= 1) {
        $teamdata = get_specteaminfo($link, $_GET["team"]);
        if ($teamdata["IsDisabled"]) {
            http_response_code(400);
            echo json_encode(["status" => "error"]);
            die();
        }
        echo json_encode(search_users_in_team($link, $_GET["team"], $_GET["q"]));
	}
	else {
        echo "[]";
    }
?>
