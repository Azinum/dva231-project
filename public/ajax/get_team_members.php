<?php

    require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/team_members.php");

    header("Content-type: application/json;");
    if (isset($_GET["team"])) {
        $status = get_team_members($link, $_GET["team"]);
        if (!empty($status)) {
            echo json_encode($status);
            die();
        }
    }
    echo "[]";

?>
