<?php
  //Banna användare
  function set_userban ($link,$id) { 

    $Userquery = mysqli_real_escape_string($link,"UPDATE User SET IsBanned = TRUE, isDisabled = TRUE WHERE Id = '$id'");
    $UserCheckquery = mysqli_real_escape_string($link,"SELECT COUNT(Email) as Amount FROM User WHERE Id = '$id'");

    if ( mysqli_num_rows (mysqli_query($link, $UserCheckquery)) > 0){
        if ($result = mysqli_query($link, $Userquery)){
            return true;
        }
    }
    else { 
        return false;
    }
}

?>