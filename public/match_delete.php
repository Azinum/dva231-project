<?php

require_once("../layout/navbar_dropdown.php");
require_once("header.php");
page_begin("Match Declined");
?>
	<div class="navbar shadow">
        <?php build_buttons(); ?>
    </div>
	<div class="content-column">
		<h1>Successfully declined match</h1>
		<p>The match was declined. Go <a href="/home.php">home</a> or create a new <a href="/match.php">match</a>.</p>
	</div>
<?php page_end(); ?>
