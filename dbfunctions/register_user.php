<?php //session_start();
//Ta in information med get. Sätt in dessa värden in i query. Kör query, kolla om lyckades. Bam
//Kolla om användarnamnet är taget, isåfall be om ett nytt 


function register_user () { 
    include("dbconnection.php");

    $userInput = $_POST; //Username, Email, Password måste in (hashning av password)
    //ProfileImageURL, Bio, IsAdmin, IsBanned, ID sets default
    $unamecheckquery = 'SELECT Username from User WHERE Username ="'.$userInput['username'].'" '; 

    if ( !mysqli_num_rows (mysqli_query($link, $unamecheckquery)) > 0)  {//Kollar om det finns någon krock med användarnamnet
        if ($password = password_hash($userInput['password'],PASSWORD_DEFAULT)) {
        
            $Userquery = 'INSERT INTO User (Username, Email, Bio, IsAdmin, IsBanned, PasswordHash) VALUES ("'.$userInput['username'].'", "'.$userInput['email'].'", "This is my bio", false, false, "'.$password.'")';
            if ($result = mysqli_query($link, $Userquery)){
                echo "User created successfully!";
            }
        }
    }
    else {
        echo "Username is already taken";
    }

}




?>