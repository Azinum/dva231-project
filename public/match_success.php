<?php

if (!isset($_GET["id"])) {
	header("Location: /home.php");
	exit();
}

$match_id = $_GET["id"];

require_once("../layout/navbar_dropdown.php");
require_once("header.php");
page_begin("Match Results");
?>
	<div class="navbar">
        <?php build_buttons(); ?>
    </div>
	<div class="content-column">
		<h1>Successfully created match</h1>
		<p>You can view match status and results <a href="/match.php?view=<?php echo $match_id ?>">here</a>.</p>
	</div>
<?php page_end(); ?>
