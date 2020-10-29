<?php

    //TODO: check filesize
    require_once("../../dbfunctions/dbconnection.php");
    require_once("../../dbfunctions/get_specuserinfo.php");
    require_once("../../dbfunctions/modify_user.php");

    header("Content-type: application/json;");
    if (isset($_POST["id"]) && isset($_FILES["image"])) {

        session_start();
        $userdata = get_specuserinfo($link, $_POST["id"]);
        if (!$_SESSION["isLoggedin"] || (!$_SESSION["admin"] && $_SESSION["uid"] != $_POST["id"])) {
            http_response_code(403);
            echo json_encode(["status" => "not authorized"]);
            die();
        }

        if (exif_imagetype($_FILES["image"]["tmp_name"])) {
            $size = getimagesize($_FILES["image"]["tmp_name"]);
            if ($size[0] != 0 && $size[1] != 0) {
                $image = imagecreatetruecolor(256, 256);
                $side = min($size[0], $size[1]);
                imagecopyresized(
                    $image, 
                    imagecreatefromstring(file_get_contents($_FILES["image"]["tmp_name"])),
                    0,
                    0,
                    max($size[0]/2 - $side/2, 0),
                    max($size[1]/2 - $side/2, 0),
                    255,
                    255,
                    $side,
                    $side
                );
                $image = imagepng($image, "../img/userimg/". preg_replace('/[^A-Za-z0-9_\-]/', '_', $_POST["id"]) .".png");
                if ($status = set_user_img(
                    $link, $_POST["id"],
                    "/img/userimg/". preg_replace('/[^A-Za-z0-9_\-]/', '_', $_POST["id"]) .".png"
                ) && $image) {
                    echo json_encode(["status" => "success"]);
                    die();
                }
            }
        }
    }

    http_response_code(400);
    echo json_encode(["status" => "error"]);    // Change for something more descriptive maybe...?
    die();

?>
