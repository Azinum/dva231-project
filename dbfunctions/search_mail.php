<?php
  //Kolla om en användares email finns i databasen
  function search_mail ($link, $mail) { 
    $UserCheckquery = "SELECT Email FROM User WHERE Email = '$mail'";
    if ( mysqli_num_rows (mysqli_query($link, $UserCheckquery)) > 0){
        return true;
    }
    else {
        return false;
    }
}

?>