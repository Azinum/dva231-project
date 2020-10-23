<?php
  //Banna användare
  function set_userban ($id) { 
    include("dbconnection.php"); //Går sönder om den sitter utanför, varför???
    require_once("../layout/profileboxes.php");

    $Userquery = "UPDATE User SET IsBanned = TRUE WHERE Id = '$id'";
    $UserCheckquery = "SELECT COUNT(Email) as Amount FROM User WHERE Id = '$id'";

    if ( mysqli_num_rows (mysqli_query($link, $UserCheckquery)) > 0){
        if ($result = mysqli_query($link, $Userquery)){
            echo "User banned";
        }
    }
    else { //Varför går inte in här?
        echo "No user with specified ID exists";
    }
}

?>