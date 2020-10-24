<?php
    require_once("../layout/profileboxes.php");
    require_once("../dbfunctions/dbconnection.php");
    require_once("../dbfunctions/get_specteaminfo.php");

	if (!isset($_GET["team"])) {
		header("Location: /home.php");
		die();
	}

    $teamname = get_teamname($link, $_GET["team"]);
    if (!$teamname) {
        header("Location: /home.php");
        die();
    }
    $teamdata = get_specteaminfo($link, $teamname);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/profile.css">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/profile_box.css">
        <?php
            profileboxes_headtags();
        ?>
        <script src="/js/profile_public.js"></script>
    </head>
    <body>
        <?php include("navbar_final.php"); ?>
        <div class="content-column">
            <div class="flex-container">
                <div class="bioboxes shadow">
                    <div class="flex-layout-section">
                        <div class="profilepic">
                            <img src="<?php echo $teamdata["img_url"] ? htmlspecialchars($teamdata["img_url"]) : "/img/default_profile_image.svg";  ?>">
                        </div>
                        <span class="username"><?php echo htmlspecialchars($teamdata["disp_name"]);; ?></span>
                        <span class="bio"><?php echo htmlspecialchars($teamdata["bio"]); ?></span>
                    </div>
                    <div class="flex-layout-section">
                        <div class="statbox">
                            <span class="label">Wins</span>
                            <span class="val"><?php echo htmlspecialchars($teamdata["stats"]["won"]); ?></span>
                        </div>
                        <div class="statbox">
                            <span class="label">Ties</span>
                            <span class="val"><?php echo htmlspecialchars($teamdata["stats"]["part"]); ?></span>
                        </div>
                        <div class="statbox">
                            <span class="label">Losses</span>
                            <span class="val"><?php echo htmlspecialchars($teamdata["stats"]["lost"]); ?></span>
                        </div>
                    </div>
                </div>
                <div class="flex-layout-section members profilebox-separator">
                    <?php
                        require_once("../dbfunctions/team_members.php");
						$members = get_team_members($link, $teamname);
                    ?>
                    <h3>Members:</h3>
                    <h4><?php echo count($members); ?> members</h4>
                    <?php

						forEach($members as $member) {
							profile_box_member($member, [
                                "img_small" => false,
                                "is_leader" => $member["user_id"] == $teamdata["leader"],
                                "show_stats" => false,
                                "stats_short" => false,
                                "show_rank" => false,
                                "show_score" => false,
                                "on_click" => "teambox_selected(this, '". htmlspecialchars($teamname) ."');",
                                "buttons" => [
                                    "kick" => false,
                                    "make_leader" => false
                                ]
							]);
						}
                    ?>
                </div>
                <div class="flex-layout-section">
                    <h3>Initiated Matches:</h3>
                    <?php
                        require_once("../dbfunctions/get_pendingmatches.php");
                        $matches = get_pendingmatches($link, $teamname);
                    ?>
                    <h4><?php echo count($matches); ?> unconfirmed match<?php echo count($matches) > 1 ? "es" : ""; ?></h4>
                    <?php
                        foreach($matches as $match) {
                            matchbox(
                                $match,
                                [
                                    "team1" => ["disp_name" => "team1", "img_url" => "/img/tmp_profile.png"],
                                    "team2" => ["disp_name" => "team2", "img_url" => "/img/tmp_profile.png"],
                                ],
                                [
                                    "verified" => false,
                                    "lteam" => "team1"
                                ]
                            );
                        }
                    ?>
                    <h3>Matches:</h3>
                    <h4 id="matches_showing">
                        Showing:
                        <select onchange="team_dropdown(this);">
                            <option selected>All</option>
                            <option>Other member</option>
                            <option>Other member</option>
                            <option>Other member</option>
                            <option>Other member</option>
                        </select>
                    </h4>
                    <?php
                        /*matchbox([
                            "lteam" => [ "name" => "Fools", "imgurl" => "/img/tmp_profile.jpg" ],
                            "rteam" => [ "name" => "Tools", "imgurl" => "/img/tmp_profile.jpg" ],
                            "won" => false
                        ]);
                        matchbox([
                            "lteam" => [ "name" => "Fools", "imgurl" => "/img/tmp_profile.jpg" ],
                            "rteam" => [ "name" => "Tools", "imgurl" => "/img/tmp_profile.jpg" ],
                            "won" => false
                        ]);
                        matchbox([
                            "lteam" => [ "name" => "Fools", "imgurl" => "/img/tmp_profile.jpg" ],
                            "rteam" => [ "name" => "Tools", "imgurl" => "/img/tmp_profile.jpg" ],
                            "won" => false
                        ]);
                        matchbox([
                            "lteam" => [ "name" => "Fools", "imgurl" => "/img/tmp_profile.jpg" ],
                            "rteam" => [ "name" => "Tools", "imgurl" => "/img/tmp_profile.jpg" ],
                            "won" => false
                        ]);*/
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
