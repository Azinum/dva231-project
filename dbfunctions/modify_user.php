<?php

    function set_username($link, $id, $name) {
        if (strlen($name) >= 3) {
            $query = 'update User set Username="'. mysqli_real_escape_string($link, $name) .'" where Id="'. intval($id) .'";';
            if ($result = mysqli_query($link, $query)) {
                return true;
            }
        }
        return false;
    }

    function set_user_bio($link, $id, $bio) {
        $query = 'update User set Bio="'. mysqli_real_escape_string($link, $bio) .'" where Id="'. intval($id) .'";';
        if ($result = mysqli_query($link, $query)) {
            return true;
        }
        return false;
    }

    function set_user_img($link, $id, $url) {
        $query = 'update User set ProfileImageUrl="'. mysqli_real_escape_string($link, $url) .'" where Id="'. intval($id) .'";';
        if ($result = mysqli_query($link, $query)) {
            return true;
        }
        return false;
    }

    function set_user_email($link, $id, $email) {
        $query = 'update User set Email="'. mysqli_real_escape_string($link, $email) .'" where Id="'. intval($id) .'";';
        if ($result = mysqli_query($link, $query)) {
            return true;
        }
        return false;
    }
        
    function set_user_password($link, $id, $password) {
        $pwd_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = 'update User set PasswordHash="'. mysqli_real_escape_string($link, $pwd_hash) .'" where Id="'. intval($id) .'";';
        if ($result = mysqli_query($link, $query)) {
            return true;
        }
        return false;
    }

?>
