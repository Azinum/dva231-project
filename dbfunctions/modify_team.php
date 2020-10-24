<?php

    function set_team_name($link, $team, $name) {
        if (strlen($name) >= 3) {
            $query = 'update Team set DisplayName="'. mysqli_real_escape_string($link, $name) .'" where TeamName="'. mysqli_real_escape_string($link, $team) .'";';
            if ($result = mysqli_query($link, $query)) {
                return true;
            }
        }
        return false;
    }

    function set_team_bio($link, $team, $bio) {
        $query = 'update Team set Bio="'. mysqli_real_escape_string($link, $bio) .'" where TeamName="'. mysqli_real_escape_string($link, $team) .'";';
        if ($result = mysqli_query($link, $query)) {
            return true;
        }
        return false;
    }

    function set_team_img($link, $team, $url) {
        $query = 'update Team set TeamImage="'. mysqli_real_escape_string($link, $url) .'" where TeamName="'. mysqli_real_escape_string($link, $team) .'";';
        if ($result = mysqli_query($link, $query)) {
            return true;
        }
        return false;
    }

?>
