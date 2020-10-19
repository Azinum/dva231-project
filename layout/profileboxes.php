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
        shadow_start();
        ?>
                <div class="matchbox">
                    <div class="team">
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
                            <?php shadow_start(); ?>
                                <a class="shadowparent" href="/match.php">
                                    <img src="/img/arrow.svg">
                                </a>
                            <?php shadow_end(); ?>
                        </div>
                    <?php } ?>
                </div>
        <?php
        shadow_end();
    }

    /* Teambox format:
        [
            "name" => <team name>,
            "imgurl" => <url to team image>,
            "part" => <num. participated matches>,
            "won" => <num. won matches>
        ]
    */
    function teambox($box, $stats = true, $kickbutton = false, $leavebutton = false, $invitecontrols = false) {
        shadow_start();
        ?>
                <div class="teambox shadowparent" onclick="teambox_selected(this, '<?php echo $box["name"]; ?>');">
                    <div class="profile">
                        <div class="profilepic">
                            <img src="<?php echo $box["imgurl"]; ?>">
                        </div>
                        <span class="label"><?php echo $box["name"]; ?></span>
                    </div>
                    <?php if ($stats) { ?>
                        <div class="stats">
                            <span>Participated: <?php echo $box["part"]; ?></span>
                            <span>Won: <?php echo $box["won"]; ?></span>
                        </div>
                    <?php } ?>
                    <?php if ($kickbutton) { ?>
                        <div class="kickbutton">
                            <?php shadow_start(); ?>
                                <a class="shadowparent">
                                    Kick
                                </a>
                            <?php shadow_end(); ?>
                        </div>
                    <?php } ?>
                    <?php if ($leavebutton) { ?>
                        <div class="kickbutton">
                            <?php shadow_start(); ?>
                                <a class="shadowparent">
                                    Leave
                                </a>
                            <?php shadow_end(); ?>
                        </div>
                    <?php } ?>
                    <?php if ($invitecontrols) { ?>
                        <div class="acceptbutton">
                            <?php shadow_start(); ?>
                                <a class="shadowparent">
                                    Accept
                                </a>
                            <?php shadow_end(); ?>
                        </div>
                        <div class="kickbutton">
                            <?php shadow_start(); ?>
                                <a class="shadowparent">
                                    Reject
                                </a>
                            <?php shadow_end(); ?>
                        </div>
                    <?php } ?>
                </div>
        <?php
        shadow_end();
    }

?>
