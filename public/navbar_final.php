<?php
require_once("../dbfunctions/auth.php");
require_once("../layout/navbar_dropdown.php");
?>

<!DOCTYPE html>
<head>
	<link href= "css/common.css" rel="stylesheet">
	<link href= "css/navbar.css" rel="stylesheet">
</head>
<body>

	<div class= "navbar">
		<a href= "match.php" > Start match <img src="img/startmatch.png" class="nav-image" > </a>
		<a href= "profile_modify.php" > My Teams <img src="img/teamicon.png" class="nav-image" > </a>
		<a href="home.php"> Search <img src="img/searchicon.webp" class="nav-image" > </a>

		<div class="dropdown">
			<a href= "profile_public.php"> My Profile <img src="img/profileicon.png" class="nav-image" > </a>
				<div class="dropdown-content">
					 <?php build_dropdown(); ?>
				</div>
		</div> 
	</div>
	
</body>