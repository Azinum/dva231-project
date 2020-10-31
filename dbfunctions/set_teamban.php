<?php
  //Banna lag
  function set_teamban ($link, $name) { 
    $setbannedquery = "UPDATE Team SET IsBanned = TRUE, IsDisabled = TRUE WHERE TeamName = '". mysqli_real_escape_string($link, $name) ."'";

    if ($result = mysqli_query($link, $setbannedquery)){
        return true;
    }
    return false;
}

?>
