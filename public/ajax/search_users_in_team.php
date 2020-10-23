<?php
	require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/search.php");

    header("Content-type: application/json;");
	if (isset($_GET["q"]) && $_GET["team"] >= 1) {
        echo json_encode(search_users_in_team($link, $_GET["team"], $_GET["q"]));
	}
	else {
        echo "[]";
    }
?>
