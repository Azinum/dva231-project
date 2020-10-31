<?php

    require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/team_members.php");
    require_once("../../dbfunctions/get_specteaminfo.php");

    header("Content-type: application/json;");
    if (isset($_GET["team"])) {
        $teamdata = get_specteaminfo($link, $_GET["team"]);
        if ($teamdata["IsDisabled"]) {
            http_response_code(400);
            echo json_encode(["status" => "error"]);
            die();
        }

        $status = get_team_members($link, $_GET["team"]);
        if (!empty($status)) {
            echo json_encode($status);
            die();
        }
    }
    echo "[]";

?>
