<?php

    function get_verified_matches($link, $team) {
        $esc_name = mysqli_real_escape_string($link, $team);
        $query =    "Select * from Matches where IsVerified=1 and (Team1='". $esc_name ."' or Team2='". $esc_name ."');";

        $return = [];

        if ($result = mysqli_query($link, $query)){

            while ($res_array = mysqli_fetch_assoc($result)) {
                if ($res_array['Id'] !== NULL) {
                    array_push($return, [   // formatterad enligt matchbox i profileboxes
                        "team1" => $res_array["Team1"],
                        "team2" => $res_array["Team2"],
                        "id" => $res_array["Id"],
                        "result" => $res_array["Result"]
                    ]);
                }
            }

            return $return; 
        }
    }

?>
