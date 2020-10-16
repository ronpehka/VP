<!DOCTYPE html>
<?php 
require("../config.php");
require("fnc_general.php");
require("salvestus.php");
$firstname = "";
$lastname = "";
$birthday = null;
$birthmonth = null;
$birthyear = null;
$birthdate = null;
$email = "";
$gender = "";
$password = "";
$secondpassword = "";
$firstnameerror = "";
$lastnameerror = "";
$birthdayerror = null;
$birthmontherror = null;
$birthyearerror = null;
$birthdateerror = null;
$emailerror = "" ;
$gendererror = "";
$passworderror = "";
$secondpassworderror = "";
$notice = "Kasutaja loomine õnnestus!";
$monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];

if(isset($_POST["userinfo"])){
	  
	  if (!empty($_POST["firstnameinput"])){
		$firstname = test_input($_POST["firstnameinput"]);
	  } else {
		  $firstnameerror = "Palun sisesta eesnimi!";
	  }
	  
	  if (!empty($_POST["lastnameinput"])){
		$lastname = test_input($_POST["lastnameinput"]);
	  } else {
		  $lastnameerror = "Palun sisesta perekonnanimi!";
	  }
	  
	  if(isset($_POST["genderinput"])){
		$gender = intval($_POST["genderinput"]);
		//$gender = $_POST["genderinput"];
	  } else {
		  $gendererror = "Palun märgi sugu!";
	  }
	  
	  if(!empty($_POST["birthdayinput"])){
		  $birthday = intval($_POST["birthdayinput"]);
	}else{
		$birthdayerror = "Palun vali sünnikuupäev!";}
	   if(!empty($_POST["birthmonthinput"])){
		  $birthmonth = intval($_POST["birthmonthinput"]);
	}else{
		$birthmontherror = "Palun vali sünnikuu!";
		}
	 if(!empty($_POST["birthyearinput"])){
		  $birthyear = intval($_POST["birthyearinput"]);
	}else{
		$birthyearerror = "Palun vali sünniaasta!";}
	  
	  //kontrollime kuupäeva kehtivust
	  if(!empty($birthday) and !empty($birthmonth) and !empty($birthyear)){
		  if(checkdate($birthmonth, $birthday, $birthyear)){
			  $tempdate = new DateTime($birthyear ."-" .$birthmonth ."-" .$birthday);
			  $birthdate = $tempdate->format("Y-m-d");
		  }else{
			  $birthdateerror = "Kuupäev ei ole reealne!";  
		}	  
	  }
	  
 if (!empty($_POST["emailinput"])){
		$email = test_input($_POST["emailinput"]);
	  } else {
		  $emailerror = "Palun sisesta e-postiaadress!";
	  }
	  
	  if (empty($_POST["passwordinput"])){
		$passworderror = "Palun sisesta salasõna!";
	  } else {
		  if(strlen($_POST["passwordinput"]) < 8){
			  $passworderror = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["passwordinput"]) ." märki).";
		  }
	  }
	  
	  if (empty($_POST["secondpasswordinput"])){
		$secondpassworderror = "Palun sisestage salasõna kaks korda!";  
	  } else {
		  if($_POST["secondpasswordinput"] != $_POST["passwordinput"]){
			  $secondpassworderror = "Sisestatud salasõnad ei olnud ühesugused!";
		  }
	  }
	 	  if(empty($firstnameerror) and empty($lastnameerror) and empty($gendererror ) and empty($emailerror) and empty($passworderror) and empty($secondpassworderror)
	 	  and empty($birthdayerror) and empty($birthmontherror) and empty($birthyearerror) and empty($birthdateerror)){
		$result = signup($firstname, $lastname, $email, $gender, $birthdate, $_POST["passwordinput"]);
		//$notice = "Kõik korras!";
		if($result == "ok"){
			$firstname= "";
			$lastname = "";
			$gender = "";
			$birthdayerror = null;
			$birthmontherror = null;
			$birthyearerror = null;
			$birthdateerror = null;
			$email = null;
			$notice = "Kasutaja loomine õnnestus!";
		} else {
			$notice = "Kahjuks tekkis tehniline viga: " .$result;
		}
	  }
  }
?>

<html lang="et">
<head>
<meta charset="utf-8">
</head>
<body>
	 <img src="../b2nner/vp_banner.png" alt ="Veebiprogrammerimise kursuse 
  bänner">
<form method="POST"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<label for="firstnameinput">Eesnimi</label>
<input type="text" name="firstnameinput" id="firstnameinput" placeholder="Eesnimi" value= "<?php echo $firstname; ?>"<span><?php echo $firstnameerror; ?></span>
<label for="lastnameinput">Perekonnanimi</label>
<input type="text" name="lastnameinput" id="lastnameinput" placeholder="Perekonnanimi"value="<?php echo $lastname; ?>"><span><?php echo $lastnameerror; ?></span>
<input type="radio" name="genderinput" id="gendermale" value="1" <?php if($gender == "1"){		echo " checked";} ?>><label for="gendermaleinput">Mees</label>
<input type="radio" name="genderinput" id="genderfemale" value="2" <?php if($gender == "2"){		echo " checked";} ?>><label for="genderfemaleinput">Naine</label>
<span><?php echo "&nbsp; &nbsp; &nbsp;" .$gendererror; ?></span>
<br>
<br>
	  <label for="birthdayinput">Sünnipäev: </label>
		  <?php
			echo '<select name="birthdayinput" id="birthdayinput">' ."\n";
			echo '<option value="" selected disabled>päev</option>' ."\n";
			for ($i = 1; $i < 32; $i ++){
				echo '<option value="' .$i .'"';
				if ($i == $birthday){
					echo " selected ";
				}
				echo ">" .$i ."</option> \n";
			}
			echo "</select> \n";
		  ?>
	  <label for="birthmonthinput">Sünnikuu: </label>
	  <?php
	    echo '<select name="birthmonthinput" id="birthmonthinput">' ."\n";
		echo '<option value="" selected disabled>kuu</option>' ."\n";
		for ($i = 1; $i < 13; $i ++){
			echo '<option value="' .$i .'"';
			if ($i == $birthmonth){
				echo " selected ";
			}
			echo ">" .$monthnameset[$i - 1] ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <label for="birthyearinput">Sünniaasta: </label>
	  <?php
	    echo '<select name="birthyearinput" id="birthyearinput">' ."\n";
		echo '<option value="" selected disabled>aasta</option>' ."\n";
		for ($i = date("Y") - 15; $i >= date("Y") - 110; $i --){
			echo '<option value="' .$i .'"';
			if ($i == $birthyear){
				echo " selected ";
			}
			echo ">" .$i ."</option> \n";
		}
		echo "</select> \n";
	  ?>
	  <br>
	  <br>
	  <span><?php echo $birthdateerror ." " .$birthdayerror ." " .$birthmontherror ." " .$birthyearerror; ?></span>
<label for="emailinput">Email</label><input type="email" name="emailinput" id="emailinput" placeholder="Email" 
value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
<label for="passwordinput">Parool</label><input type="password" name="passwordinput" id="passwordinput" placeholder="Parool" ><span><?php echo $passworderror; ?></span>
<label for="secondpasswordinput">Parool</label><input type="password" name="secondpasswordinput" id="secondpasswordinput" placeholder="Parool"><span><?php echo $secondpassworderror; ?></span>
<br>
<input type="submit" name="userinfo" value="Salvesta kasutaja info">
</form>
<p>Siit saab tagasi<a href="page.php">pealehele</a>.</p>

</body>
