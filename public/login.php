<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Scoreboard: Sign in</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <?php include("navbarexample.php"); ?>
    <div id="bbox">
        <h2>Sign in</h2>
        <table>
            <form method="post">
                <tr>
                    <td><input type="text" name="username" placeholder="E-Mail"> </td>
                </tr>
                <tr>
                    <td><input type="password" name="password" placeholder="Password"></td>
                </tr>
                <tr>
                    <td><input type="button" value="Sign in"></td>
                </tr>
            </form>
            </table>
    </div>
</body>

</html>
