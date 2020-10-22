<?php
    //Hämta information om användaren.
    function get_specuserinfo ($name) { 
        include("dbconnection.php"); //Går sönder om den sitter utanför, varför???
        require_once("../layout/profileboxes.php");

        $Userquery = "SELECT * FROM User WHERE id = '$name'";
        $Winsquery = 'select count(distinct Matches.Id) as NumMatches from User join TeamMemberships on Member = Id join MatchParticipation on MatchParticipation.User = User.Id join Matches on MatchParticipation.Matches = Matches.Id where User.Id = " '.$name.' " and ( (MatchParticipation.Team = Matches.Team1 and Matches.Result = "Team1Win") or (MatchParticipation.Team = Matches.Team2 and Matches.Result = "Team2Win"));';
        $Lossesquery = 'select count(distinct Matches.Id) as NumMatches from User join TeamMemberships on Member = Id join MatchParticipation on MatchParticipation.User = User.Id join Matches on MatchParticipation.Matches = Matches.Id where User.Id = " '.$name.' " and ( (MatchParticipation.Team = Matches.Team1 and Matches.Result = "Team2Win") or (MatchParticipation.Team = Matches.Team2 and Matches.Result = "Team1Win"));';
        $Partquery = 'select count(distinct Matches.Id) as NumMatches from User join TeamMemberships on Member = Id join MatchParticipation on MatchParticipation.User = User.Id join Matches on MatchParticipation.Matches = Matches.Id where User.Id = " '.$name.' ";';

        if ($result = mysqli_query($link, $Userquery)){

            $resArray = mysqli_fetch_assoc($result); //username/email/id/ProfileImageUrl/Bio/IsAdmin/IsBanned

            return[ //Hur hanterar vi ELO i db?
               "name"=>$resArray['Username'],
               "user_id"=>$resArray['Id'],
               "img_url"=>$resArray['ProfileImageUrl'],
               "bio"=> $resArray['Bio'],
               "is_admin" =>$resArray['IsAdmin'],
               "is_banned"=>$resArray['IsBanned'],
               "stats" => [
                    "won"=>mysqli_fetch_assoc(mysqli_query($link, $Winsquery))['NumMatches'],
                    "lost"=>mysqli_fetch_assoc(mysqli_query($link, $Lossesquery))['NumMatches'],
                    "part"=>mysqli_fetch_assoc(mysqli_query($link, $Partquery))['NumMatches']
                    ]
            ];
        }
    }


?>