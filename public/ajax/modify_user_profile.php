<?php
    require_once("../../dbfunctions/get_specuserinfo.php");
    require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/modify_user.php");

    header("Content-type: application/json;");
    if (isset($_GET["id"])) {

        session_start();
        if (!$_SESSION["isLoggedin"] || (!$_SESSION["admin"] && $_SESSION["uid"] != $_GET["id"])) {
            http_response_code(403);
            echo json_encode(["status" => "not authorized"]);
            die();
        }

        $status = true;

        if (isset($_GET["name"])) {
            $status = set_username($link, $_GET["id"], $_GET["name"]);
        }

        if ($status && isset($_GET["bio"])) {
            $status = set_user_bio($link, $_GET["id"], $_GET["bio"]);
        }

        if ($status) {
            echo json_encode(["status" => "success"]);
            die();
        } else if (mysqli_errno($link) == 1062) {
            http_response_code(400);
            echo json_encode(["status" => "name in use"]);
            die();
        }
    }

    http_response_code(400);
    echo json_encode(["status" => "error"]);    // Change for something more descriptive maybe...?
?>
