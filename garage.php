<?php 
	$switch = exec('gpio read 3');

	if(isset($_GET['trigger']) && $_GET['trigger'] == 1) {
		error_reporting(E_ALL);
		exec('gpio write 7 0');
		usleep(1000000);
		exec('gpio write 7 1');
		# an accidental page refresh causes the garage door to open
		# the following two lines must be before any HTML to prevent accidental door openings
		header('Location: /garage.php');
		die();
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Garage Opener</title>
	<title>Accordion Menu</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,user-scalable=yes">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<div class="site-header-div">
		<div class="site-header-table">
			<td><img class="site-header-icon" src="img/raspberry-pi.png" ></td>
			<td><a class="site-header-text" href="http://www.instructables.com">Accordion Menu</a></td>
			<td><img class="site-header-menu" src="img/menu-icon.png"></td>
		</div> 
	</div>
	
	<div>
	<nav class="nav" role="navigation">
		<ul class="nav__list">
			<li><a href="/index.php">Home Automation<xx class="value">></xx></a></li>
<?php
if ($switch == 1) {
	echo "<li><a href=\"#\">Garage Door<xx class=\"value\">closed</xx></a></li>";
} else {
	echo "<li><a href=\"#\">Garage Door<xx class=\"value\">open</xx></a></li>";
}
?>
<?php
if ($trigger == 0) {
	echo "<li><a href='/garage.php?trigger=1'><img src=\"img/remote-background.jpg\" width=\"20\" height=\"17\"> Open/Close Door</a></li>";
} else {
	echo "<li><a href='/garage.php'><img src=\"img/remote-background.jpg\" width=\"20\" height=\"17\"> Open/Close Door</a></li>";
}
?>
			<li><a href="/manual.pdf">Garage Door Opener Manual</a></li>
		</ul>
	</nav>
	</div>
	<!-- A footer is not recommended because the expanding menus can go beyond footer -->
</body>
</html>
