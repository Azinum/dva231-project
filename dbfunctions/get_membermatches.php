<?php
    //Get matches for specified team, returns array of match id's and participating player id
	function get_membermatches ($link,$team) {
        $escTeam = mysqli_real_escape_string($link, $team);

        $matchquery = "SELECT User, Matches FROM MatchParticipation WHERE Team = '$escTeam'";

        if ($result = mysqli_query($link, $matchquery)){
            $retArray = [];
            $var = 0;
               while($resArray = mysqli_fetch_assoc($result)) { 
                $retArray[$var]["user"] = $resArray["User"];
                $retArray[$var]["match"] = $resArray["Matches"];
                $var++;
               }
            return $retArray;
        }
    }

?>
