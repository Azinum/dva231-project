<?php
    session_start();
    require_once("../layout/profileboxes.php");
    require_once("../dbfunctions/dbconnection.php");
    require_once("../dbfunctions/get_specuserinfo.php");
    require_once("../dbfunctions/get_userteams.php");
    require_once("../dbfunctions/escapes.php");

    $userdata = NULL;
	if (isset($_GET["id"])) {
        $userdata = get_specuserinfo($link, $_GET["id"]);
    }
        
    if ($userdata == NULL || empty($userdata["user_id"])) {
        if ($_SESSION["isLoggedin"]) {
            header("Location: /profile_public.php?id=".$_SESSION["uid"]);
            die();
        } else {
            header("Location: /home.php");
            die();
        }
    }

    if ($userdata["is_disabled"]) {
        header("Location: /home.php");
        die();
    }
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
                            <img src="<?php echo $userdata["img_url"] ? equot($userdata["img_url"]) : "/img/default_profile_image.svg";  ?>">
                        </div>
                        <span class="username"><?php echo htmlspecialchars($userdata["name"]); ?></span>
                        <span class="bio"><?php echo htmlspecialchars($userdata["bio"]); ?></span>
                    </div>
                    <div class="flex-layout-section">
                        <div class="statbox">
                            <span class="label">Wins</span>
                            <span class="val"><?php echo htmlspecialchars($userdata["stats"]["won"]); ?></span>
                        </div>
                        <div class="statbox">
                            <span class="label">Ties</span>
                            <span class="val"><?php echo htmlspecialchars($userdata["stats"]["part"] - $userdata["stats"]["won"] - $userdata["stats"]["lost"]); ?></span>
                        </div>
                        <div class="statbox">
                            <span class="label">Losses</span>
                            <span class="val"><?php echo htmlspecialchars($userdata["stats"]["lost"]); ?></span>
                        </div>
                    </div>
                </div>
                <?php
                    if ($_SESSION["isLoggedin"] && ($_SESSION["admin"] || $_SESSION["uid"] == $_GET['id'])) {
                ?>
                    <div class="flex-layout-section flex-layout-section-wide">
                        <a href="/profile_modify.php?id=<?php echo $_GET["id"]; ?>" class="button button-submit" id="modify-button">Modify Profile</a>
                        <br>
                        <?php if ($_SESSION["admin"]) { ?>
                            <div class="button button-deny" id="modify-button" onclick="smite_victim_user(<?php echo $userdata['user_id'] ?>)">
                                Smite
                            </div>
                        <?php } ?>
                    </diV>

                <?php
                    }
                ?>
                <div class="flex-layout-section profilebox-separator">
                    <h3>Teams:</h3>
                    <?php
                        $teams = get_userteams($link, $_GET['id']);
                    ?>
                    <h4>Member of <?php echo count($teams); ?> teams</h4>
                    <?php
                        foreach($teams as $team) {
                            profile_box_team($team, [
                                "img_small" => false,
                                "show_stats" => false,
                                "show_rank" => false,
                                "show_score" => false,
                                "on_click" => "click_team('".esquot($team["disp_name"])."');",
                                "buttons" => [
                                    "leave" => false,
                                    "invite_controls" => false
                                ]
                            ]);
                        }
                    ?>
                </div>
                <div class="flex-layout-section">
                    <h3>Matches:</h3>
                    <h4 id="matches_showing">
                    </h4>
                    <?php
                        require_once("../dbfunctions/get_usermatches.php");
                        $matches = get_usermatches($link, $_GET["id"]);
                        foreach($matches as $match) {
                            //$lteam = $match["team1"]["name"] == $userdata["name"] ? "team1" : "team2";
                            $lteam = "team1";
                            //$other_team = $match["team1"] == $teamdata["name"] ? $match["team2"] : $match["team1"];
                            //$other_teamdata = get_specteaminfo($link, $other_team);

                            matchbox(
                                $match,
                                [
                                    "verified" => true,
                                    "lteam" => $lteam,
                                    "on_click" => "click_match(". intval($match["id"]) .")"
                                ]
                            );
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
