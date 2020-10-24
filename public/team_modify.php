<?php
    require_once("../layout/tablayout.php");
    require_once("../layout/profileboxes.php");
    require_once("../layout/searchoverlay.php");
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
        <title>Tablayout example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php tablayout_headtags(); ?>
        <link rel="stylesheet" type="text/css" href="/css/profile.css">
        <link rel="stylesheet" type="text/css" href="/css/team_modify.css">
        <link rel="stylesheet" type="text/css" href="/css/common.css">
        <link rel="stylesheet" type="text/css" href="/css/profile_box.css">
        <?php searchoverlay_headtags(); ?>
        <script src="/js/team_modify.js"></script>
    </head>
    <body>
        <?php include("navbar_final.php"); ?>
        <?php searchoverlay(); ?>
        <div class="content-column">
            <div class="shadow tab-container">
                <?php
                    tablayout_begin([
                        0 => "Bio",
                        1 => "Members"
                    ]);

                    tabcontent_begin(0);
                    ?>
                        <div class="team-bio flex-layout-section-wide flex-layout-section">
                            <h3>Team Profile:</h3>
                            <form id="team-profile" onsubmit="event.preventDefault();">
                                <div class="img-controls shadow ui-box">
                                    <label>Current image:</label>
                                    <div class="profilepic">
                                        <img src="<?php echo $teamdata["img_url"] ? htmlspecialchars($teamdata["img_url"]) : "/img/default_profile_image.svg";  ?>">
                                    </div>
                                    <label>New image:</label>
                                    <div class="profilepic">
                                        <img src="" alt="(select image)" id="profile-pic-preview">
                                    </div>
                                    <input  type="file" placeholder="Profile picture" id="profile-pic" accept="image/*"
                                            onchange="previewImage(this, document.getElementById('profile-pic-preview'));">
                                    <label><i>Your image will be cropped as shown</i></label>
                                </div>
                                <div class="other-controls">
                                    <input  class="text-input-field shadow" type="text" placeholder="Name" id="display-name" minlength="3"
                                            value="<?php echo htmlspecialchars($teamdata["disp_name"]); ?>">
                                    <textarea class="text-input-field shadow" id="bio"><?php echo htmlspecialchars($teamdata["bio"]); ?></textarea>
                                    <div class="button-container">
                                        <input type="submit" class="button button-submit" value="Apply"
                                                onclick="submitTeamInfo(document.getElementById('team-profile'), '<?php echo htmlspecialchars($teamname); ?>')">
                                    </div>
                                    <div class="button-container">
                                        <div class="button button-deny">
                                            Delete Team
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php
                    tabcontent_end();

                    tabcontent_begin(1);
                        
                    ?>
                    <div class="member-list">
                        <?php

                        require_once("../dbfunctions/team_members.php");
						$members = get_team_members($link, $teamname);

						forEach($members as $member) {
							profile_box_member($member, [
                                "img_small" => false,
                                "is_leader" => $member["user_id"] == $teamdata["leader"],
                                "show_stats" => false,
                                "stats_short" => false,
                                "show_rank" => false,
                                "show_score" => false,
                                "buttons" => [
                                    "kick" => $member["user_id"] != $teamdata["leader"],
                                    "make_leader" => $member["user_id"] != $teamdata["leader"]
                                ],
                                "button_clicks" => [
                                    "kick" => 'kickUser(this.parentElement, '. $member["user_id"] .', "'. htmlspecialchars($teamname) .'")',
                                    "make_leader" => 'makeLeader(this.parentElement, '. $member["user_id"] .', "'. htmlspecialchars($teamname) .'")',
                                ]
							]);
						}

                        ?>
                    </div>

                    <div class="add-member">
                        <div class="button button-image button-accept" onclick="selectPlayer(document.querySelector('.member-list'), '<?php
                        echo htmlspecialchars($teamname); ?>');">
                            <img src="/img/plus.svg">
                        </div>
                    </div>

                    <?php

                    tabcontent_end();

                    tablayout_end();
                ?>
            </div>
        </div>
    </body>
</html>
