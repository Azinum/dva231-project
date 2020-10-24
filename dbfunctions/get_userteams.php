<?php

  //Get teams the speicifed user is a member of
  function get_userteams ($id) {  //Passera link funktionen in?
    include("dbconnection.php");

    $Userquery = "SELECT TeamName FROM TeamMemberships join User on TeamMemberships.Member = User.Id WHERE User.Id = '$id'";
    $Countquery = "SELECT COUNT(TeamName) as amount FROM TeamMemberships join User on TeamMemberships.Member = User.Id WHERE User.ID = '$id'";

    if ($result = mysqli_query($link, $Userquery)){

        if ($counter = (int)(mysqli_fetch_array(mysqli_query($link, $Countquery))[0])) { //
            for ($i = 0; $i <= $counter-1; $i++) {
                $resArray = mysqli_fetch_array($result); //Måste finnas ett snyggare sätt att lösa detta
                $teamsArray[$i] = $resArray[0];
            }  
        }

        return $teamsArray; //Array som innehåller alla teams spelaren är med i
        
    }
}



?>