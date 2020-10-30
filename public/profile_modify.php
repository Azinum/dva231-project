<?php 

    require_once("../layout/tablayout.php");
    require_once("../layout/profileboxes.php");
    require_once("../layout/searchoverlay.php");
    require_once("../dbfunctions/dbconnection.php");
    require_once("../dbfunctions/get_specuserinfo.php");
    require_once("../dbfunctions/get_userteams.php");
    require_once("../dbfunctions/escapes.php");

    session_start();
	if (!isset($_GET["id"])) {
        if ($_SESSION["isLoggedin"]) {
            header("Location: /profile_modify.php?id=". $_SESSION["uid"] . (isset($_GET["teams"]) ? "&teams" : "") );
            die();
        }
		header("Location: /home.php");
		die();
	}

    $userdata = get_specuserinfo($link, $_GET["id"]);
    if ($userdata["user_id"] == NULL) {
		header("Location: /home.php");
		die();
    }

    if (!$_SESSION["isLoggedin"] || (!$_SESSION["admin"] && $_SESSION["uid"] != $_GET["id"])) {
        header("Location: /profile_public.php?id=".$_GET["id"]);
        die();
    }
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
        <script src="/js/user_modify.js"></script>
        <script src="/js/profile_box.js"></script>
    </head>
    <body>
        <?php include("navbar_final.php"); ?>
        <?php searchoverlay(); ?>
        <div class="content-column">
            <div class="shadow tab-container">
                <?php
                    tablayout_begin([
                        0 => "Profile",
                        1 => "Manage teams",
                        2 => "Password/email"
                    ], isset($_GET["teams"]) ? 1 : 0);

                    tabcontent_begin(0);
                    ?>
                        <div class="team-bio flex-layout-section flex-layout-section-wide">
                            <h3>User Profile:</h3>
                            <form id="user-profile" onsubmit="event.preventDefault();">
                                <div class="img-controls shadow ui-box">
                                    <label>Current image:</label>
                                    <div class="profilepic">
                                        <img src="<?php echo $userdata["img_url"] ? equot($userdata["img_url"]) : "/img/default_profile_image.svg";  ?>">
                                    </div>
                                    <label>New image:</label>
                                    <div class="profilepic">
                                        <img src="" alt="(select image)" id="profile-pic-preview">
                                    </div>
                                    <input  type="file" placeholder="Profile picture" id="profile-pic" accept="image/*" autocomplete="off"
                                            onchange="previewImage(this, document.getElementById('profile-pic-preview'));">
                                    <label><i>Your image will be cropped as shown</i></label>
                                </div>
                                <div class="other-controls">
                                    <input  class="text-input-field shadow" type="text" placeholder="Name" id="display-name" minlength="3"
                                            value="<?php echo equot($userdata["name"]); ?>">
                                    <textarea class="text-input-field shadow" id="bio"><?php echo htmlspecialchars($userdata["bio"]); ?></textarea>
                                    <div class="button-container">
                                        <input type="submit" class="button button-submit" value="Apply"
                                                onclick="submitUserInfo(document.getElementById('user-profile'), '<?php echo esquot($_GET['id']); ?>')">
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php
                    tabcontent_end();

                    tabcontent_begin(1);
                    ?>
                        <div class="flex-container">
                            <div class="flex-layout-section flex-layout-section-wide">
                                <h3>Team invites:</h3>
                                <?php
                                    profile_box_team([
                                            "name" => "Good Team3",
                                            "disp_name" => "Good Team3",
                                            "img_url" => "/img/tmp_profile.jpg",
                                        ],[
                                            "img_small" => false,
                                            "show_stats" => false,
                                            "show_rank" => false,
                                            "show_score" => false,
                                            "buttons" => [ "leave" => false, "invite_controls" => true ]
                                    ]);
                                ?>
                                <!--<h4>No invites at this time</h4>-->
                            </div>
                            <div class="flex-layout-section flex-layout-section-wide">
                                <h3>Current Teams:</h3>
                                <?php
                                    $teams = get_userteams($link, $_GET['id']);
                                    foreach($teams as $team) {
                                        profile_box_team($team, [
                                            "img_small" => false,
                                            "show_stats" => false,
                                            "show_rank" => false,
                                            "show_score" => false,
                                            //"on_click" => "click_team('".htmlspecialchars($team["disp_name"])."');",
                                            "buttons" => [
                                                "leave" => $_GET["id"] != $team["leader"],
                                                "visit" => true,
                                                "invite_controls" => false
                                            ],
                                            "button_clicks" => [
                                                "leave" => "kickUser(this.parentElement, '". esquot($_GET["id"]) ."', '". esquot($team["name"]) ."');",
                                                "visit" => "click_team('".esquot($team["disp_name"])."');"
                                            ]
                                        ]);
                                    }
                                ?>
                            </div>
                            <div class="flex-layout-section flex-layout-section-wide">
                                <h3>Create new team:</h3>
                                <div class="team-bio">
                                    <form onsubmit="event.preventDefault();" id="addteam-form">
                                        <div class="img-controls ui-box shadow">
                                            <div class="profilepic">
                                                <img src="/img/default_profile_image.svg" id="newteam-pic-preview">
                                            </div>
                                            <input  type="file" placeholder="Profile picture" id="newteam-img" accept="image/*" autocomplete="off"
                                                    onchange="previewImage(this, document.getElementById('newteam-pic-preview'));">
                                        </div>
                                        <div class="other-controls">
                                            <input class="text-input-field shadow" type="text" placeholder="Name" id="newteam-name" minlength="3">
                                            <textarea class="text-input-field shadow" id="newteam-bio">Bio</textarea>
                                            <div class="add-member">
                                                <input type="submit" class="button button-accept" onclick="addTeam(document.getElementById('addteam-form'));" value="Add">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                    tabcontent_end();

                    tabcontent_begin(2);
                    ?>
                        <div class="team-bio flex-layout-section flex-layout-section-wide">
                            <h3>Email:</h3>
                            <h4 id="current-email">Current: <?php echo htmlspecialchars($userdata["email"]); ?></h4>
                            <form onsubmit="event.preventDefault();" id="email-form">
                                <input class="text-input-field shadow" type="text" placeholder="New" id="email-new" required>
                                <input class="text-input-field shadow" type="text" placeholder="New again" id="email-new-repeat" required>
                                <label id="email-err"></label>
                                <div class="button-container">
                                    <input class="button button-submit" type="submit" value="Change" onclick="changeEmail(document.getElementById('email-form'), <?php
                                        echo intval($_GET["id"]); ?>);">
                                </div>
                            </form>
                            <h3>Password:</h3>
                            <form onsubmit="event.preventDefault();" id="password-form">
                                <input class="text-input-field shadow" type="password" placeholder="Current" id="pwd-current" required>
                                <input class="text-input-field shadow" type="password" placeholder="New" id="pwd-new" required>
                                <input class="text-input-field shadow" type="password" placeholder="New again" id="pwd-new-repeat" required>
                                <label id="pwd-err"></label>
                                <div class="button-container">
                                    <input class="button button-submit" type="submit" value="Change" onclick="changePass(document.getElementById('password-form'), <?php
                                        echo intval($_GET["id"]); ?>);">
                                </div>
                            </form>
                            <div class="button-container">
                                <div class="button button-deny">
                                    Delete Account
                                </div>
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
