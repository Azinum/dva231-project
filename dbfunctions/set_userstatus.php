<?php
  //Set disable till true eller false för användare
  function set_userstatus ($link,$id,$setDisable) { //true om IsDisabled ska sättas till true, id är en string

    $setDisablequery = mysqli_real_escape_string($link,"UPDATE User SET IsDisabled = ". ($setDisable ? "TRUE" : "FALSE") ." WHERE Id = ". intval($id) .";");
    error_log($setDisablequery);
    if ($result = mysqli_query($link, $setDisablequery)){
        return true;
    }
    return false;
}

?>
