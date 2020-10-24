<?php
//Ta in information med get. Sätt in dessa värden in i query. Kör query, kolla om lyckades. Bam
//Kolla om användarnamnet är taget, isåfall be om ett nytt 


function register_team ($link) { 

    $userInput = $_POST;
    $escName = mysqli_real_escape_string($link, $userInput['teamname']);//Hämta värden från POST
    $escBio = mysqli_real_escape_string($link, $userInput['bio']);
    $escImg = mysqli_real_escape_string($link, $userInput['img']); //Denna kan vara lite tokig
    $escLeader = mysqli_real_escape_string($link, "1");//Hämta skaparens id, med hjälp av authentication? Just nu default till 1
    $createteamquery = 'INSERT INTO Team (TeamName, TeamRanking, TeamImage, Bio, TeamLeader,isBanned, DisplayName) VALUES ("'.$escName.'",1200,"'.$escImg.'","'.$escBio.'","'.$escLeader.'",false,"'.$escName.'")';
    $namecheckquery = 'SELECT TeamName FROM Team WHERE TeamName = "'.$escName.'"';
    
    
    echo mysqli_num_rows (mysqli_query($link, $namecheckquery));

    if (strlen($escName) >= 3) {
        if ( !mysqli_num_rows (mysqli_query($link, $namecheckquery)) > 0)  {//Kollar om det finns någon krock med lagnamnet
                if ($result = mysqli_query($link, $createteamquery)){
                    echo "Team created succesfully!";
                }else {
                    echo "This was not supposed to happen";
                }
               
        }
        else {
            echo "Teamname is already taken"; //Redirect to site if fail
        }
    }
    else
    {
        echo "Teamname too short!";
    }

}


?>
