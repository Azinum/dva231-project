<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Scoreboard: Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            background-color: #606060;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
        }


        #bbox {
            background-color: #505050;
            color: white;
            width: 42em;
            height: 28em;
            border-radius: 2em;
            padding: 1em;
            text-align: center;
            margin: auto;
            margin-top: 5em;
            filter: drop-shadow(0.5em 0.4em 0.4em #383838);
            overflow: auto;
        }

        #searchbar {
            padding: 0.5em;
            border-radius: 0.3em;
            border: none;
            margin-bottom: 0.3em;
            background-color: #383838;
            color: white;
            width: 42em;
            height: 2em;
            outline: none;
            border: 0.1em solid transparent;
            transition: 0.5s
        }

        #searchbar:hover {
            outline: none;
            border: 0.1em solid #4d79ff;
            transition: 0.5s
        }

        #searchbar:focus {
            outline: none;
            border: 0.1em solid #4d79ff;
            transition: 0.5s
        }

        table {
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }

        #layout {
            border-spacing: 2em;

        }

        .teamimg {
            width: 2em;
            height: 2em;
        }

        .result {
            border-radius: 0.3em;
            background-color: #383838;
            color: white;
            height: 2em;
            width: 100%;
            display: table;
            position: relative;

        }

        .linktext {
            text-decoration: none;
            color: white;
            font-weight: bold;

        }

        .placement {
            font-size: 1.6em;
        }

        .itemName {
            text-overflow: ellipsis;
            overflow: hidden;
            width: 13em;
        }

        .itemWL {
            width: 15em;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .itemELO {
            width: 4em;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .itemPlacement {
            width: 5em;
            text-overflow: ellipsis;
            overflow: hidden;
        }


        .result:hover>.popup {
            background-color: blue;
            display: block;
            opacity: 1;
            transition: 0.5s;

        }

        .popup {
            border-radius: 0.3em;
            background-color: white;
            color: white;
            height: 100%;
            width: 100%;
            z-index: 300;
            position: absolute;
            top: 0;
            left: 0;
            transition: 0.5s;
            opacity: 0;
        }

        .itemWLMobile {
            display: none;
        }

        @media screen and (max-width:730px) {

            #layout {
                border-spacing: 2em;
                width: 2em;
            }

            #bbox {
                background-color: #505050;
                color: white;
                width: 24em;
                height: 15em;
                border-radius: 2em;
                padding: 1em;
                text-align: center;
                margin: auto;
                margin-top: 5em;
                filter: drop-shadow(0.5em 0.4em 0.4em #383838);
            }

            .placement {
                font-size: 1.6em;
            }


            #searchbar {
                padding: 0.5em;
                border-radius: 0.3em;
                border: none;
                margin-bottom: 0.3em;
                background-color: #383838;
                color: white;
                width: 24em;
                height: 2em;
                outline: none;
                border: 0.1em solid transparent;
                transition: 0.5s;
            }

            .result {
                border-radius: 0.3em;
                background-color: #383838;
                color: white;
                height: 2em;
                width: 100%;
                display: table;
                position: relative;
                font-size: smaller;
            }

            .itemName {
                text-overflow: ellipsis;
                overflow: hidden;
                width: 7em;
            }

            .itemWL {
                width: 9em;
                text-overflow: ellipsis;
                overflow: hidden;
                display: none;
            }

            .itemWLMobile {
                width: 9em;
                text-overflow: ellipsis;
                overflow: hidden;
                display: block;
            }

            .itemELO {
                text-overflow: ellipsis;
                overflow: hidden;
            }

            .itemPlacement {
                width: 2.3em;
                text-overflow: clip '.';
                overflow: hidden;
            }

            .placement {
                font-size: 1.1em;
                position: relative;
            }
        }
    </style>

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

</body>
</html>
