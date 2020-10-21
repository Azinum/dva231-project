<?php
    require_once("../layout/profileboxes.php");

    //Get specified team's info
    function get_specteaminfo ($name) {
        require_once("../layout/dbconnection.php");

        $Teamquery = "SELECT * FROM Team WHERE TeamName = '$name'";
        $Winsquery = 'select COUNT(Result) as Number from Matches join Team on (Team1 = TeamName or Team2 = TeamName) and TeamName='.$name.' where (Team1='.$name.' AND Result="Team1Win") OR (Team2='.$name.' AND Result="Team2Win");';
        $Lossesquery = 'select COUNT(Result) as Number from Matches join Team on (Team1 = TeamName or Team2 = TeamName) and TeamName='.$name.' where (Team2='.$name.' AND Result="Team1Win") OR (Team1='.$name.' AND Result="Team2Win");';
        $Matchesquery = 'select COUNT(Result) as Number from Matches join Team on (Team1 = TeamName or Team2 = TeamName) and TeamName='.$name.';';
        if ($result = mysqli_query($link, $Teamquery)){

            $resArray = mysqli_fetch_assoc($result);

            return[
               "name"=>$resArray['TeamName'],
               "img_url"=>$resArray['TeamImage'],
               "rank"=> $resArray['TeamRanking'],
               "bio"=> $resArray['Bio'],
               "leader" =>$resArray['TeamLeader'],
               "is_banned"=>$resArray['isBanned'],
               "stats" => [
                    "won"=>mysqli_fetch_assoc(mysqli_query($link, $Winsquery))['Number'],
                    "lost"=>mysqli_fetch_assoc(mysqli_query($link, $Lossesquery))['Number'],
                    "part"=>mysqli_fetch_assoc(mysqli_query($link, $Matchesquery))['Number']
                ]
            ];
        }
    }

?>