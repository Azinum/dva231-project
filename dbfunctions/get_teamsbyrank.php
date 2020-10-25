<?php
    //Hämta information om användaren.
    function get_teamsbyrank ($link) { //Invärde för hur många som ska läsas in?

        $Orderbyquery = "SELECT TeamName FROM Team ORDER BY TeamRanking ASC;";
        
        // $biblequery = mysqli_real_escape_string($link,"select matchdata.Number as Matches, lossdata.Number as Losses, windata.Number as Wins from (
        //     select COUNT(Result) as Number from Matches join Team on (Team1 = TeamName or Team2 = TeamName) and TeamName='$name' WHERE IsVerified = true
        // ) as matchdata join (
        //     select COUNT(Result) as Number from Matches join Team on (Team1 = TeamName or Team2 = TeamName) and TeamName='$name' where
        //     (Team2='$name' AND Result=\"Team1Win\" AND IsVerified = true) OR (Team1='$name' AND Result=\"Team2Win\" AND IsVerified = true)
        // ) as lossdata join (
        //     select COUNT(Result) as Number from Matches join Team on (Team1 = TeamName or Team2 = TeamName) and TeamName='$name' where
        //     (Team1='TeamName' AND Result=\"Team1Win\" AND IsVerified = true) OR (Team2='TeamName' AND Result=\"Team2Win\" AND IsVerified = true)
        // ) as windata;\"");

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
