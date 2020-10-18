<?php
    require_once("../layout/shadow.php");

    function searchoverlay_headtags() {
        ?>
            <link rel="stylesheet" type="text/css" href="/css/searchoverlay.css">
            <script src="js/searchoverlay.js"></script>
        <?php
    }

    function searchoverlay() {
        ?>
            <div class="searchoverlay">
                <?php shadow_start("closeboxcontainer"); ?>
                    <div class="closebox shadowparent" onclick="searchoverlay_toggle();">x</div>
                <?php shadow_end(); ?>

                <?php shadow_start(); ?>
                    <form class="shadowparent">
                        <input type="text" oninput="searchoverlay_update();" placeholder="Search...">
                    </form>
                <?php shadow_end(); ?>

                <div class="results">
                </div>
            </div>
        <?php
    }

?>
