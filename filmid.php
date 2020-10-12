<!DOCTYPE html>

<?php
require("../../../config.php");
require("fnc_films.php");
require("usesession.php");
//$filmhtml = readfilms();
require("header.php");

?>

<html lang="et">
<head>
<meta charset="utf-8">
	<title>Siin saab mõtteid lugeda</title>
</head>
<body>
	<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <?php echo readfilms(); ?>
  <p><a href="?Logout=1" >Logi välja</a></p>
<p>Mine esita veel üks <a href="mote.php">mõte</a>.</p>
<p>Mine tagasi <a href="home.php">pealehele</a>.</p>

</body>
</html>
