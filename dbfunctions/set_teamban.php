<?php
  //Banna lag
  function set_teamban ($name) { 
    include("dbconnection.php"); //Går sönder om den sitter utanför, varför???
    require_once("../layout/profileboxes.php");

    $setbannedquery = "UPDATE Team SET IsBanned = TRUE WHERE TeamName = '$name'";
    $namecheckquery = "SELECT COUNT(TeamName) as Amount FROM Team WHERE TeamName = '$name'";

    if ( mysqli_num_rows (mysqli_query($link, $namecheckquery)) > 0){
        if ($result = mysqli_query($link, $setbannedquery)){
            echo "Team banned";
        }
    }
    else { //Varför går inte in här?
        echo "No team with specified name exists";
    }
}

?>