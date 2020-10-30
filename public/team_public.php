<?php
    require_once("../layout/profileboxes.php");
    require_once("../dbfunctions/dbconnection.php");
    require_once("../dbfunctions/get_specteaminfo.php");
    require_once("../dbfunctions/escapes.php");

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
    session_start();
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
        <script src="/js/profile_box.js"></script>
    </head>
    <body>
        <?php include("navbar_final.php"); ?>
        <div class="content-column">
            <div class="flex-container">
                <div class="bioboxes shadow">
                    <div class="flex-layout-section">
                        <div class="profilepic">
                            <img src="<?php echo $teamdata["img_url"] ? equot($teamdata["img_url"]) : "/img/default_profile_image.svg";  ?>">
                        </div>
                        <span class="username"><?php echo htmlspecialchars($teamdata["disp_name"]); ?></span>
                        <span class="bio">
                            <?php echo htmlspecialchars($teamdata["bio"]); ?>
                        </span>
                    </div>
                    <div class="flex-layout-section">
                        <div class="statbox">
                            <span class="label">Wins</span>
                            <span class="val"><?php echo htmlspecialchars($teamdata["stats"]["won"]); ?></span>
                        </div>
                        <div class="statbox">
                            <span class="label">Ties</span>
                            <span class="val"><?php echo htmlspecialchars($teamdata["stats"]["part"] - $teamdata["stats"]["won"] - $teamdata["stats"]["lost"]); ?></span>
                        </div>
                        <div class="statbox">
                            <span class="label">Losses</span>
                            <span class="val"><?php echo htmlspecialchars($teamdata["stats"]["lost"]); ?></span>
                        </div>
                    </div>
                </div>
                <?php
                    session_start();
                    if ($_SESSION["isLoggedin"] && ($_SESSION["admin"] || $_SESSION["uid"] == $teamdata["leader"])) {
                ?>
                    <div class="flex-layout-section flex-layout-section-wide">
                        <a href="/team_modify.php?team=<?php echo $_GET["team"]; ?>" class="button button-submit" id="modify-button">Modify Team</a>
                    </diV>
                <?php
                    }
                ?>
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
                                "on_click" => "click_member(".$member["user_id"].");",
                                // NOTE (linus):    this should prob. just be an a-tag instead but ffs there aint no time for such fuckery in the
                                //                  unkempt spaghetti-jungle of a garden that is profileboxes.php. god i hate php.
                                "buttons" => [
                                    "kick" => false,
                                    "make_leader" => false
                                ]
							]);
						}
                    ?>
                </div>
                <div class="flex-layout-section">
                    <?php
                        require_once("../dbfunctions/get_pendingmatches.php");
                        $matches = get_pendingmatches($link, $teamname);
                        if (count($matches) != 0) {
                    ?>
                        <h3>Initiated Matches:</h3>
                        <h4><?php echo count($matches); ?> unconfirmed match<?php echo count($matches) > 1 ? "es" : ""; ?></h4>
                        <?php
                            foreach($matches as $match) {
                                $lteam  = $match["team1"] == $teamdata["name"] ? "team1" : "team2";

                                matchbox(
                                    $match,
                                    [
                                        "verified" => false,
                                        "lteam" => $lteam
                                    ]
                                );
                            }
                        ?>
                    <?php
                        }
                    ?>
                    <h3>Matches:</h3>
                    <h4></h4>
                    <?php
                        require_once("../dbfunctions/get_verified_matches.php");
                        $matches = get_verified_matches($link, $teamname);
                        foreach($matches as $match) {
                            $lteam = $match["team1"]["name"] == $teamdata["name"] ? "team1" : "team2";
                            //$other_team = $match["team1"] == $teamdata["name"] ? $match["team2"] : $match["team1"];
                            //$other_teamdata = get_specteaminfo($link, $other_team);

                            matchbox(
                                $match,
                                [
                                    "verified" => true,
                                    "lteam" => $lteam
                                ]
                            );
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
