<?php session_start() ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Scoreboard: Sign in</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/common.css">
</head>

<body>
    
    <?php include("navbar_final.php"); ?>
    <div id="back-box" class=" ui-box shadow">
        <h2>Sign in</h2>
        <table>
            <form method="post">
                <tr>
                    <td><input class="text-input-field" type="text" name="username" placeholder="E-Mail"> </td>
                </tr>
                <tr>
                    <td><input class="text-input-field" type="password" name="password" placeholder="Password"></td>
                </tr>
                <tr>
                    <td><input class="button button-submit" type="submit" name="login" value="Sign in"></td>
                </tr>
            </form>
            </table>
    </div>

    <?php 
if (isset($_POST['login'])) {   
        set_loggedin('1');
        echo"Oh yes";
    }
?>
</body>

</html>
