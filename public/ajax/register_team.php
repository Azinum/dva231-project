<?php
    require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/register_team.php");
    require_once("../../dbfunctions/team_members.php");

    header("Content-type: application/json;");

    if (isset($_GET["name"]) && isset($_GET["bio"])) {
        session_start();
        if (!$_SESSION["isLoggedin"]) {
            http_response_code(403);
            echo json_encode(["status" => "not authorized"]);
            die();
        }

        $result = register_team(
            $link, $_GET["name"], $_GET["bio"], $_SESSION["uid"],
            isset($_GET["img"]) ? $_GET["img"] : ""
        );
        
        switch($result) {
            case register_team_errcodes::success:
                if (add_team_member($link, $_GET["name"], $_SESSION["uid"])) {
                    echo json_encode(["status" => "success"]);
                    die();
                }
                http_response_code(500);    // aw shiet, this should *NEVER* happen, but if it does we have an empty team laying around... TODO: deal with it, not prio
                echo json_encode(["status" => "error"]);
                die();
            case register_team_errcodes::name_taken:
                http_response_code(400);
                echo json_encode(["status" => "name in use"]);
                die();
            case register_team_errcodes::name_short:
                http_response_code(400);
                echo json_encode(["status" => "name too short"]);
                die();
            default:
                http_response_code(400);
                echo json_encode(["status" => "error"]);
                die();
        }
    }

    http_response_code(400);
    echo json_encode(["status" => "error"]);
    die();
?>
