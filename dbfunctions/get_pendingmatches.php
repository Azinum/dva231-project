<?php
    //Hämta matcher som inte har blivit verifierade av lag2 för ett visst lag
    function get_pendingmatches ($name) { 
        include("dbconnection.php"); //Går sönder om den sitter utanför, varför???
        require_once("../layout/profileboxes.php");

        $Userquery = "SELECT Id FROM Matches WHERE Team2ShouldVerify IS NULL AND (Team1='$name' ) OR (Team2='$name')";

        if ($result = mysqli_query($link, $Userquery)){

            $resArray = mysqli_fetch_assoc($result); 

            return $resArray; //Returnerar en array med alla matchid för matcher som inte har verifierats för det specifierade laget
        }
    }


?>