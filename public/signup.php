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
<script src="js/passwordcheck.js"> </script>
    <?php include("navbar_final.php"); ?>
    <div class="ui-box shadow" id="back-box">
        <h2>Sign up</h2>
         <a href="login.php"> Already have an account? </a> 
        <table>
            <form method="post" name="myForm" action="post_signup.php" onsubmit="return Compare()">
                <tr>
                    <td><a class="reminder">Username</a><br><input class="text-input-field" type="text" name="username" placeholder="Username"></td>
                    <td><a class="reminder">Password</a><br><input class="text-input-field" type="password" name="pword" placeholder="Password"></td>
                </tr>
                <tr>
                    <td><a class="reminder">Email</a><br><input class="text-input-field" type="text" name="email" placeholder="Email"></td>
                    <td><a class="reminder">Confirm Password</a><br><input class="text-input-field" type="password" name="cnfrmpassword" placeholder="Confirm Password"></td> <!-- Confirm password med javascript -->
                </tr>
                <tr>
                    <td></td>
                    <td><input class="button button-submit" name="signup" type="submit" value="Sign Up"></td>
                    <td> </td>
                </tr>

            </form>
        </table>
        
    </div>
</body>

</html>
