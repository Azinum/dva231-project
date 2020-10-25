<?php
        global $link;
        $link= new mysqli("138.197.179.196:3306","scoreboard_account", "gimme them scorez yoo", "scoreboard_db");

        if (mysqli_connect_errno()) {
            error_log("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
?>
