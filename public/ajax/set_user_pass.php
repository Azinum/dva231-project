<?php
    require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/modify_user.php");

    header("Content-type: application/json;");
    // yikes, prob. want tls for this...
    if (isset($_GET["id"]) && isset($_GET["newpwd"]) && isset($_GET["pwd"])) {
        session_start();
        if (!$_SESSION["isLoggedin"] || $_SESSION["uid"] != $_GET["id"]) {
            http_response_code(403);
            echo json_encode(["status" => "not authorized"]);
            die();
        }

        $query = "SELECT PasswordHash FROM User WHERE id = '". intval($_GET["id"]) ."';";
        if ($result = mysqli_query($link, $query)) {
            $resArray = mysqli_fetch_assoc($result);
            if (!password_verify($_GET["pwd"], $resArray['PasswordHash'])){
                http_response_code(403);
                echo json_encode(["status" => "not authorized"]);
                die();
            }

            if (set_user_password($link, $_GET["id"], $_GET["newpwd"])) {
                echo json_encode(["status" => "success"]);
                die();
            }
        }
    }

    http_response_code(400);
    echo json_encode(["status" => "error"]);
    die();
?>
