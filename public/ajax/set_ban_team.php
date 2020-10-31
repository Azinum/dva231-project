<?php
    require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/get_specteaminfo.php");
    require_once("../../dbfunctions/set_teamban.php");

    header("Content-type: application/json;");
    if (isset($_GET["team"]) && isset($_GET["user_id"])) {

        session_start();
        $teamdata = get_specteaminfo($link, $_GET["team"]);
        if (!$_SESSION["isLoggedin"] || (!$_SESSION["admin"] )) {
            http_response_code(403);
            echo json_encode(["status" => "not authorized"]);
            die();
        }

        $status = set_teamban($teamdata['TeamName']);
        if ($status) {
            echo json_encode(["status" => "success"]);
            die();
        }
    }
    http_response_code(400);
    echo json_encode(["status" => "error"]);    // Change for something more descriptive maybe...?

?>
