<?php session_start();
require_once("../dbfunctions/register_team.php");
require_once("../dbfunctions/dbconnection.php"); //Ta bort denna efter testing

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Scoreboard: Create Team</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/signup.css">
  <link rel="stylesheet" href="css/common.css">
</head>

<body>
    <?php include("navbar_final.php"); ?>
    <div class="ui-box shadow" id="back-box">
        <h2>Create Team</h2>
        <?php register_team($link) ?>

        <!-- Back to sign up page button? -->
    </div>
</body>

</html>
