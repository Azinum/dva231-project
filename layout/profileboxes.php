<?php
    require_once("../layout/shadow.php");

    function profileboxes_headtags() {
        ?>
            <!--TODO: PUT COMMON CSS HERE-->
        <?php
    }

    /*  Matchbox format:
        [
            "lteam" => [
                "name" => <name of left team>,
                "imgurl" => <url to team image>
            ],
            "rteam" => [
                "name" => <name of right team>,
                "imgurl" => <url to tight image>
            ],
            "won" => <true or false dep. on who won>
        ]
    */
    function matchbox($box, $editbutton = false) {
        ?>
            <div class="matchbox shadow ui-box">
                <div class="team team1">
                    <div class="profilepic">
                        <img src="<?php echo $box["lteam"]["imgurl"]; ?>">
                    </div>
                    <span class="label"><?php echo $box["lteam"]["name"]; ?></span>
                </div>
                <div class="versus">
                    <span class="matchresult">
                        <?php echo $box["won"] ? "W" : "L" ?>
                    </span>
                    <span class="marker">
                        VS
                    </span>
                </div>
                <div class="team team2">
                    <span class="label"><?php echo $box["rteam"]["name"]; ?></span>
                    <div class="profilepic">
                        <img src="<?php echo $box["rteam"]["imgurl"]; ?>">
                    </div>
                </div>
                <?php if ($editbutton) { ?>
                    <div class="editbutton">
                        <a class="button button-image button-accept" href="/match.php">
                            <img src="/img/arrow.svg">
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php
    }

    /*  Teambox format:
        [
            "name" => <team name>,
            "imgurl" => <url to team image>,
            "part" => <num. participated matches>,
            "won" => <num. won matches>
        ]
    */
    function teambox($box, $stats = true, $kickbutton = false, $leavebutton = false, $invitecontrols = false) {
        ?>
            <div class="teambox ui-box shadow" onclick="teambox_selected(this, '<?php echo $box["name"]; ?>');">
                <div class="profile">
                    <div class="profilepic">
                        <img src="<?php echo $box["imgurl"]; ?>">
                    </div>
                    <span class="label"><?php echo $box["name"]; ?></span>
                </div>
                <?php if ($stats) { ?>
                    <div class="stats">
                        <span>Partaken: <?php echo $box["part"]; ?></span>
                        <span>Won: <?php echo $box["won"]; ?></span>
                    </div>
                <?php } ?>
                <?php if ($kickbutton) { ?>
                    <div class="button button-deny">
                        Kick
                    </div>
                <?php } ?>
                <?php if ($leavebutton) { ?>
                    <div class="kickbutton">
                        <div class="button button-deny">
                            Leave
                        </div>
                    </div>
                <?php } ?>
                <?php if ($invitecontrols) { ?>
                    <div class="acceptbutton">
                        <div class="button button-accept">
                            Accept
                        </div>
                    </div>
                    <div class="kickbutton">
                        <div class="button button-deny">
                            Reject
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php
    }

    /*  Box format:
        [
            "name" => <team name>,
            "img_url" => <url to prof. image>,
            "img_small" => <boolean>,
            
            "show_stats" => <boolean>,
            "stats" => [
                "part" => <num. participated matches>,
                "won" => <num. won matches>,
                "lost" => <num. lost matches>
            ],

            "buttons" => [
                "leave" => <boolean>,
                "invite_controls" => <boolean>
            ]
        ]
    */
    function profile_box_team($box) {
        ?>
            <div class="profile-box ui-box shadow" onclick="teambox_selected(this, '<?php echo $box["name"]; ?>');">
                <div class="profile">
                    <div class="profilepic <?php echo $box["img_small"] ? "profilepic-small" : ""; ?>">
                        <img src="<?php echo $box["img_url"]; ?>">
                    </div>
                </div>
                <span class="label"><?php echo $box["name"]; ?></span>
                <?php if ($box["show_stats"]) { ?>
                    <div class="stats">
                        <span>Partaken: <?php echo $box["stats"]["part"]; ?></span>
                        <span>Won: <?php echo $box["stats"]["won"]; ?></span>
                        <span>Lost: <?php echo $box["stats"]["lost"]; ?></span>
                    </div>
                <?php } ?>
                <?php if ($box["buttons"]["leave"]) { ?>
                    <div class="button button-deny">
                        Leave
                    </div>
                <?php } ?>
                <?php if ($box["buttons"]["invite_controls"]) { ?>
                    <div class="button button-accept">
                        Accept
                    </div>
                    <div class="button button-deny">
                        Reject
                    </div>
                <?php } ?>
            </div>
        <?php
    }

    /*  Box format:
        [
            "name" => <member name>,
            "img_url" => <url to prof. image>,
            "img_small" => <boolean>,

            "show_stats" => <boolean>,
            "stats_short" => <boolean>,
            "stats" => [
                "part" => <num. participated matches>,
                "won" => <num. won matches>,
                "lost" => <num. lost matches>
            ],

            "show_rank" => <boolean>,
            "rank" => <number>,

            "show_score" => <boolean>,
            "score" => <number>,

            "buttons" => [
                "kick" => <boolean>
            ]
        ]
    */
    function profile_box_member($box) {
        ?>
            <div class="profile-box ui-box shadow" onclick="teambox_selected(this, '<?php echo $box["name"]; ?>');">
                <div class="profile">
                    <?php if ($box["show_rank"]) { ?>
                        <div class="rank">
                            <?php echo $box["rank"]. "."; ?>
                        </div>
                    <?php } ?>
                    <div class="profilepic <?php echo $box["img_small"] ? "profilepic-small" : ""; ?>">
                        <img src="<?php echo $box["img_url"]; ?>">
                    </div>
                </div>
                <span class="label"><?php echo $box["name"]; ?></span>
                <?php if ($box["show_stats"]) { ?>
                    <div class="stats <?php echo $box["stats_short"] ? "stats-short" : ""; ?>">
                        <span>
                            <?php
                                echo $box["stats_short"] ? "P:" : "Partaken: ";
                                echo $box["stats"]["part"];
                            ?>
                        </span>
                        <span>
                            <?php
                                echo $box["stats_short"] ? "W:" : "Won: ";
                                echo $box["stats"]["won"];
                            ?>
                        </span>
                        <span>
                            <?php
                                echo $box["stats_short"] ? "L:" : "Lost: ";
                                echo $box["stats"]["lost"];
                            ?>
                        </span>
                    </div>
                <?php } ?>
                <?php if ($box["show_score"]) { ?>
                    <div class="score">
                        E: <?php echo $box["score"]; ?>
                    </div>
                <?php } ?>
                <?php if ($box["buttons"]["kick"]) { ?>
                    <div class="button button-deny">
                        Kick
                    </div>
                <?php } ?>
            </div>
        <?php
    }

?>
