<?php session_start();
require_once("../layout/profileboxes.php");
require_once("../layout/leaderboard.php");
require_once("../layout/navbar_dropdown.php");
require_once("../dbfunctions/dbconnection.php");
require_once("../dbfunctions/get_teamsbyrank.php");
require_once("../dbfunctions/get_teamsbyrank_limit.php");


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
    <link href= "css/navbar.css" rel="stylesheet">
    <script src="/js/profile_box.js"></script>
</head>

<body>
<script src="js/leaderboard.js"> </script>
    <div class= "navbar">
        <?php build_buttons(); ?>
    </div>

    <div id="back-box" class="ui-box shadow">
        <h2>Ranks</h2>
        <div class="flextable">

            
                <script> test() </script>
           
        </div>
    </div>

</body>

</html>
