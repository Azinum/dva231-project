<?php

if (!isset($_GET["id"])) {
	header("Location: /home.php");
	exit();
}

$match_id = $_GET["id"];

require_once("../layout/navbar_dropdown.php");
require_once("header.php");
page_begin("Match Verified");
session_start();
?>
	<div class="navbar shadow">
        <?php build_buttons(); ?>
    </div>
	<div class="content-column">
		<h1>Successfully verified match</h1>
		<p>The match was verified, click <a href="/match.php?view=<?php echo $match_id?>">here</a> to view the match results or go to the <a href="/home.php">leaderboard</a>.</p>
	</div>
<?php page_end(); ?>
