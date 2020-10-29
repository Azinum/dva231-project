<?php

    function get_verified_matches($link, $team) {
        $ename = mysqli_real_escape_string($link, $team);
        //$query =    "Select * from Matches where IsVerified=1 and (Team1='". $ename ."' or Team2='". $ename ."');";
        $query = ''.
            'select Team1Info.Result, Team1Info.Id, Team1Info.Team1, Team1Info.Team2, '.
            'Team2Info.DisplayName as Team2DispName, Team2Info.TeamImage as Team2Image, '.
            'Team1Info.DisplayName as Team1DispName, Team1Info.TeamImage as Team1Image from ('.
                'select Matches.*, DisplayName, TeamImage from Matches join Team on TeamName=Team1 where IsVerified=1 and (Team1="'.$ename.'" or Team2="'.$ename.'")'.
            ') as Team1Info join ('.
                'select Matches.*, DisplayName, TeamImage from Matches join Team on TeamName=Team2 where IsVerified=1 and (Team1="'.$ename.'" or Team2="'.$ename.'")'.
            ') as Team2Info on Team2Info.Id = Team1Info.Id;';

        $return = [];

        if ($result = mysqli_query($link, $query)){
            while ($res_array = mysqli_fetch_assoc($result)) {
                if ($res_array['Id'] !== NULL) {
                    array_push($return, [   // formatterad enligt matchbox i profileboxes
                        "team1" => [
							"name" => $res_array["Team1"],
							"disp_name" => $res_array["Team1DispName"],
							"img_url" => $res_array["Team1Image"]
						],
                        "team2" => [
							"name" => $res_array["Team2"],
							"disp_name" => $res_array["Team2DispName"],
							"img_url" => $res_array["Team2Image"]
						],
                        "id" => $res_array["Id"],
                        "result" => $res_array["Result"]
                    ]);
                }
            }

            return $return; 
        }
    }

?>
