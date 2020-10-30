<?php
    require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/modify_user.php");

    header("Content-type: application/json;");
    if (isset($_GET["id"]) && isset($_GET["email"])) {
        session_start();
        if (!$_SESSION["isLoggedin"] || $_SESSION["uid"] != $_GET["id"]) {
            http_response_code(403);
            echo json_encode(["status" => "not authorized"]);
            die();
        }

        if (set_user_email($link, $_GET["id"], $_GET["email"])) {
            echo json_encode(["status" => "success"]);
            die();
        }
    }

    http_response_code(400);
    echo json_encode(["status" => "error"]);
    die();
?>
