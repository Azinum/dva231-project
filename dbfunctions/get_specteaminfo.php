<?php
     //Get specified team's info
     function get_specteaminfo ($link, $name) {
        $escName = mysqli_real_escape_string($link, $name);

        $Teamquery = "SELECT * FROM Team WHERE TeamName = '". $escName ."'";

        $Winsquery = 'select COUNT(Result) as Number from Matches join Team on (Team1 = TeamName or Team2 = TeamName) and TeamName='.
            $escName .' where (Team1='.
            $escName .' AND Result="Team1Win" AND IsVerified = true) OR (Team2='.
            $escName .' AND Result="Team2Win" AND IsVerified = true);';

        $Lossesquery = 'select COUNT(Result) as Number from Matches join Team on (Team1 = TeamName or Team2 = TeamName) and TeamName='.
            $escName .' where (Team2='.
            $escName .' AND Result="Team1Win" AND IsVerified = true) OR (Team1='.
            $escName. ' AND Result="Team2Win" AND IsVerified = true);';

        $Matchesquery = 'select COUNT(Result) as Number from Matches join Team on (Team1 = TeamName or Team2 = TeamName) and TeamName='.
            $escName.' WHERE IsVerified = true;';

        if ($result = mysqli_query($link, $Teamquery)){

            $resArray = mysqli_fetch_assoc($result);
            if (empty($resArray['TeamName'])) {
                echo "No such team";
                exit();
            }

            return[ //Hur hanterar vi ELO i db?
               "name"=>$resArray['TeamName'],
               "img_url"=>$resArray['TeamImage'],
               "rank"=> $resArray['TeamRanking'],
               "bio"=> $resArray['Bio'],
               "leader" =>$resArray['TeamLeader'],
               "is_banned"=>$resArray['IsBanned'],
               "stats" => [
                    "won"=>mysqli_fetch_assoc(mysqli_query($link, $Winsquery))['Number'],
                    "lost"=>mysqli_fetch_assoc(mysqli_query($link, $Lossesquery))['Number'],
                    "part"=>mysqli_fetch_assoc(mysqli_query($link, $Matchesquery))['Number']
                ]
            ];
        }
    }


?>
