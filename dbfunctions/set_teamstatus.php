<?php
  //Set disable till true eller false för användare
  function set_teamstatus ($link,$TeamName,$setDisable) { //true om IsDisabled ska sättas till true, id är en string

    $team = mysqli_real_escape_string ($link,$TeamName);
    $setDisablequery = mysqli_real_escape_string($link,"UPDATE Team SET IsDisabled = $setDisable WHERE Id = '$team'");
    $UserCheckquery = "SELECT TeamName FROM Team WHERE TeamName = '$team';";
    //echo $UserCheckquery;
    if (mysqli_num_rows (mysqli_query($link, $UserCheckquery)) > 0){
        mysqli_query($link, $setDisablequery);

    }
    else {
        echo "No team with specified name exists";
    }
}

?>