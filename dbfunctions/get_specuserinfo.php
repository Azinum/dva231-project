<?php
    //Hämta information om användaren.
    function get_specuserinfo ($link, $name) { 

        $ename = mysqli_escape_string($link, $name);
        $Userquery = "SELECT * FROM User WHERE id = '".$ename."'";
        // There are no checks to see if the user is actually a confirmed member of the team, or just invited below.
        // Shouldn't matter though, since they also need to actually have partaken in a match
        $Winsquery = 'select count(distinct Matches.Id) as NumMatches from User join TeamMemberships on Member = Id join MatchParticipation on MatchParticipation.User = User.Id join Matches on MatchParticipation.Matches = Matches.Id where User.Id = " '.$ename.' " and ( (MatchParticipation.Team = Matches.Team1 and Matches.Result = "Team1Win") or (MatchParticipation.Team = Matches.Team2 and Matches.Result = "Team2Win"));';
        $Lossesquery = 'select count(distinct Matches.Id) as NumMatches from User join TeamMemberships on Member = Id join MatchParticipation on MatchParticipation.User = User.Id join Matches on MatchParticipation.Matches = Matches.Id where User.Id = " '.$ename.' " and ( (MatchParticipation.Team = Matches.Team1 and Matches.Result = "Team2Win") or (MatchParticipation.Team = Matches.Team2 and Matches.Result = "Team1Win"));';
        $Partquery = 'select count(distinct Matches.Id) as NumMatches from User join TeamMemberships on Member = Id join MatchParticipation on MatchParticipation.User = User.Id join Matches on MatchParticipation.Matches = Matches.Id where User.Id = " '.$ename.' ";';

        if ($result = mysqli_query($link, $Userquery)){

            $resArray = mysqli_fetch_assoc($result); //username/email/id/ProfileImageUrl/Bio/IsAdmin/IsBanned

            if ($resArray["IsDisabled"]) {
                return [
                    "name" => "[Deleted User]",
                    "user_id" => $resArray["Id"],
                    "email" => $resArray["Email"],
                    "img_url" => "/img/default_profile_image.svg",
                    "bio" => "",
                    "is_admin" => $resArray["IsAdmin"],
                    "is_banned" => $resArray["IsBanned"],
                    "is_disabled" => true,
                    "stats" => [
                            "won" => 0,
                            "lost" => 0,
                            "part" => 0
                        ]
                ];
            } else {
                return [ //Hur hanterar vi ELO i db?
                   "name"=>$resArray['Username'],
                   "user_id"=>$resArray['Id'],
                   "email" => $resArray["Email"],
                   "img_url"=>$resArray['ProfileImageUrl'],
                   "bio"=> $resArray['Bio'],
                   "is_admin" =>$resArray['IsAdmin'],
                   "is_banned"=>$resArray['IsBanned'],
                   "is_disabled" => false,
                   "stats" => [
                        "won"=>mysqli_fetch_assoc(mysqli_query($link, $Winsquery))['NumMatches'],
                        "lost"=>mysqli_fetch_assoc(mysqli_query($link, $Lossesquery))['NumMatches'],
                        "part"=>mysqli_fetch_assoc(mysqli_query($link, $Partquery))['NumMatches']
                        ]
                ];
            }
        }
    }


?>
