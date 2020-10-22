<?php
require_once("../layout/profileboxes.php");
require_once("../dbfunctions/get_specteaminfo.php");
require_once("../dbfunctions/get_userteams.php"); //Ta bort denna efter testing
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

                        <div class="flex-row">
                            <!-- Table row 1 begin -->
                            <!--Php funktion ska spotta ut sig hela tr för varje entry i teamdb, med information som matchar -->

                            <?php
                            profile_box_member([
                                "name" => "Teamname",
                                "img_url" => "/img/teamico.png",
                                "stats" => ["won" => 13, "lost" => 3, "part" => 7],
                                "rank" => 1,
                                "score" => 9001
                            ],
                            [
                                "show_stats" => true,
                                "img_small" => true,
                                "stats_short" => true,
                                "show_rank" => true,
                                "show_score" => true,
                                "buttons" => [
                                    "kick" => false
                                ]
                            ]);
                            ?>
                        </div> <!-- Table row 1 end -->
                        <div class="flex-row">
                            <!-- Table row 2 begin -->
                            <!--Har max-värden i namn, overflow startar för ranknummer vid 10 000. -->
                            <?php
                            profile_box_member([
                                "name" => "2nrdXuWOMHcFqMYzVDAFmZeQWeagZYugEuEA8cPN1G19q4TTXq",
                                "img_url" => "/img/teamico.png",
                                "stats" => ["won" => 9999, "lost" => 9999, "part" => 19998],
                                "score" => 400,
                                "rank" => 9999,
                            ],
                            [
                                "show_stats" => true,
                                "img_small" => true,
                                "stats_short" => true,
                                "show_rank" => true,
                                "show_score" => true,
                                "buttons" => [
                                    "kick" => false
                                ]
                            ]);
                            ?>
                        </div> <!-- Table row 2 begin -->
                        <div  class="flex-row">
                            <!--Har max-värden i namn, overflow startar för ranknummer vid 10 000. -->
                            <?php
                            //$info = get_specteaminfo("TeamName");
                            $info["img_small"] = true;
                            $info["show_stats"] = true;
                            $info["show_score"] = false; //Ändra när ELO i DB är fixat
                            $info["stats_short"] = true;
                            $info["show_rank"] = true;
                            $info["img_small"] = [
                                    "leave" => false,
                                    "invite_controls" => false
                            ];
                            $info["buttons"] = [
                                "kick"=> false
                            ];
                            profile_box_member (get_specteaminfo("TeamName"),$info);
                            ?>
                        </div>

                    </div> <!-- Table end -->
                </div>
            </td>
        </tr>
    </table>
    <!-- <div class="bg"></div> -->
</body>

</html>