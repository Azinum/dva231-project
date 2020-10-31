<?php
    require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/get_specteaminfo.php");
    require_once("../../dbfunctions/get_specuserinfo.php");
    require_once("../../dbfunctions/team_members.php");

    header("Content-type: application/json;");
    if (isset($_GET["team"]) && isset($_GET["user_id"])) {

        session_start();
        $teamdata = get_specteaminfo($link, $_GET["team"]);
        if ($teamdata["IsDisabled"]) {
            http_response_code(400);
            echo json_encode(["status" => "error"]);
            die();
        }

        if (!$_SESSION["isLoggedin"] || (!$_SESSION["admin"] && $_SESSION["uid"] != $teamdata["leader"])) {
            http_response_code(403);
            echo json_encode(["status" => "not authorized"]);
            die();
        }

        $userdata = get_specuserinfo($link, $_GET["user_id"]);
        if ($userdata["is_disabled"]) {
            http_response_code(400);
            echo json_encode(["status" => "error"]);
            die();
        }

        $status = add_team_member($link, $_GET["team"], $_GET["user_id"]);
        if ($status) {
            echo json_encode(["status" => "success"]);
            die();
        }
    }
    http_response_code(400);
    echo json_encode(["status" => "error"]);    // Change for something more descriptive maybe...?
?>
