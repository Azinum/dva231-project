<?php
    require_once("../dbfunctions/search_mail.php");

function set_loggedin($link) {
    $mail = mysqli_real_escape_string($link ,$_POST["email"]);
    $pass = mysqli_real_escape_string($link ,$_POST["password"]);
    if (empty($pass) || empty($mail)) {
        echo"Fields cannot be empty!";
        die();
    } 
    $query = "SELECT PasswordHash, Id, IsAdmin FROM User WHERE Email = '$mail'";
    if($result = mysqli_query($link, $query)) {
        $resArray = mysqli_fetch_assoc($result);
        if (search_mail($link,$mail)) {
            if (password_verify($pass, $resArray['PasswordHash'])){
                $_SESSION["uid"] = $resArray['Id'];
                $_SESSION["admin"] = $resArray['IsAdmin'];
                $_SESSION["isLoggedin"] = true;
                header('location:home.php');
            }
            else {
                echo "Incorrect password!";
            }
        }
        else {
            echo "EMAIL Address does not exist in database.";
        }
    }
}

function set_loggedout() {
    $_SESSION["uid"] = null;
    $_SESSION["admin"] = false;
    $_SESSION["isLoggedin"] = false;
}

function check_loginstatus() { //Skickar tillbaka användaren till login om isLoggedin antingen är null eller false
    if (!isset($_SESSION["isLoggedin"]) || $_SESSION["isLoggedin"] == false) {
        header('location:login.php');
        die();
    }
    else {
        echo "hell yeah";
        $test = $_SESSION["admin"];
        echo "IsAdmin: $test";
    }
}


































?>