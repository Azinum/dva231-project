<?php
    //Hämta information om användaren.
    function get_teamsbyrank_limit ($link, $start, $end) { //Invärde för hur många som ska läsas in?

        $escStart = mysqli_real_escape_string($link, $start);
        $escEnd = mysqli_real_escape_string($link, $end);
        $Orderbyquery = "SELECT TeamName FROM Team ORDER BY TeamRanking ASC LIMIT $escStart, $escEnd;";
        

        $info["img_small"] = true;
                            $info["show_stats"] = true;
                            $info["show_score"] = false; //Ändra när ELO i DB är fixat
                            $info["stats_short"] = true;
                            $info["show_rank"] = true;
                            $info["img_small"] = [
                                    "leave" => false,
                                    "invite_controls" => false
                            ];
                            $info["buttons"] = [
                                "leave"=> false,
                                "invite_controls"=>false
                            ];

        if ($result = mysqli_query($link, $Orderbyquery)){

            $var = 0;
            while ($resArray = mysqli_fetch_assoc($result)) { //Ändra antalet som läses in?
                $name[$var] = $resArray["TeamName"];
                $var++;
            }
            return $name;

        }

            
    }
    


?>
