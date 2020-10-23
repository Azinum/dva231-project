<?php //session_start();
//Ta in information med get. Sätt in dessa värden in i query. Kör query, kolla om lyckades. Bam
//Kolla om användarnamnet är taget, isåfall be om ett nytt 


function register_team ($link) { 
    include("dbconnection.php");

    $userInput = $_POST; //
    $escName = mysqli_real_escape_string($link, "name yo");//Hämta värden från POST
    $escBio = mysqli_real_escape_string($link, $team);
    $escImg = mysqli_real_escape_string($link, $team); //Denna kan vara lite tokig
    $escBio = mysqli_real_escape_string($link, $team);//Hur ska vi hämta användarens
    $createteamquery = 'INSERT INTO Team (TeamName, TeamRanking, TeamImage, Bio, TeamLeader,isBanned) VALUES ("'.$escName'.",1200, "img/'.$escImg.'","'.$escBio.'",1,false)';
    $namecheckquery = 'SELECT COUNT (TeamName) FROM Team WHERE TeamName = "'.$escName.'"';
    //Real escape string
    if (strlen($escName) >= 3) {
        if ( !mysqli_num_rows (mysqli_query($link, $namecheckquery)) > 0)  {//Kollar om det finns någon krock med lagnamnet
                if ($result = mysqli_query($link, $createteamquery)){
                    echo "Team created succesfully!";
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
