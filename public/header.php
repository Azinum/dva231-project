<?php

function page_begin($title) {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php $title ?></title>

		<link href= "css/common.css" rel="stylesheet">
		<link href= "css/match.css" rel="stylesheet">
		<link href= "css/navbar.css" rel="stylesheet">

		<script src="js/match.js"></script>
        <script src="js/navbardropdown.js"></script>
	</head>
	<body>
<?php
}

function page_end() {
?>

	</body>
</html>

<?php
}

?>
