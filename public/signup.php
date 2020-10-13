<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Scoreboard: Sign up</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>
    body{
        background-color: #606060;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    input[type=text] {
        padding:0.5em;
        border-radius: 0.3em;
        border:none;
        margin-bottom: 0.3em;
        background-color:#383838 ;
        color: white;
        border: 0.1em solid transparent;
        outline:none;
        transition: 0.5s
    }

    input[type=password] {
        padding:0.5em;
        border-radius: 0.3em;
        border:none;
        background-color:#383838;
        color:white;
        margin-bottom: 0.3em;
        border: 0.1em solid transparent;
        outline:none;
        transition: 0.5s
    }

    input[type=submit] {
        padding:0.5em;
        border-radius: 0.3em;
        border:none;
        background-color:#4d79ff;
        color:white;
        margin-top: 2em;
        height:3em;
        width:6em;
        outline:none;
        transition: 0.5s
    }

    input[type=submit]:hover{
        background-color:#668cff;
        transition: 0.5s
    }

    input[type=text]:hover{
        outline:none;
        border: 0.1em solid #4d79ff;
        transition: 0.5s
    }

    input[type=text]:focus {
        outline:none;
        border: 0.1em solid #4d79ff;
        transition: 0.5s
    }

    input[type=password]:hover{
        outline:none;
        border: 0.1em solid #4d79ff;
        transition: 0.5s
    }

    input[type=password]:focus {
        outline:none;
        border: 0.1em solid #4d79ff;
        transition: 0.5s
    }


    #bbox {
        background-color: #505050;
        color: white;
        width: 36em;
        height: 16em;
        border-radius: 2em;
        padding: 1em;
        text-align: center;
        margin: auto;
        margin-top: 10%;
        filter: drop-shadow(0.5em 0.4em 0.4em #383838);
    }

    table {
        margin-left: auto;
        margin-right:auto;
    }

    @media screen and (max-width:640px) {
        #bbox {
        background-color: #505050;
        color: white;
        width: 26em;
        height: 16em;
        border-radius: 2em;
        padding: 1em;
        text-align: center;
        margin: auto;
        margin-top: 35%;
        filter: drop-shadow(0.5em 0.4em 0.4em #383838);
    }
}

  </style>
</head>

<body>
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