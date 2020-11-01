<?php

require_once("../layout/navbar_dropdown.php");
require_once("header.php");
page_begin("Match Results");
?>
	<div class="navbar">
        <?php build_buttons(); ?>
    </div>
	<div class="content-column">
		<h1>Successfully declined match</h1>
		<p>The match was declined. Go <a href="/home.php">home</a>.</p>
	</div>
<?php page_end(); ?>
