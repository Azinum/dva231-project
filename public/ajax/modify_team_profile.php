<?php

    require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/modify_team.php");

    header("Content-type: application/json;");
    if (isset($_GET["team"])) {
        $status = true;

        if (isset($_GET["name"])) {
            $status = set_team_name($link, $_GET["team"], $_GET["name"]);
        }

        if ($status && isset($_GET["bio"])) {
            $status = set_team_bio($link, $_GET["team"], $_GET["bio"]);
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
