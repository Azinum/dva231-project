<?php
//Ta in information med get. Sätt in dessa värden in i query. Kör query, kolla om lyckades. Bam
//Kolla om användarnamnet är taget, isåfall be om ett nytt 


abstract class register_team_errcodes {
    const success       = 0;
    const name_taken    = 1;
    const name_short    = 2;
    const dunno         = 3;
}

function register_team($link, $name, $bio, $leader, $img) { 

    //session_start();
    //$userInput = $_POST;
    $escName = mysqli_real_escape_string($link, $name);
    $escBio = mysqli_real_escape_string($link, $bio);
    $escImg = mysqli_real_escape_string($link, $img);
    $escLeader = mysqli_real_escape_string($link, $leader);
    $createteamquery = 'INSERT INTO Team (TeamName, TeamRanking, TeamImage, Bio, TeamLeader,isBanned, DisplayName) VALUES ("'.$escName.'",1200,"'.$escImg.'","'.$escBio.'","'.$escLeader.'",false,"'.$escName.'")';
    $namecheckquery = 'SELECT TeamName FROM Team WHERE TeamName = "'.$escName.'"';

    if (strlen($name) >= 3) {
        if ( !mysqli_num_rows (mysqli_query($link, $namecheckquery)) > 0)  {//Kollar om det finns någon krock med lagnamnet
            if ($result = mysqli_query($link, $createteamquery)){
                return register_team_errcodes::success;
            }
        } else {
            return register_team_errcodes::name_taken;
        }
    } else {
        return register_team_errcodes::name_short;
    }

    return register_team_errcodes::dunno;
}

?>
