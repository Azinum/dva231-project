<?php

    //require_once("dbconnection.php");
    function add_team_member($link, $team_name, $user_id) {
        $query = 'insert into TeamMemberships values("' . mysqli_real_escape_string($link, $team_name) . '", "' . mysqli_real_escape_string($link, $user_id) . '");';
        if ($result = mysqli_query($link, $query)) {
            return true;
        }
        return false;
    }

    //require_once("dbconnection.php");
    function get_team_members($link, $team_name) {
        $query = 'select User.* from TeamMemberships join User on Member = User.Id where TeamName="'. mysqli_real_escape_string($link, $team_name) .'";';
        $return = [];
        if ($result = mysqli_query($link, $query)) {
            while ($res_array = mysqli_fetch_assoc($result)) {
                if ($res_array['Id'] !== NULL) {
                    array_push($return, [
                       "name" => $res_array['Username'],
                       "img_url" => $res_array['ProfileImageUrl'],
                       "bio"=> $res_array['Bio'],
                       "is_admin" => $res_array['IsAdmin'],
                       "is_banned" => $res_array['IsBanned'],
                       "user_id" => $res_array['Id']
                    ]);
                }
            }
        }
        return $return;
    }

    function kick_team_member($link, $team_name, $user_id) {
        $query =    'delete from TeamMemberships where TeamName="'. mysqli_real_escape_string($link, $team_name).
                    '" and Member="'. mysqli_real_escape_string($link, $user_id) .'";';

        if ($result = mysqli_query($link, $query)) {
            return true;
        }
        return false;
    }

?>
