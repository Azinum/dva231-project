<?php
  //Set disable till true eller false för användare
  function set_userstatus ($link,$id,$setDisable) { //true om IsDisabled ska sättas till true, id är en string

    $setDisablequery = mysqli_real_escape_string($link,"UPDATE User SET IsDisabled = $setDisable WHERE Id = $id");
    $UserCheckquery = mysqli_real_escape_string($link,"SELECT Email FROM User WHERE Id = $id");
    echo $UserCheckquery;
    if (mysqli_num_rows (mysqli_query($link, $UserCheckquery)) > 0){
        mysqli_query($link, $setDisablequery);

    }
    else {
        echo "No user with specified ID exists";
    }
}

?>