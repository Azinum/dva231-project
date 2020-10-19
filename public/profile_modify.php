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
        <?php include("navbarexample.php"); ?>
        <?php searchoverlay(); ?>
        <div class="midbar">
            <?php shadow_start(); ?>
                <div class="shadowparent tabcontainer">
                    <?php
                        tablayout_begin([
                            0 => "Profile",
                            1 => "Manage teams",
                            2 => "Password/email"
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
                            </div>
                        <?php
                        tabcontent_end();

                        tabcontent_begin(1);
                        ?>
                            <div class="profileboxes">
                                <div class="profilebox profilebox-wide">
                                    <h3>Team invites:</h3>
                                    <?php
                                        teambox(["name" => "Good Team3","imgurl" => "/img/tmp_profile.jpg"], false, false, false, true);
                                    ?>
                                    <!--<h4>No invites at this time</h4>-->
                                </div>
                                <div class="profilebox profilebox-tall profilebox-separator">
                                    <h3>Current Teams:</h3>
                                    <?php
                                        teambox(["name" => "Good Team2","imgurl" => "/img/tmp_profile.jpg"], false, false, true);
                                        teambox(["name" => "Good Team1","imgurl" => "/img/tmp_profile.jpg"], false, false, true);
                                    ?>
                                </div>
                                <div class="profilebox profilebox-tall">
                                    <h3>Create new team:</h3>
                                    <?php shadow_start(); ?>
                                        <div class="teambio">
                                            <form class="shadowparent">
                                                <div class="imgcontrols">
                                                    <div class="profilepic">
                                                        <img src="/img/tmp_profile.jpg">
                                                    </div>
                                                    <input type="file" placeholder="Profile picture">
                                                </div>
                                                <div class="othercontrols">
                                                    <input type="text" placeholder="Name">
                                                    <textarea>Bio</textarea>
                                                </div>
                                            </form>
                                        </div>
                                    <?php shadow_end(); ?>
                                    <?php shadow_start("addmembershadow"); ?>
                                        <div class="addmember shadowparent">
                                            <img src="/img/plus.svg">
                                        </div>
                                    <?php shadow_end(); ?>
                                </div>
                            </div>
                        <?php
                        tabcontent_end();

                        tabcontent_begin(2);
                        ?>
                            <div class="teambio">
                                <form>
                                    <h2>Email:</h2>
                                    <label>Current: anders@andersson.com</label>
                                    <input type="text" placeholder="New">
                                    <input type="text" placeholder="New again">
                                    <h2>Password:</h2>
                                    <input type="password" placeholder="Current">
                                    <input type="password" placeholder="New">
                                    <input type="password" placeholder="New again">
                                </form>
                                <div class="kickbutton deletebutton">
                                    <?php shadow_start(); ?>
                                        <a class="shadowparent">
                                            Delete Account
                                        </a>
                                    <?php shadow_end(); ?>
                                </div>
                            </div>
                        <?php
                        tabcontent_end();

                        tablayout_end();
                    ?>
                </div>
            <?php shadow_end(); ?>
        </div>
    </body>
</html>
