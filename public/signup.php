<?php session_start();
require_once("../dbfunctions/register_user.php");

?>
<!DOCTYPE html>
<html>
<!-- Lägg till checks -->
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
        <table>
            <form method="post" action="post_signup.php"> <!-- Kolla på en TILL signup där den tar emot en get? -->
                <tr>
                    <td><input class="text-input-field" type="text" name="username" placeholder="Username"></td>
                    <td><input class="text-input-field" type="password" name="password" placeholder="Password"></td>
                </tr>
                <tr>
                    <td><input class="text-input-field" type="text" name="email" placeholder="Email"></td>
                    <td><input class="text-input-field" type="password" name="cnfrmpassword" placeholder="Confirm Password"></td> <!-- Confirm password med javascript -->
                </tr>
                <tr>
                    <td> </td>
                    <td><input class="button button-submit" name="signup" type="submit" value="Sign Up"></td>
                    <td> </td>
                </tr>
            </form>
        </table>
    </div>
</body>

</html>
