<?php
require_once("../dbfunctions/auth.php");
function build_dropdown() {
    if ($_SESSION["isLoggedin"] == true) {
        echo '<span>';
		echo '<a href="login.php?logout=true"> Log out </a>';
		echo '</span>';
    }
    else {
        echo '<span>';
		echo '<a href="signup.php">Sign up</a>';
		echo '</span>';
    }
}



?>