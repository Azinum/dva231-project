<?php
    //Hämta matcher som inte har blivit verifierade av lag2 för ett visst lag
    function get_pendingmatches ($link, $name) { 
        $Userquery = "SELECT Id FROM Matches WHERE Team2ShouldVerify IS NULL AND (Team1='$name' ) OR (Team2='$name')";
        $return = [];

        if ($result = mysqli_query($link, $Userquery)){

            while ($res_array = mysqli_fetch_assoc($result)) {
                if ($res_array['Id'] !== NULL) {
                    array_push($return, [   // formatterad enligt matchbox i profileboxes
                        "team1" => $resArray["Team1"],
                        "team2" => $resArray["Team1"],
                        "id" => $resArray["Id"],
                        "result" => $resArray["Result"]
                    ]);
                }
            }

            return $return; 
        }
    }


?>
