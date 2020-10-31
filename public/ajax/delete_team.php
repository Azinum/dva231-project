<?php
    require_once("../../dbfunctions/get_specteaminfo.php");
    require_once("../../dbfunctions/set_teamstatus.php");
    require_once("../../dbfunctions/dbconnection.php");
    
    header("Content-type: application/json;");
    if (isset($_GET["team"])) {
        session_start();
        $teamdata = get_specteaminfo($link, $_GET["team"]);
        if (!$_SESSION["isLoggedin"] || (!$_SESSION["admin"] && $_SESSION["uid"] != $teamdata["leader"])) {
            http_response_code(403);
            echo json_encode(["status" => "not authorized"]);
            die();
        }

        if (set_teamstatus($link, $_GET["team"], "TRUE")) {
            echo json_encode(["status" => "success"]);
            die();
        }
    }

    http_response_code(400);
    echo json_encode(["status" => "error"]);
    die();

?>
