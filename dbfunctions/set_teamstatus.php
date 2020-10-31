<?php
  //Set disable till true eller false för användare
  function set_teamstatus ($link,$TeamName,$setDisable) { //true om IsDisabled ska sättas till true, id är en string

    $team = mysqli_real_escape_string ($link,$TeamName);
    $setDisablequery = "UPDATE Team SET IsDisabled = ". ($setDisable ? "TRUE" : "FALSE") ." WHERE TeamName = '". $team ."';";
    error_log($setDisablequery);
    if ($result = mysqli_query($link, $setDisablequery)){
        return true;
    }
    return false;
}

?>
