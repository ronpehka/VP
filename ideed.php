<!DOCTYPE html>

<?php
require("../../../config.php");
	//loen lehele kõik olemas olevad mõtted
	$database = "if20_ron_pe_1";
	$conn = new mysqli($serverhost, $serverusername, $serverpassword,
		$database);
	$stmt = $conn->prepare("SELECT idea FROM myideas");
	echo $conn-> error;
	//seome tulemuse muutujaga
	$stmt->bind_result($ideafromdb);
	$stmt->execute();
	$ideahtml = "";
	while($stmt->fetch()){
		$ideahtml .= "<p>" .$ideafromdb ."</p>";
	}
	$stmt->close();
	$conn->close();
?>

<html lang="et">
<head>
<meta charset="utf-8">
	<title>Siin saab mõtteid lugeda</title>
</head>
<body>
  <?php echo $ideahtml; ?>
<p>Mine esita veel üks <a href="mote.php">mõte</a>.</p>
<p>Mine tagasi <a href="home.php">pealehele</a>.</p>

</body>
</html>
