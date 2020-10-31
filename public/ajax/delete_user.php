<?php
    require_once("../../dbfunctions/set_userstatus.php");
    require_once("../../dbfunctions/dbconnection.php");
    
    header("Content-type: application/json;");
    if (isset($_GET["id"])) {
        session_start();
        if (!$_SESSION["isLoggedin"] || $_SESSION["uid"] != $_GET["id"]) {
            http_response_code(403);
            echo json_encode(["status" => "not authorized"]);
            die();
        }

        // TODO: delete user data for gdpr-compliance ;)
        if (set_userstatus($link, $_GET["id"], "TRUE")) {
            if ($_SESSION["uid"] == $_GET["id"]) {
                $_SESSION["uid"] = null;
                $_SESSION["admin"] = false;
                $_SESSION["isLoggedin"] = false;
            }
            echo json_encode(["status" => "success"]);
            die();
        }
    }

    http_response_code(400);
    echo json_encode(["status" => "error"]);
    die();

?>
