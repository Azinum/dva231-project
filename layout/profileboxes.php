<?php
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
    /*function teambox($box, $stats = true, $kickbutton = false, $leavebutton = false, $invitecontrols = false) {
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
    }*/

    /*  Data format:
        [
            "name" => <team name>,
            "img_url" => <url to prof. image>,
            "stats" => [
                "part" => <num. participated matches>,
                "won" => <num. won matches>,
                "lost" => <num. lost matches>
            ]
        ]
    */
    /*  Layout format:
        [
            "img_small" => <boolean>,
            "show_stats" => <boolean>,
            "buttons" => [
                "leave" => <boolean>,
                "invite_controls" => <boolean>
            ]
        ]
    */
    function profile_box_team($data, $layout) {
        ?>
            <div class="profile-box ui-box shadow" onclick="teambox_selected(this, '<?php echo $data["name"]; ?>');">
                <div class="profile">
                    <div class="profilepic <?php echo $layout["img_small"] ? "profilepic-small" : ""; ?>">
                        <img src="<?php echo $data["img_url"]; ?>">
                    </div>
                </div>
                <span class="label"><?php echo $data["name"]; ?></span>
                <?php if ($layout["show_stats"]) { ?>
                    <div class="stats">
                        <span>Partaken: <?php echo $data["stats"]["part"]; ?></span>
                        <span>Won: <?php echo $data["stats"]["won"]; ?></span>
                        <span>Lost: <?php echo $data["stats"]["lost"]; ?></span>
                    </div>
                <?php } ?>
                <?php if ($layout["buttons"]["leave"]) { ?>
                    <div class="button button-deny">
                        Leave
                    </div>
                <?php } ?>
                <?php if ($layout["buttons"]["invite_controls"]) { ?>
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

    /*  Data format:
        [
            "name" => <member name>,
            "img_url" => <url to prof. image>,
            "stats" => [
                "part" => <num. participated matches>,
                "won" => <num. won matches>,
                "lost" => <num. lost matches>
            ],
            "rank" => <number>,
            "score" => <number>,
        ]
    */
    
    /*
        Layout: [
            "img_small" => <boolean>,
            "show_stats" => <boolean>,
            "stats_short" => <boolean>,
            "show_rank" => <boolean>,
            "show_score" => <boolean>,
            "buttons" => [
                "kick" => <boolean>
            ]
        ]
    */

    function profile_box_member($data, $layout) {
        ?>
            <div class="profile-box ui-box shadow" onclick="teambox_selected(this, '<?php echo $data["name"]; ?>');">
                <div class="profile">
                    <?php if ($layout["show_rank"]) { ?>
                        <div class="rank">
                            <?php echo $data["rank"]. "."; ?>
                        </div>
                    <?php } ?>
                    <div class="profilepic <?php echo $layout["img_small"] ? "profilepic-small" : ""; ?>">
                        <img src="<?php echo $data["img_url"]; ?>">
                    </div>
                </div>
                <span class="label"><?php echo $data["name"]; ?></span>
                <?php if ($layout["show_stats"]) { ?>
                    <div class="stats <?php echo $layout["stats_short"] ? "stats-short" : ""; ?>">
                        <span>
                            <?php
                                echo $layout["stats_short"] ? "P:" : "Partaken: ";
                                echo $data["stats"]["part"];
                            ?>
                        </span>
                        <span>
                            <?php
                                echo $layout["stats_short"] ? "W:" : "Won: ";
                                echo $data["stats"]["won"];
                            ?>
                        </span>
                        <span>
                            <?php
                                echo $layout["stats_short"] ? "L:" : "Lost: ";
                                echo $data["stats"]["lost"];
                            ?>
                        </span>
                    </div>
                <?php } ?>
                <?php if ($layout["show_score"]) { ?>
                    <div class="score">
                        E: <?php echo $data["score"]; ?>
                    </div>
                <?php } ?>
                <?php if ($layout["buttons"]["kick"]) { ?>
                    <div class="button button-deny">
                        Kick
                    </div>
                <?php } ?>
            </div>
        <?php
    }

?>
