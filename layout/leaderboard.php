<?php
    //Hämta information om användaren.
    function build_leaderboard ($link) { //Invärde för hur många som ska läsas in?
       // include("dbconnection.php"); //Går sönder om den sitter utanför, varför???

        $Orderbyquery = "SELECT TeamName FROM Team ORDER BY TeamRanking ASC;";

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
                $var++;
                    echo '<div  class="flex-row">';
                    profile_box_team (get_specteaminfo($link, $name[$var]),$info);
                    echo '</div>';
            }
            

        }

            
    }
    


?>
