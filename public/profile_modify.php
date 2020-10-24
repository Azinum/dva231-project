<?php
    require_once("../layout/tablayout.php");
    require_once("../layout/profileboxes.php");
    require_once("../layout/searchoverlay.php");
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
    </head>
    <body>
        <?php include("navbarexample.php"); ?>
        <?php searchoverlay(); ?>
        <div class="content-column">
            <div class="shadow tab-container">
                <?php
                    tablayout_begin([
                        0 => "Profile",
                        1 => "Manage teams",
                        2 => "Password/email"
                    ]);

                    tabcontent_begin(0);
                    ?>
                        <div class="team-bio flex-layout-section flex-layout-section-wide">
                            <h3>User Profile:</h3>
                            <form>
                                <div class="img-controls ui-box shadow">
                                    <div class="profilepic">
                                        <img src="/img/tmp_profile.jpg">
                                    </div>
                                    <input type="file" placeholder="Profile picture">
                                </div>
                                <div class="other-controls">
                                    <input class="text-input-field shadow" type="text" placeholder="Name">
                                    <textarea class="text-input-field shadow" >Bio</textarea>
                                </div>
                                <div class="button-container">
                                    <input class="button button-submit" type="submit" value="Apply">
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
                                    profile_box_team([
                                            "name" => "Good Team3",
                                            "img_url" => "/img/tmp_profile.jpg",
                                        ],[
                                            "img_small" => false,
                                            "show_stats" => false,
                                            "show_rank" => false,
                                            "show_score" => false,
                                            "buttons" => [ "leave" => true, "invite_controls" => false ]
                                    ]);
                                ?>
                            </div>
                            <div class="flex-layout-section flex-layout-section-wide">
                                <h3>Create new team:</h3>
                                    <div class="team-bio">
                                        <form>
                                            <div class="img-controls ui-box shadow">
                                                <div class="profilepic">
                                                    <img src="/img/tmp_profile.jpg">
                                                </div>
                                                <input type="file" placeholder="Profile picture">
                                            </div>
                                            <div class="other-controls">
                                                <input class="text-input-field shadow" type="text" placeholder="Name">
                                                <textarea class="text-input-field shadow">Bio</textarea>
                                            </div>
                                        </form>
                                    </div>
                                <div class="add-member">
                                    <div class="button button-image button-accept">
                                        <img src="/img/plus.svg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    tabcontent_end();

                    tabcontent_begin(2);
                    ?>
                        <div class="team-bio flex-layout-section flex-layout-section-wide">
                            <h3>Email:</h3>
                            <h4>Current: anders@andersson.com</h4>
                            <form>
                                <input class="text-input-field shadow" type="text" placeholder="New">
                                <input class="text-input-field shadow" type="text" placeholder="New again">
                                <div class="button-container">
                                    <input class="button button-submit" type="submit" value="Change">
                                </div>
                            </form>
                            <h3>Password:</h3>
                            <form>
                                <input class="text-input-field shadow" type="password" placeholder="Current">
                                <input class="text-input-field shadow" type="password" placeholder="New">
                                <input class="text-input-field shadow" type="password" placeholder="New again">
                                <div class="button-container">
                                    <input class="button button-submit" type="submit" value="Change">
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
