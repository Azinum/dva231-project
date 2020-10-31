<?php
    require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/team_members.php");

    header("Content-type: application/json;");
    if (isset($_GET["team"]) && isset($_GET["id"])) {
        session_start();
        if (!$_SESSION["isLoggedin"] || $_SESSION["uid"] != $_GET["id"]) {
            http_response_code(403);
            echo json_encode(["status" => "not authorized"]);
            die();
        }

        if (accept_invitation($link, $_GET["team"], $_GET["id"])) {
            echo json_encode(["status" => "success"]);
            die();
        }
    }

    http_response_code(400);
    echo json_encode(["status" => "error"]);
    die();
?>
