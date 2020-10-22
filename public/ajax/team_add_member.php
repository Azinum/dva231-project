<?php
    require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/team_members.php");

    header("Content-type: application/json;");
    if (isset($_GET["team"]) && isset($_GET["user_id"])) {
        $status = add_team_member($link, $_GET["team"], $_GET["user_id"]);
        if ($status) {
            echo json_encode(["status" => "success"]);
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error"]);    // Change for something more descriptive maybe...?
        }
    }
?>
