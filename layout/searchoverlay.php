<?php
    function searchoverlay_headtags() { // run in head to include scripts and css
        ?>
            <link rel="stylesheet" type="text/css" href="/css/searchoverlay.css">
            <script src="js/searchoverlay.js"></script>
        <?php
    }

    function searchoverlay() {  // run at top of body to include the html
        ?>
            <div class="searchoverlay">
                <div class="button button-deny" onclick="searchoverlayToggle();">x</div>

                <form class="shadow">
                    <input class="shadow" type="text" oninput="searchoverlayUpdate(this);" placeholder="Search...">
                </form>

                <div class="results">
                </div>
            </div>
        <?php
    }

?>
