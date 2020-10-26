<?php
	require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/get_teamsbyrank_limit.php");

    header("Content-type: application/json;");
    if (isset($_GET["s"])) {
        echo json_encode(get_teamsbyrank_limit($link, $_GET["s"]));
	}
	else {
        echo "[]";
    }
?>
