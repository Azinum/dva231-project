<?php
    //Get specified team's info
	function get_usermatches ($link, $id) {
        $escName = mysqli_real_escape_string($link, $id);

        $matchquery = "SELECT Matches FROM MatchParticipation WHERE User = '$escName' ";

        if ($result = mysqli_query($link, $matchquery)){
            $resArray = mysqli_fetch_all($result, MYSQLI_NUM);
            echo $resArray[0][0];
            echo $resArray[1][0];
            echo $resArray[2][0];
               //while($resArray = mysqli_fetch_array($result)) { //Vad ska returneras? En array med alla användarens matcher

              // }
            

        }

    }


?>
