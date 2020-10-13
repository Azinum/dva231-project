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
            // To begin the tab layout, specify a numbered list of tabs to display, with their names
            // (Tabs will apppear ordered by their number)
            tablayout_begin([
                0 => "A Tab",       // The first tab will be named "A Tab"
                1 => "Another Tab", // The secont will be "Another Tab"
                2 => "Taaabs."      // ...and so on
                                    // <- Can ofc. add more tabs here
            ]);

            // Now, we specify the content of all the tabs
            tabcontent_begin(0 /* <- The number of the tab to specify */);    // Start specifying the contents of the tab "A Tab"
            ?>
                <p>
                    This is some <i>spicy</i> content!<br>
                    All in the first tab!
                </p>
            <?php
            tabcontent_end();   // Close the tab

            tabcontent_begin(1);    // Start specifying the contents of the tab "Another Tab"
            ?>
                <p>
                    Now this, this is another tab entirely!
                </p>
                <h1>TÄB.</h1>
            <?php
            tabcontent_end();   // Close the tab

            tabcontent_begin(2);
            ?>
                <b>This is also a tab.</b>
            <?php
            tabcontent_end();

            tablayout_end();    // Close the tab layout
        ?>
    </body>
</html>
