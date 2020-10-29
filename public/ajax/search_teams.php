<?php
	require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/search.php");

    header("Content-type: application/json;");
	if (isset($_GET["q"]) && isset($_GET["user_id"]) && $_GET["user_id"] >= 0) {
		echo json_encode(search_teamleader_teams($link, $_GET["user_id"], $_GET["q"]));
	}
	else if (isset($_GET["q"])) {
        echo json_encode(search_teams($link, $_GET["q"]));
	}
	else {
        echo "[]";
    }
?>
