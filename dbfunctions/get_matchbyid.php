<?php
  //Hämta matcher efter id
  function get_pendingmatches ($id) { 
    include("dbconnection.php"); //Går sönder om den sitter utanför, varför???
    require_once("../layout/profileboxes.php");

    $Userquery = "SELECT Team1,Team2,Result,IsVerified,Team2ShouldVerify FROM Matches WHERE Id = '.$id.' ";

    if ($result = mysqli_query($link, $Userquery)){

        $resArray = mysqli_fetch_assoc($result); 

        return [
            "team1"=>$resArray['Team1'],
            "team2"=>$resArray['Team2'],
            "result"=> $resArray['Result'],
            "is_verified"=> $resArray['IsVerified'],
            "team2shouldverify"=> $resArray['Team2ShouldVerify']
         ];
    }
}




?>