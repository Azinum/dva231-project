<?php
require_once("../dbfunctions/auth.php");
?>

<!DOCTYPE html>
<head>
	<link href= "css/common.css" rel="stylesheet">
	<link href= "css/navbar.css" rel="stylesheet">
</head>
<body>

	<div class= "navbar">
		<a href= "match.php" > Start match <img src="img/startmatch.png" class="nav-image" > </a>
		<a href= "team_modify.php" > My Teams <img src="img/teamicon.png" class="nav-image" > </a>
		<a href="home.php"> Search <img src="img/searchicon.webp" class="nav-image" > </a>

		<div class="dropdown">
			<a href= "profile_modify.php"> My Profile <img src="img/profileicon.png" class="nav-image" > </a>
				<div class="dropdown-content">
					<span>
						<a href="<?php set_loggedout() ?>">Log out</a>
					</span>
				</div>
		</div> 
	</div>
	
</body>