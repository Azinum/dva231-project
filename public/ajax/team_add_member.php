<?php
    require_once("../dbfunctions/dbconnection.php");
    require_once("../dbfunctions/team_members.php");

    header("Content-type: application/json;");
    if (isset($_GET["team"]) && isset($_GET["user_id"])) {
        add_team_member($link, );
    }
?>
