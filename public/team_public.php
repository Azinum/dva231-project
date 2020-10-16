<?php
    require_once("../layout/tablayout.php");    // Include the stuff
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Tablayout example</title>
        <?php tablayout_headtags(); // <- Adds the javascript and css for the tabs ?>
    </head>
    <body>
        <?php
            tablayout_begin([
                0 => "Bio",
                1 => "Members"
            ]);

            tabcontent_begin(0);
            ?>
                <div class="teambio">
                    <div class="profilepic">
                        <img src="/img/tmp_profile.jpg">
                    </div>
                    <form>
                        <input type="file" placeholder="Profile picture">
                        <input type="text" placeholder="Name">
                        <textarea>
                        </textarea>
                    </form>
                </div>
            <?php
            tabcontent_end();

            tabcontent_begin(1);
            ?>
                Members
            <?php
            tabcontent_end();

            tablayout_end();
        ?>
    </body>
</html>
