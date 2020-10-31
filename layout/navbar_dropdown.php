<?php
    require_once("../dbfunctions/auth.php");
//trophy ikon från https://www.flaticon.com/free-icon/trophy_1152912, must attribute author
//Vill vi att utloggade användare inte ska kunna se My Teams och start match då det inte är relevant för en utloggad användare? Ser väldigt tomt ut.

		echo '<script src="js/navbardropdown.js"></script>';

    function build_buttons() {
        if ($_SESSION["isLoggedin"] == true) {
            echo '<a href="match.php" > Start match <img src="img/startmatch.png" class="nav-image" > </a>';
            echo '<a href="profile_modify.php?teams" > My Teams <img src="img/teamicon.png" class="nav-image" > </a>';
            echo '<a href="home.php"> Leaderboard <img src="img/trophy.svg" class="nav-image" > </a>';

            echo '<div class="dropdown" onclick="toggleDropDown()">';
                echo '<a><img src="img/hm.svg" class="nav-image" > </a>';
                    echo '<div class="dropdown-content" id="dropdowncontentid">';
                        echo '<span>';
                        echo '<a href="profile_public.php">My Profile</a>';
                        echo '<a href="login.php?logout=true">Log out</a>';
                        echo '</span>';

                    echo '</div>';
            echo '</div>';
        }
        else { //Utloggad
            echo '<a href="match.php" > Start match <img src="img/startmatch.png" class="nav-image" > </a>';
            echo '<a href="login.php" > My Teams <img src="img/teamicon.png" class="nav-image" > </a>';
            echo '<a href="home.php"> Leaderboard <img src="img/trophy.svg" class="nav-image" > </a>';

            echo '<div class="dropdown" onclick="toggleDropDown()">';
                echo '<a><img src="img/hm.svg" class="nav-image" > </a>';
                    echo '<div class="dropdown-content" id="dropdowncontentid">';
                        echo '<span>';
                        echo '<a href="login.php">Sign in</a>';
                        echo '<a href="signup.php">Sign up</a>';
                        echo '</span>';
                    echo '</div>';
            echo '</div>';
    }
}
?>




