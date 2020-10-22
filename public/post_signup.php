<?php session_start();
require_once("../dbfunctions/register_user.php");
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Scoreboard: Sign up</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/signup.css">
  <link rel="stylesheet" href="css/common.css">
</head>

<body>
    <?php include("navbar_final.php"); ?>
    <div class="ui-box shadow" id="back-box">
        <h2>Sign up</h2>
        <?php register_user() ?>

        <!-- Back to sign up page button? -->
    </div>
</body>

</html>
