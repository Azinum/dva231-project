<?php
    require_once("../layout/profileboxes.php");
    require_once("../layout/shadow.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/profile.css">
        <link rel="stylesheet" href="css/shadow.css">
        <?php
            profileboxes_headtags();
        ?>
        <script src="/js/profile_public.js"></script>
        <script src="/js/shadow.js"></script>
    </head>
    <body>
        <div class="profileboxes midbar">
            <?php shadow_start(); ?>
                <div class="bioboxes">
                    <div class="profilebox">
                        <div class="profilepic">
                            <img src="/img/tmp_profile.jpg">
                        </div>
                        <span class="username">Namn</span>
                        <span class="bio">Here is the text that is about me and where I am from but not you because this is my page and so on</span>
                    </div>
                    <div class="profilebox">
                        <div class="statbox">
                            <span class="label">Wins</span>
                            <span class="val">8</span>
                        </div>
                        <div class="statbox">
                            <span class="label">Ties</span>
                            <span class="val">2</span>
                        </div>
                        <div class="statbox">
                            <span class="label">Losses</span>
                            <span class="val">12</span>
                        </div>
                    </div>
                </div>
            <?php shadow_end(); ?>
            <div class="profilebox profilebox-tall members">
                <h3>Members:</h3>
                <h4>x members</h4>
                <?php
                    teambox(["name" => "Good Guy","imgurl" => "/img/tmp_profile.jpg","part" => "21","won" => "21"]);
                    teambox(["name" => "Good Guy","imgurl" => "/img/tmp_profile.jpg","part" => "21","won" => "21"]);
                    teambox(["name" => "Good Guy","imgurl" => "/img/tmp_profile.jpg","part" => "21","won" => "21"]);
                ?>
            </div>
            <div class="profilebox profilebox-tall">
                <h3>Initiated Matches:</h3>
                <h4>1 unconfirmed match</h4>
                <?php
                    matchbox([
                        "lteam" => [ "name" => "Fools", "imgurl" => "/img/tmp_profile.jpg" ],
                        "rteam" => [ "name" => "Tools", "imgurl" => "/img/tmp_profile.jpg" ],
                        "won" => false
                    ], true);
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
                    ]);
                    matchbox([
                        "lteam" => [ "name" => "Fools", "imgurl" => "/img/tmp_profile.jpg" ],
                        "rteam" => [ "name" => "Tools", "imgurl" => "/img/tmp_profile.jpg" ],
                        "won" => false
                    ]);
                ?>
            </div>
        </div>
    </body>
</html>
