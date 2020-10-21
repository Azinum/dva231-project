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
                        0 => "Bio",
                        1 => "Members"
                    ]);

                    tabcontent_begin(0);
                    ?>
                        <div class="team-bio flex-layout-section-wide flex-layout-section">
                            <h3>Team Profile:</h3>
                            <form>
                                <div class="img-controls shadow ui-box">
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
                                    <input type="submit" class="button button-submit" value="Apply">
                                </div>
                            </form>
                            <div class="button-container">
                                <div class="button button-deny">
                                    Delete Team
                                </div>
                            </div>
                        </div>
                    <?php
                    tabcontent_end();

                    tabcontent_begin(1);
                        
                    profile_box_member([
                            "name" => "this is a member",
                            "img_url" => "/img/tmp_profile.jpg",
                        ],[
                            "img_small" => false,
                            "show_stats" => false,
                            "show_rank" => false,
                            "show_score" => false,
                            "buttons" => [ "kick" => true ]
                    ]);

                    ?>
                    <div class="add-member">
                        <div class="button button-image button-accept" onclick="select_player(this);">
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
