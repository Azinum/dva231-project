<?php
    require_once("../layout/profileboxes.php");
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
        <script src="/js/shadow.js"></script>
    </head>
    <body>
        <?php include("navbarexample.php"); ?>
        <div class="content-column">
            <div class="flex-container">
                <div class="bioboxes shadow">
                    <div class="flex-layout-section">
                        <div class="profilepic">
                            <img src="/img/tmp_profile.jpg">
                        </div>
                        <span class="username">Namn</span>
                        <span class="bio">Here is the text that is about me and where I am from but not you because this is my page and so on</span>
                    </div>
                    <div class="flex-layout-section">
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
                <div class="flex-layout-section profilebox-separator">
                    <h3>Teams:</h3>
                    <h4>Member of x teams</h4>
                    <?php
                        //teambox(["name" => "Good Team","imgurl" => "/img/tmp_profile.jpg","part" => "21","won" => "21"]);
                        profile_box_team([
                            "name" => "Good Team",
                            "img_url" => "/img/tmp_profile.jpg",
                            "show_stats" => true,
                            "stats" => [
                                "part" => 21,
                                "won" => 21,
                                "lost" => 0
                            ]
                        ]);

                        profile_box_member([
                            "name" => "Hejsan! Jag äro en member",
                            "img_url" => "/img/teamico.png",
                            "img_small" => true,

                            "show_stats" => true,
                            "stats_short" => true,
                            "stats" => ["won" => 22, "lost" => 3, "part" => 12],

                            "show_rank" => true,
                            "rank" => 1,
                            "show_score" => true,
                            "score" => 90001,
                            "buttons" => [
                                "kick" => false
                            ]
                        ]);
                    ?>
                </div>
                <div class="flex-layout-section">
                    <h3>Matches:</h3>
                    <h4 id="matches_showing">
                        Showing:
                        <select onchange="team_dropdown(this);">
                            <option selected>All</option>
                            <option>Other team</option>
                            <option>Other team</option>
                            <option>Other team</option>
                            <option>Other team</option>
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
        </div>
    </body>
</html>
