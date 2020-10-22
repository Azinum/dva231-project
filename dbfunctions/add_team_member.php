<?php

    function add_team_member($team_name, $user_id) {
        require_once("dbconnection.php");
        $query = 'insert into TeamMemberships values("' . mysqli_real_escape_string($link, $team_name) . '", "' . mysqli_real_escape_string($link, $user_id) . '");';
        if ($result = mysqli_query($link, $query)) {
            return true;
        }
        return false;
    }

?>
