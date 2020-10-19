<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Scoreboard: Sign up</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/signup.css">
</head>

<body>
    <?php include("navbarexample.php"); ?>
    <div id="bbox">
        <h2>Sign up</h2>
        <table>
            <form method="post">
                <tr>
                    <td><input type="text" name="username" placeholder="Username"></td>
                    <td><input type="password" name="password" placeholder="Password"></td>
                </tr>
                <tr>
                    <td><input type="text" name="email" placeholder="Email"></td>
                    <td><input type="password" name="cnfrmpassword" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td> </td>
                    <td><input type="submit" value="Sign Up"></td>
                    <td> </td>
                </tr>
            </form>
        </table>
    </div>
</body>

</html>
