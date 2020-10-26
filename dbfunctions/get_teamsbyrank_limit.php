<?php
    require_once("get_specteaminfo.php"); //Ta bort denna efter testing

    //Hämta information om användaren.
    function get_teamsbyrank_limit ($link, $start, $end) { //Invärde för hur många som ska läsas in?


        $escStart = mysqli_real_escape_string($link, $start);
        $escEnd = mysqli_real_escape_string($link, $end);
        $Orderbyquery = "SELECT TeamName FROM Team ORDER BY TeamRanking ASC LIMIT $escStart, $escEnd;";
        


        if ($result = mysqli_query($link, $Orderbyquery)){

            $var = 0;
            while ($resArray = mysqli_fetch_assoc($result)) { //Ändra antalet som läses in?
                $name = $resArray["TeamName"];
                error_log(gettype($resArray["TeamName"]));
                $teaminfo[$var] = get_specteaminfo($link,'TeamName');
               
                $var++;
            }
            return $teaminfo;

        }

            
    }
    


?>
