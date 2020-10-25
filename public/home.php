<?php session_start();
require_once("../layout/profileboxes.php");
require_once("../layout/leaderboard.php");
require_once("../dbfunctions/get_specteaminfo.php"); //Ta bort denna efter testing
require_once("../dbfunctions/get_specuserinfo.php"); //Ta bort denna efter testing
require_once("../dbfunctions/get_userteams.php"); //Ta bort denna efter testing
require_once("../dbfunctions/dbconnection.php");
require_once("../dbfunctions/get_usermatches.php"); //Ta bort denna efter testing
require_once("../dbfunctions/get_teamsbyrank.php");
require_once("../dbfunctions/get_matchuteam.php"); //Ta bort denna efter testing
require_once("../dbfunctions/get_membermatches.php"); //Ta bort denna efter testing
require_once("../dbfunctions/set_teamstatus.php"); //Ta bort denna efter testing
require_once("../dbfunctions/set_userstatus.php"); //Ta bort denna efter testing

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

    <div id="back-box" class="ui-box shadow">
        <h2>Ranks</h2>
        <form method="get">
            <input id="searchbar" class="text-input-field" type="text" name="search" placeholder="Search here...">
        </form>
        <div class="flextable">
            <!-- Table begin -->

            <?php build_leaderboard($link, get_teamsbyrank($link)) ?>

        </div> <!-- Table end -->
    </div>

    <!-- <div class="bg"></div> -->
    <?php //Ta bort detta efter testing
    ?>

</body>

</html>