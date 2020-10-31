<?php

if (!isset($_GET["id"])) {
	header("Location: /home.php");
	exit();
}

$match_id = $_GET["id"];

require_once("header.php");
page_begin("Match Results");
?>
	<?php include("navbar_final.php"); ?>
	<div class="content-column">
		<h1>Successfully created match</h1>
		<p>You can view the match status and results <a href="/match.php?view=<?php echo $match_id ?>">here</a>.</p>
	</div>
<?php page_end(); ?>
