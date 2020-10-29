<?php

  //Get teams the speicifed user is a member of
  function get_userteams ($link, $id) {
    $query = "select * from Team join TeamMemberships on TeamMemberships.TeamName = Team.TeamName and TeamMemberships.Member = ".intval($id).";";

    if ($result = mysqli_query($link, $query)){
        $teamsArray = [];

        while ($resArray = mysqli_fetch_assoc($result)) {
            array_push($teamsArray,
                [
                   "name"=>$resArray['TeamName'],
                   "disp_name"=>$resArray['DisplayName'],
                   "img_url"=>$resArray['TeamImage'],
                   "rank"=>$resArray['TeamRanking'],
                   "bio"=>$resArray['Bio'],
                   "leader"=>$resArray['TeamLeader'],
                   "is_banned"=>$resArray['IsBanned'],
                ]
            );
        }

        return $teamsArray; 
    }
}



?>
