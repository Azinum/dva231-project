<?php
    require_once("get_specteaminfo.php"); //Ta bort denna efter testing

    //Hämta information om användaren.
    function get_teamsbyrank_limit ($link, $start) { //Invärde för hur många som ska läsas in?


        $escStart = mysqli_real_escape_string($link, $start);
        $escEnd = mysqli_real_escape_string($link, $end);
        $Orderbyquery = "SELECT TeamName FROM Team ORDER BY TeamRanking, TeamName LIMIT $escStart, 5;";
        error_log($Orderbyquery);
        


        if ($result = mysqli_query($link, $Orderbyquery)){

            $var = 0;
            while ($resArray = mysqli_fetch_assoc($result)) { //Ändra antalet som läses in?
                $name = $resArray["TeamName"];
               
                $teaminfo[$var] = get_specteaminfo($link,$name);
               
                $var++;
            }
            return $teaminfo;

        }

            
    }
    


?>
