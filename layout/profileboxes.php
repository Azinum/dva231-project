<?php
    function profileboxes_headtags() {
        ?>
            <!--TODO: PUT COMMON CSS HERE-->
        <?php
    }

    /*  Match format:
        [
            "team1" => <name of team1>,
            "team2" => <name of team2>,
            "id" => <int>,
            "result" => <string>
        ]

        Layout format:
        [
            "verified" => <bool to show/hide edit button>,
            "lteam" => <string, either "team1" or "team2". W/L will be displayed from the perspective of lteam>
        ]

        Teams format:
        [
            "team1" => [
                "disp_name" => <string>,
                "img_url"   => <string>
            ],
            "team2" => [
                <same thing>
            ]
        ]


    */
    function matchbox($match, $teams, $layout) {
        ?>
            <div class="matchbox shadow ui-box">
                <div class="team team1">
                    <div class="profilepic">
                        <img src="<?php echo htmlspecialchars($teams[$layout["lteam"]]["img_url"]); ?>">
                    </div>
                    <span class="label"><?php echo htmlspecialchars($teams[$layout["lteam"]]["disp_name"]); ?></span>
                </div>
                <div class="versus">
                    <span class="matchresult">
                        <?php
                            if ($match["result"] == "Tie") {
                                echo "T";
                            } else if ($layout["lteam"] == "team1") {
                                echo $match["result"] == "Team1Win" ? "W" : "L";
                            } else {
                                echo $match["result"] == "Team2Win" ? "W" : "L";
                            }
                        ?>
                    </span>
                    <span class="marker">
                        VS
                    </span>
                </div>
                <div class="team team2">
                    <span class="label">
                        <?php
                            echo htmlspecialchars(
                                $teams[
                                    $layout["lteam"] == "team1" ? "team2" : "team1"
                                ]["disp_name"]
                            );
                        ?>
                    </span>
                    <div class="profilepic">
                        <img src="<?php
                            echo htmlspecialchars(
                                $teams[
                                    $layout["lteam"] == "team1" ?  "team2" : "team1"
                                ]["img_url"]
                            );
                        ?>">
                    </div>
                </div>
                <?php if (!$layout["verified"]) { ?>
                    <div class="editbutton">
                        <a class="button button-image button-accept" href="/match.php">
                            <img src="/img/arrow.svg">
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php
    }

    /*  Data format:
        [
            "name" => <team name>,
            "img_url" => <url to prof. image>,
            "rank" => <number>,
            "score" => <number>,
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
            "stats_short" => <boolean>,
            "show_rank" => <boolean>,
            "show_score" => <boolean>,
            "buttons" => [
                "leave" => <boolean>,
                "invite_controls" => <boolean>
            ]
        ]
    */
    function profile_box_team($data, $layout) {
        ?>
            <div class="profile-box ui-box shadow" onclick="teambox_selected(this, '<?php echo htmlspecialchars($data["name"]); ?>');">
                <div class="profile">
                    <?php if ($layout["show_rank"]) { ?>
                        <div class="rank">
                            <?php echo htmlspecialchars($data["rank"]). "."; ?>
                        </div>
                    <?php } ?>
                    <div class="profilepic <?php echo $layout["img_small"] ? "profilepic-small" : ""; ?>">
                        <img src="<?php echo $data["img_url"] === NULL || $data["img_url"] === "" ? "/img/default_profile_image.svg" : htmlspecialchars($data["img_url"]); ?>">
                    </div>
                </div>
                <span class="label"><?php echo htmlspecialchars($data["disp_name"]); ?></span>
                <?php if ($layout["show_stats"]) { ?>
                    <div class="stats <?php echo $layout["stats_short"] ? "stats-short" : ""; ?>">
                        <span>
                            <?php
                                echo $layout["stats_short"] ? "P:" : "Partaken: ";
                                echo htmlspecialchars($data["stats"]["part"]);
                            ?>
                        </span>
                        <span>
                            <?php
                                echo $layout["stats_short"] ? "W:" : "Won: ";
                                echo htmlspecialchars($data["stats"]["won"]);
                            ?>
                        </span>
                        <span>
                            <?php
                                echo $layout["stats_short"] ? "L:" : "Lost: ";
                                echo htmlspecialchars($data["stats"]["lost"]);
                            ?>
                        </span>
                    </div>
                <?php } ?>
                <?php if ($layout["show_score"]) { ?>
                    <div class="score">
                        E: <?php echo htmlspecialchars($data["score"]); ?>
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
        ]
    */
    
    /*
        Layout: [
            "img_small" => <boolean>,
            "is_leader" => <boolean>,
            "show_stats" => <boolean>,
            "stats_short" => <boolean>,
            "on_click" => <string w/ js onclick function>,
            "buttons" => [
                "kick" => <boolean>,
                "make_leader" => <boolean>
            ],
            "button_clicks" => [
                "kick" => <string w/ js function to be run on click>,
                "make_leader" => <string w/ js function to be run on click>
            ]
        ]
    */

    function profile_box_member($data, $layout) {
        ?>
            <div class="profile-box ui-box shadow <?php echo $layout["is_leader"] ? "leader" : ""; ?>" <?php
                echo isset($layout["on_click"]) ? "onclick=\"". htmlspecialchars($layout["on_click"]). "\"" : ""; ?> data-user-id="<?php echo $data["user_id"]; ?>">
                <div class="profile">
                    <div class="profilepic <?php echo $layout["img_small"] ? "profilepic-small" : ""; ?>">
                        <img src="<?php echo $data["img_url"] === NULL ? "/img/default_profile_image.svg" : htmlspecialchars($data["img_url"]); ?>">
                    </div>
                </div>
                <span class="label"><?php echo htmlspecialchars($data["name"]); ?></span>
                <?php if ($layout["show_stats"]) { ?>
                    <div class="stats <?php echo $layout["stats_short"] ? "stats-short" : ""; ?>">
                        <span>
                            <?php
                                echo $layout["stats_short"] ? "P:" : "Partaken: ";
                                echo htmlspecialchars($data["stats"]["part"]);
                            ?>
                        </span>
                        <span>
                            <?php
                                echo $layout["stats_short"] ? "W:" : "Won: ";
                                echo htmlspecialchars($data["stats"]["won"]);
                            ?>
                        </span>
                        <span>
                            <?php
                                echo $layout["stats_short"] ? "L:" : "Lost: ";
                                echo htmlspecialchars($data["stats"]["lost"]);
                            ?>
                        </span>
                    </div>
                <?php } ?>
                <?php if ($layout["buttons"]["make_leader"]) { ?>
                    <div class="button button-accept" <?php 
                        echo isset($layout["button_clicks"]) ? "onclick=\"". htmlspecialchars($layout["button_clicks"]["make_leader"]) ."\"" : "";?>>
                        Make Leader
                    </div>
                <?php } ?>
                <?php if ($layout["buttons"]["kick"]) { ?>
                    <div class="button button-deny" <?php 
                        echo isset($layout["button_clicks"]) ? "onclick=\"". htmlspecialchars($layout["button_clicks"]["kick"]) ."\"" : "";?>>
                        Kick
                    </div>
                <?php } ?>
            </div>
        <?php
    }

?>
