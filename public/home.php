<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Scoreboard: Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <table id="layout">
        <!-- Ändra när header finns -->
        <tr>
            <td>
                <form method="get">
                    <input id="searchbar" type="text" name="search" placeholder="Search here...">
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <div id="bbox">
                    <h2>Ranks</h2>
                    <table>
                        <!-- Scoreboard table -->
                        <tr>
                            <!--Php funktion ska spotta ut sig hela tr för varje entry i teamdb, med information som matchar -->
                            <td>

                                <div class="result">
                                    <div class="popup">
                                        <!-- Här är rutan som poppar upp, det finns flera olika sätt att hantera detta. Just nu finns elementet alltid där, men opacitet sätts till 0. Kommentera bort opacity -->
                                        <a> Info </a>
                                        <br>
                                        <a class="linktext" href="profile_public.php"> See more... </a>
                                    </div>
                                    <table>
                                        <tr>
                                            <!-- Inte den snyggaste lösningen med klasserna, overflow och längd på värden skapade problem.-->
                                            <td>
                                                <div class="itemPlacement"><a class="placement"> 1. </a></div>
                                            </td>
                                            <td><img class="teamimg" src="/img/teamico.png"></td> <!-- Tvinga 32x32 på användarbilder? -->
                                            <td>
                                                <div class="itemName"><a class="linktext" href="http://www.google.com">Teamname</a></div>
                                            </td>
                                            <td>
                                                <div class="itemWL"><a> W: 13 | T: 3 | L: 7 </a></div>
                                            </td>
                                            <td>
                                                <div class="itemWLMobile"><a> W/T/L<br>13/3/7 </a></div>
                                            </td>
                                            <td>
                                                <div class="itemELO"><a> E: 9001 </a></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <!--Har max-värden i namn, overflow startar för ranknummer vid 10 000. -->
                            <td>
                                <div class="result">
                                    <div class="popup">
                                        <a> Info </a>
                                        <br>
                                        <a class="linktext" href="profile_public.php"> See more... </a>
                                    </div>
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="itemPlacement"><a class="placement"> 9000. </a></div>
                                            </td>
                                            <td> <img class="teamimg" src="/img/teamico.png"></td>
                                            <td>
                                                <div class="itemName"> <a class="linktext" href="http://www.google.com">2nrdXuWOMHcFqMYzVDAFmZeQWeagZYugEuEA8cPN1G19q4TTXq</a> </div>
                                            </td>
                                            <td>
                                                <div class="itemWL"> <a> W: 9999 | T: 9999 | L: 9999 </a> </div>
                                            </td>
                                            <td>
                                                <div class="itemWLMobile"><a> W/T/L<br>9999/9999/9999 </a></div>
                                            </td>
                                            <td>
                                                <div class="itemELO"> <a> E: 400 </a></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>

                    </table>
                </div>
            </td>
        </tr>
    </table>
    <!-- <div class="bg"></div> -->
</body>

</html>