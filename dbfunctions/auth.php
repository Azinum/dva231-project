<?php

function set_loggedin($id) {
    $_SESSION["uid"] = $id;
    $_SESSION["isLoggedin"] = true;
}

function set_loggedout() {
    $_SESSION["uid"] = null;
    $_SESSION["isLoggedin"] = false;
}

function check_loginstatus() { //Skickar tillbaka användaren till login om isLoggedin antingen är null eller false
    if (!isset($_SESSION["isLoggedin"]) || $_SESSION["isLoggedin"] == false) {
        header('location:login.php');
        die();
    }
    else {
        echo "hell yeah";
    }
}


































?>