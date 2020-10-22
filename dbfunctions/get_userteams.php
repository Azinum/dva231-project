<?php
  //Get specified teams the speicifed user is a member of
  function get_userteams ($id) { 
    require_once("dbconnection.php");
    require_once("../layout/profileboxes.php");

    $Userquery = " SELECT TeamName FROM TeamMemberships join User on TeamMemberships.Member = User.UserName WHERE User.Id = '$id'";
    $Countquery = " SELECT Count(TeamName) as amount FROM TeamMemberships join User on TeamMemberships.Member = User.UserName WHERE User.Id = '$id'";

    if ($result = mysqli_query($link, $Userquery)){

         //Team 

        
        for ($i = 0; $i < (mysqli_query($link, $Countquery)['amount'] - 1); $i++) {
            $resArray[$i] = mysqli_fetch_assoc($result);
            echo $resArray[$i];
        }  

        return[ //Hur hanterar vi ELO i db?
           "name"=>$resArray['UserName'],
           "img_url"=>$resArray['ProfileImageUrl'],
           "bio"=> $resArray['Bio']
        ];
    }
}



?>