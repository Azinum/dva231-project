<?php session_start();


function register_user ($name) { 
    require_once("dbconnection.php");
    require_once("../layout/profileboxes.php");

    $Userquery = "SELECT * FROM User WHERE UserName = '$name'";
    $Partquery = "SELECT COUNT(Matches) as Amount FROM MatchParticipation WHERE User = '$name'";
    $Winsquery = 'select count(distinct Matches.Id) as NumMatches from User join TeamMemberships on Member = Id join MatchParticipation on MatchParticipation.User = User.Id join Matches on MatchParticipation.Matches = Matches.Id where User.Id = " '.$name.' " and ( (MatchParticipation.Team = Matches.Team1 and Matches.Result = "Team1Win") or (MatchParticipation.Team = Matches.Team2 and Matches.Result = "Team2Win"));';
    $Lossesquery = 'select count(distinct Matches.Id) as NumMatches from User join TeamMemberships on Member = Id join MatchParticipation on MatchParticipation.User = User.Id join Matches on MatchParticipation.Matches = Matches.Id where User.Id = " '.$name.' " and ( (MatchParticipation.Team = Matches.Team1 and Matches.Result = "Team2Win") or (MatchParticipation.Team = Matches.Team2 and Matches.Result = "Team1Win"));';
    $Partquery = 'select count(distinct Matches.Id) as NumMatches from User join TeamMemberships on Member = Id join MatchParticipation on MatchParticipation.User = User.Id join Matches on MatchParticipation.Matches = Matches.Id where User.Id = " '.$name.' ";';
    if ($result = mysqli_query($link, $Userquery)){

        $resArray = mysqli_fetch_assoc($result); //username/email/ProfileImageUrl/Bio/IsAdmin/IsBanned

        $t1 = mysqli_fetch_assoc(mysqli_query($link, $Winsquery))['Number'];
        $t2 = mysqli_fetch_assoc(mysqli_query($link, $Lossesquery))['Number']; 
        $t3 = mysqli_fetch_assoc(mysqli_query($link, $Partquery))['Amount'];

        echo "Wins :  $t1| Losses : $t2 | Part: $t3 ";

        return[ //Hur hanterar vi ELO i db?
           "name"=>$resArray['UserName'],
           "user_id"=>$resArray['Id'],
           "img_url"=>$resArray['ProfileImageUrl'],
           "bio"=> $resArray['Bio'],
           "is_admin" =>$resArray['IsAdmin'],
           "is_banned"=>$resArray['IsBanned'],
           "stats" => [
                "won"=>mysqli_fetch_assoc(mysqli_query($link, $Winsquery))['Number'],
                "lost"=>mysqli_fetch_assoc(mysqli_query($link, $Lossesquery))['Number'],
                "part"=>mysqli_fetch_assoc(mysqli_query($link, $Partquery))['Amount']
            ]
        ];
    }
}




?>