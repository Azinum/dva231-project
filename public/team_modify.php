<?php
    require_once("../layout/shadow.php");
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
        <?php searchoverlay_headtags(); ?>
    </head>
    <body>
        <?php searchoverlay(); ?>
        <div class="midbar">
            <?php shadow_start(); ?>
                <div class="shadowparent tabcontainer">
                    <?php
                        tablayout_begin([
                            0 => "Bio",
                            1 => "Members"
                        ]);

                        tabcontent_begin(0);
                        ?>
                            <div class="teambio">
                                <form>
                                    <div class="imgcontrols">
                                        <div class="profilepic">
                                            <img src="/img/tmp_profile.jpg">
                                        </div>
                                    </div>
                                    <div class="othercontrols">
                                        <input type="text" placeholder="Name">
                                        <textarea>Bio</textarea>
                                    </div>
                                    <input type="file" placeholder="Profile picture">
                                </form>
                                <div class="kickbutton deletebutton">
                                    <?php shadow_start(); ?>
                                        <a class="shadowparent">
                                            Delete Team
                                        </a>
                                    <?php shadow_end(); ?>
                                </div>
                            </div>
                        <?php
                        tabcontent_end();

                        tabcontent_begin(1);
                            
                        teambox(["name" => "Good Member","imgurl" => "/img/tmp_profile.jpg"], false, true);
                        teambox(["name" => "Good Member","imgurl" => "/img/tmp_profile.jpg"], false, true);
                        teambox(["name" => "Good Member","imgurl" => "/img/tmp_profile.jpg"], false, true);
                        teambox(["name" => "Good Member","imgurl" => "/img/tmp_profile.jpg"], false, true);
                        teambox(["name" => "Good Member","imgurl" => "/img/tmp_profile.jpg"], false, true);
                        teambox(["name" => "Good Member","imgurl" => "/img/tmp_profile.jpg"], false, true);

                        ?>
                            <?php shadow_start("addmembershadow"); ?>
                            <div class="addmember shadowparent" onclick="searchoverlay_toggle();">
                                <img src="/img/plus.svg">
                            </div>
                            <?php shadow_end(); ?>
                        <?php

                        tabcontent_end();

                        tablayout_end();
                    ?>
                </div>
            <?php shadow_end(); ?>
        </div>
    </body>
</html>
