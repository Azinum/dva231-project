<?php
    //Escapes "
    function equot($string) {
        return str_replace('"','\\"',$string);
    }

    //Escapes '
    function esquot($string) {
        return str_replace("'","\\'",$string);
    }
?>
