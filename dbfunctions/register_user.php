<?php //session_start();
//Ta in information med get. Sätt in dessa värden in i query. Kör query, kolla om lyckades. Bam
//Kolla om användarnamnet är taget, isåfall be om ett nytt 


function register_user () { 
    include("dbconnection.php");

    $userInput = $_POST; //Username, Email, Password måste in (hashning av password)
    //ProfileImageURL, Bio, IsAdmin, IsBanned, ID sets default
    $unamecheckquery = 'SELECT Username from User WHERE Username ="'. mysqli_real_escape_string($link, $userInput['username']).'" '; //Längdcheck 
    //Real escape string
    if (strlen($userInput['username']) >= 3) {
        if ( !mysqli_num_rows (mysqli_query($link, $unamecheckquery)) > 0)  {//Kollar om det finns någon krock med användarnamnet
            if ($password = password_hash($userInput['password'],PASSWORD_DEFAULT)) {
            
                $Userquery = 'INSERT INTO User (Username, Email, Bio, IsAdmin, IsBanned, PasswordHash) VALUES ("'.
                    mysqli_real_escape_string($link, $userInput['username']).'", "'.mysqli_real_escape_string($link, $userInput['email']).
                    '", "This is my bio", false, false, "'. mysqli_real_escape_string($link, $password) .'")';
                if ($result = mysqli_query($link, $Userquery)){
                    echo "User created successfully!";
                }
            }
        }
        else {
            echo "Username is already taken"; //Redirect to site if fail
        }
    }
    else
    {
        echo "Username too short!";
    }

}


?>
