<?php
    //Hämta matcher som inte har blivit verifierade av lag2 för ett visst lag
    function get_pendingmatches ($link, $name) { 
        $Userquery =    "SELECT * FROM Matches WHERE IsVerified IS NULL AND (Team1='".
                        mysqli_escape_string($link, $name). "' OR Team2='". 
                        mysqli_escape_string($link, $name). "')";
        $return = [];

        if ($result = mysqli_query($link, $Userquery)){

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
