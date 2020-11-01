<?php session_start();
require_once("../dbfunctions/dbconnection.php");
require_once("../dbfunctions/register_user.php");
require_once("../layout/navbar_dropdown.php");
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Scoreboard: Sign up</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/signup.css">
  <link rel="stylesheet" href="css/common.css">
  <link href= "css/navbar.css" rel="stylesheet">
  <script src="js/navbardropdown.js"></script>
</head>

<body>
    <div class= "navbar shadow">
        <?php build_buttons(); ?>
    </div>
    <div class="ui-box shadow" id="back-box">
        <h2>Sign up</h2>
        <?php register_user($link) ?>

        <!-- Back to sign up page button? -->
    </div>
</body>

</html>
