<!DOCTYPE html>

<?php
require("../../../config.php");
	$database = "if20_ron_pe_1";
	if(isset($_POST["ideasubmit"]) and !empty($_POST["ideasubmit"])){
		
		$conn = new mysqli($serverhost, $serverusername, $serverpassword,
		$database);
		//valmistan ette sql käsu
		$stmt = $conn->prepare("INSERT INTO myideas(idea) VALUES(?)");
		echo $conn-> error;
		//seome käsuga päris andmed
		//i - integar, d - decimal, s - string
		$stmt->bind_param("s", $_POST["ideainput"]);
		$stmt->execute();
		$stmt->close();
		$conn->close();
}
?>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Siin saab mõtteid sisestada</title>
	
</head>

<body>
  <form method="POST"> 
   <label>Sisesta oma pähe tulnud mõte!</label>
   <input type="text" name="ideainput" placeholder="Kirjuta siia mõte!">
   <input type ="submit" name="ideasubmit" value="Saada mõte ära!">
</form>
<p>Siit saad tagasi <a href="home.php"> pealehele</a>.</p>
<p>Siin saab <a href ="ideed.php"> lugeda mõtteid</a>.</p>
</body>
</html>
