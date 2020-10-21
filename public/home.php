<?php
require_once("../layout/profileboxes.php");
require_once("../layout/dbconnection.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Scoreboard: Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/profile_box.css">
</head>

<body>
    <?php include("navbar_final.php"); ?>
    <table id="layout">
        <!-- Ändra när header finns -->
        <tr>
            <td>
                <form method="get">
                    <input id="searchbar" class="text-input-field" type="text" name="search" placeholder="Search here...">
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <div id="back-box" class="ui-box shadow">
                    <h2>Ranks</h2>
                    <div class="flextable">
                        <!-- Table begin -->

                        <div>
                            <!-- Table row 1 begin -->
                            <!--Php funktion ska spotta ut sig hela tr för varje entry i teamdb, med information som matchar -->

                            <?php
                            profile_box_member([
                                "name" => "Teamname",
                                "img_url" => "/img/teamico.png",
                                "img_small" => true,

                                "show_stats" => true,
                                "stats_short" => true,
                                "stats" => ["won" => 13, "lost" => 3, "part" => 7],
                                "show_rank" => true,
                                "rank" => 1,
                                "show_score" => true,
                                "score" => 9001,
                                "buttons" => [
                                    "kick" => false
                                ]
                            ]);
                            ?>
                        </div> <!-- Table row 1 end -->
                        <div>
                            <!-- Table row 2 begin -->
                            <!--Har max-värden i namn, overflow startar för ranknummer vid 10 000. -->
                            <?php
                            profile_box_member([
                                "name" => "2nrdXuWOMHcFqMYzVDAFmZeQWeagZYugEuEA8cPN1G19q4TTXq",
                                "img_url" => "/img/teamico.png",
                                "img_small" => true,

                                "show_stats" => true,
                                "stats_short" => true,
                                "stats" => ["won" => 9999, "lost" => 9999, "part" => 19998],
                                "show_rank" => true,
                                "rank" => 9999,
                                "show_score" => true,
                                "score" => 400,
                                "buttons" => [
                                    "kick" => false
                                ]
                            ]);
                            ?>
                        </div> <!-- Table row 2 begin -->
                        <div>
                            <!--Har max-värden i namn, overflow startar för ranknummer vid 10 000. -->
                            <?php get_specteaminfo('TeamName') ?>
                        </div>

                    </div> <!-- Table end -->
                </div>
            </td>
        </tr>
    </table>
    <!-- <div class="bg"></div> -->
</body>

</html>