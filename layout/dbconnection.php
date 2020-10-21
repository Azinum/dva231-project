<?php
    require_once("../layout/profileboxes.php");

    //Get specified team's info
    function get_specteaminfo ($name) {

        $link = mysqli_connect("138.197.179.196:3306","scoreboard_account", "gimme them scorez yoo");

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        
         $search = 'TeamName';
        //  $query = "SELECT TeamName, TeamRanking, TeamImage FROM Team WHERE TeamName = '$search'";
         $query = "SELECT TeamName, TeamRanking, TeamImage FROM Team WHERE TeamName = 'TeamName'";

         echo "connection up";
         echo "search: $search";
         echo "$query";

        //  if (!(mysqli_query($link, $query))) { //Någonting är fel med $link? $result blir en bool (false)
        //      echo "AAAAAAAAAAA NOOOOOOOOOOOOO";
        //     }


            if ($result = mysqli_query($link, $query)){
                echo "Result passed AAAAAAAA";
                $resArray = mysqli_fetch_assoc($result);



                $test = profile_box_member([
                    "name"=>$resArray['TeamName'],
                    "img_url"=>$resArray['TeamImage'],
                    "img_small"=> true,
        
                    "show_stats"=>true,
                    "stats_short"=> true,
                    "stats"=>["won"=> 13, "lost"=> 3, "part"=>7],
                    "show_rank"=> true,
                    "rank"=> $resArray['TeamRanking'],
                    "show_score"=> true,
                    "score"=> 9001,
                    "buttons" => [
                        "kick"=> false
                    ]
                    ]);
        
                 echo "$test";

            }




    }





?>