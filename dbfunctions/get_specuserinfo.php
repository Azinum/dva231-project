<?php
    //Hämta information om användaren. Hämta information om vilka lag användaren är med i
    function get_specuserinfo ($name) { 
        require_once("dbconnection.php");
        require_once("../layout/profileboxes.php");

        $Userquery = "SELECT * FROM User WHERE UserName = '$name'";
        $Partquery = "SELECT COUNT(Matches) as Amount FROM MatchParticipation WHERE User = '$name'";


        if ($result = mysqli_query($link, $Userquery)){

            $resArray = mysqli_fetch_assoc($result); //username/email/ProfileImageUrl/Bio/IsAdmin/IsBanned

            return[ //Hur hanterar vi ELO i db?
               "name"=>$resArray['UserName'],
               "user_id"=>$resArray['Id']
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