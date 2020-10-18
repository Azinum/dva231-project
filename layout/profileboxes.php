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
    function matchbox($box) {
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
                    <div class="team">
                        <span class="label"><?php echo $box["rteam"]["name"]; ?></span>
                        <div class="profilepic">
                            <img src="<?php echo $box["rteam"]["imgurl"]; ?>">
                        </div>
                    </div>
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
    function teambox($box) {
        shadow_start();
        ?>
                <div class="teambox" onclick="teambox_selected(this, '<?php echo $box["name"]; ?>');">
                    <div class="profile">
                        <div class="profilepic">
                            <img src="<?php echo $box["imgurl"]; ?>">
                        </div>
                        <span class="label"><?php echo $box["name"]; ?></span>
                    </div>
                    <div class="stats">
                        <span>Participated: <?php echo $box["part"]; ?></span>
                        <span>Won: <?php echo $box["won"]; ?></span>
                    </div>
                </div>
        <?php
        shadow_end();
    }

?>
