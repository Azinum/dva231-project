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

    //Hämta information om användaren. Hämta information om vilka lag användaren är med i
    function get_specuserinfo ($name) { 
        require_once("../layout/dbconnection.php");

        $Userquery = "SELECT * FROM User WHERE UserName = '$name'";
        $Partquery = "SELECT COUNT(Matches) as Amount FROM MatchParticipation WHERE User = '$name'";


        if ($result = mysqli_query($link, $Userquery)){

            $resArray = mysqli_fetch_assoc($result); //username/email/ProfileImageUrl/Bio/IsAdmin/IsBanned

            return[ //Hur hanterar vi ELO i db?
               "name"=>$resArray['UserName'],
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

    //Get specified teams the speicifed user is a member of
    function get_userteams ($id) { 
        require_once("../layout/dbconnection.php");

        $Userquery = " SELECT TeamName FROM TeamMemberships join User on TeamMemberships.Member = User.UserName WHERE User.Id = '$id'";
        $Countquery = " SELECT Count(TeamName) as amount FROM TeamMemberships join User on TeamMemberships.Member = User.UserName WHERE User.Id = '$id'";

        if ($result = mysqli_query($link, $Userquery)){

             //Team 

            
            for ($i = 0, $i < (mysqli_query($link, $Countquery)['amount'] - 1) ,$i++) {
                $resArray[$i] = mysqli_fetch_assoc($result);
            }  

            return[ //Hur hanterar vi ELO i db?
               "name"=>$resArray['UserName'],
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


//TODO: Get/Set Team-members, Change Username, Change teamname, SetBanned, SetAdmin? Register user, register team

?>