<?php
	require_once("../../dbfunctions/dbconnection.php");
    require_once("../../layout/leaderboard.php.php");

    header("Content-type: application/json;");
    if (isset($_GET["s"]) && isset($_GET["e"])) {
        echo json_encode(get_teamsbyrank_limit($link, $_GET["s"], $_GET["e"]));
	}
	else {
        echo "[]";
    }
?>
