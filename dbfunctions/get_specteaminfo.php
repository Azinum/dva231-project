<?php
    //Get specified team's info
	function get_specteaminfo ($link, $name) {
		$ename = mysqli_real_escape_string($link, $name);
        $query = ''.
			'SELECT Matches.NumMatches, Wins.NumWins, Losses.NumLosses, Team.* FROM Team join ('.
			'select COUNT(Result) as NumLosses from Matches join Team on (Team1 = TeamName or Team2 = TeamName) where '.
			'TeamName = "'.$ename.'" AND ((Team2=TeamName AND Result="Team1Win" AND IsVerified = true) OR (Team1=TeamName AND Result="Team2Win" AND IsVerified = true))'.
			') as Losses join ('.
			'select COUNT(Result) as NumWins from Matches join Team on (Team1 = TeamName or Team2 = TeamName) where '.
			'TeamName = "'.$ename.'" AND ((Team1=TeamName AND Result="Team1Win" AND IsVerified = true) OR (Team2=TeamName AND Result="Team2Win" AND IsVerified = true))'.
			') as Wins join ('.
			'select COUNT(Result) as NumMatches from Matches join Team on (Team1 = TeamName or Team2 = TeamName) and TeamName="'.$ename.'" WHERE IsVerified = true'.
			') as Matches WHERE TeamName = "'.$ename.'" AND IsDisabled IS NOT TRUE';

        if ($result = mysqli_query($link, $query)){
            $resArray = mysqli_fetch_assoc($result);

            if (empty($resArray['TeamName'])) {
                return false;
            }

            return[ //Hur hanterar vi ELO i db?
               "name"=>$resArray['TeamName'],
               "disp_name"=>$resArray['DisplayName'],
               "img_url"=>$resArray['TeamImage'],
               "rank"=>$resArray['TeamRanking'],
               "bio"=>$resArray['Bio'],
               "leader"=>$resArray['TeamLeader'],
               "is_banned"=>$resArray['IsBanned'],
               "stats" => [
                    "won"=>$resArray["NumWins"],
                    "lost"=>$resArray["NumLosses"],
                    "part"=>$resArray["NumMatches"]
                ]
            ];
		}
    }

    function get_teamname($link, $dispName) {
        $query = "select TeamName from Team where DisplayName='". mysqli_real_escape_string($link, $dispName) ."';";
        if ($result = mysqli_query($link, $query)) {
            $resArray = mysqli_fetch_assoc($result);
            if (empty($resArray['TeamName'])) {
                return false;
            } else {
                return $resArray['TeamName'];
            }
        }
    }


?>
