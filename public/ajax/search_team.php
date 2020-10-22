<?php
	require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/search.php");

    header("Content-type: application/json;");
    if (isset($_GET["q"]) && strlen($_GET["q"]) >= 1) {
        echo json_encode(search_teams($link, $_GET["q"]));
	}
	else {
        echo "[]";
    }
?>
