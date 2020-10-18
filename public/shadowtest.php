<?php
    require_once("../layout/shadow.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/css/shadow.css">
        <script src="/js/shadow.js"></script>
        <style>
            p {
                background: grey;
                border-radius: 1vw;
                padding: 2vw;
                margin: 0;  /*  IMPORTANT if you have margins within the shadowbox and the shadow looks weird,
                                it is prob. because of the weird black-magic that is collapsing margins...
                                https://css-tricks.com/what-you-should-know-about-collapsing-margins/
                                Solve by removing top- and bottom-margins and replacing them with padding or by
                                adding a bit of padding to the shadowbox itself.
                            */
            }

            .shadowbox {    /*  can add own css rules to shadowbox, default is just width:100%;
                                might be better just to add another class and add the styles to that to avoid
                                breaking things that don't expect the shadowbox to be different from the default
                                (see for example redtext class and how to apply it to the shadowbox below)
                            */
                width: 50%;
                margin: 1vw auto;
            }

            .redtext {
                color: red;
                text-align: center;
                width: 70%;
            }

            .bluebg p {
                background: blue;
            }
        </style>
    </head>
    <body>
        <?php shadow_start(); ?>    <!-- this will just be a normal shadowbox with no extra classes -->
            <p class="shadowparent"> hellooo </p>
        <?php shadow_end(); ?>

        <?php shadow_start("redtext"); ?>   <!-- This shadowbox will also have the class redtext -->
            <p class="shadowparent"> hello, im red </p>
            <!--      ^- shadowparent just sets z-index to make sure that we don't fall below the shadow -->
        <?php shadow_end(); ?>

        <?php shadow_start("redtext bluebg"); ?>   <!-- This shadowbox will have two classes, redtext and bluebg -->
            <p class="shadowparent"> red n blue </p>
        <?php shadow_end(); ?>
    </body>
</html>
