<!DOCTYPE html>

<?php
require("../../../config.php");
require("fnc_films.php");
require("usesession.php");
$inputerror = "";
if(isset($_POST["filmsubmit"])){
	if(empty($_POST["titleinput"]) or empty($_POST["genreinput"]) 
	or empty($_POST["studioinput"]) or empty($_POST["directorinput"])){
		$inputerror .= "Osa infot on sisestamata! ";
	}
	if($_POST["yearinput"] > date("Y") or $_POST["yearinput"] < 1895){
		$inputerror .= "Ebareaalne valmimisaasta!";
	}
	if(empty($inputerror)){
		savefilm($_POST["titleinput"], $_POST["yearinput"], $_POST["durationinput"],$_POST["genreinput"],
		$_POST["studioinput"],$_POST["directorinput"]);
	}
}

//$filmhtml = readfilms();
require("header.php");

?>

<html lang="et">
<head>
<meta charset="utf-8">
</head>
<body>
	<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
	 <img src="../b2nner/vp_banner.png" alt ="Veebiprogrammerimise kursuse 
  bänner">
  <form method="POST">
	  <label for="titleinput">Filmi pealkiri</label>
	  <input type="text" name="titleinput" id="titleinput" placeholder="Pealkiri">
	  <br>
	   <label for="yearinput">Filmi valmimisaasta</label>
	  <input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y"); ?>">
	    <label for="durationinput">Filmi kestus minutites</label>
	  <input type="number" name="durationinput" id="durationinput" value="80">
		<label for="genreinput">Filmi žanr</label>
		<input type="text" name="genreinput" id="genreinput" placeholder="Žanr">
		<label for="studioinput">Filmi tootja/stuudio</label>
		<input type="text" name="studioinput" id="studioinput" placeholder="Stuudio">
		<label for="directorinput">Lavastaja</label>
		<input type="text" name="directorinput" id="directorinput" placeholder="Lavastaja">
		<input type="submit" name="filmsubmit" value="Salvesta filmi info">
  </form>
  <p><a href="?Logout=1" >Logi välja</a></p>
<p>Mine esita veel üks <a href="mote.php">mõte</a>.</p>
<p>Mine tagasi <a href="home.php">pealehele</a>.</p>

</body>
</html>
