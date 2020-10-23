<?php
    //Get matches specified user has participated in as a specified team, returns array of match id's
	function get_matchuteam ($link, $id, $team) {
        $escName = mysqli_real_escape_string($link, $id);
        $escTeam = mysqli_real_escape_string($link, $team);

        $matchquery = "SELECT Matches FROM MatchParticipation WHERE User = '$escName' AND Team = '$escTeam';";

        if ($result = mysqli_query($link, $matchquery)){
            $retArray = [];
            $var = 0;
               while($resArray = mysqli_fetch_array($result, MYSQLI_NUM)) { 
                $retArray[$var] = $resArray[0][0];
                $var++;
               }
            return $retArray;
        }
    }

?>
