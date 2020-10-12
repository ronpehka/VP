<?php
	//var_dump($_POST);
	require("../../../config.php");
	require("salvestus.php");
	require("fnc_general.php");
	//kui on idee sisestatud ja nuppu vajutatud
	//salvestame selle andmebaasi

	$fulltimenow = date("d.M.Y H:i:s");
	$hournow = date("H");
	$partofday = "Lihtsalt aeg";
	if($hournow < 6){
		$partofday = "uneaeg";}//Enne 6
	if($hournow >= 8 and $hournow <=18){
		$partofday = "õppimise aeg";}
	if($hournow >= 18 and $hournow< 22){
		$partofday = "õhtuste tegevuste aeg";
	}
	if($hournow >=22){
		$partofday = "magamamineku aeg";
	
	}
	
	
	//Vaatame semestri kulgemist
	$semesterstart = new DateTime("2020-08-31");
	$semesterend = new DateTime("2020-12-13");
	$semesterduration = $semesterstart->diff($semesterend);
	$semesterdurationdays = $semesterduration ->format("%r%a");
	$today = New DateTime("now");
	$fromsemesterstart = $semesterstart -> diff($today);
	$fromsemesterstartdays = $fromsemesterstart -> format("%r%a");
	$semesterpercentage = 0;
	
	$semesterinfo = "Semester kulgeb vastavalt akadeemilisele kalendrile.";
	  if($semesterstart > $today){
		  $semesterinfo = "Semester pole veel peale hakanud!";
	  }
	  if($fromsemesterstartdays === 0){
		  $semesterinfo = "Semester algab täna!";
	  }
	  if($fromsemesterstartdays > 0 and $fromsemesterstartdays < $semesterdurationdays){
		  $semesterpercentage = ($fromsemesterstartdays / $semesterdurationdays) * 100;
		  $semesterinfo = "Semester on täies hoos, kestab juba " .$fromsemesterstartdays ." päeva, läbitud on " .$semesterpercentage ."%.";
	  }
	  if($fromsemesterstartdays == $semesterdurationdays){
		  $semesterinfo = "Semester lõppeb täna!";
	  }
	  if($fromsemesterstartdays > $semesterdurationdays){
		  $semesterinfo = "Semester on läbi saanud!";
  }
	
	$weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
    $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	$weekdaynow = date("N");
	//echo weekdaynow;
	
	//Loeme piltide kataloogi sisu ja näitame pilte
	$allfiles = array_slice(scandir("../vp_pics/"),2);
	//var_dump($allfiles);
	//$picfiles = array_slice(scandir($allfiles, 2));
	$picfiles = [];
	$picfiletypes = ["image/jpeg","image/png"];
	foreach($allfiles as $thing){
		$fileinfo = getImagesize("../vp_pics/" .$thing);
		if(in_array($fileinfo["mime"], $picfiletypes)){
			array_push($picfiles, $thing);
			
		}
	}
	//paneme koik pildid ekraanile
	//$piccount = count($picfiles);	
	//$imghtml ="";
	//for$i = 0; $i < $piccount; $i++)
		//$imghtml .= '<img src= ../vp_pics/'.$allpicfiles[mt_rand(0, ($piccount-1))] .'" ';
		//$imghtml .= 'alt="Tallinna Ülikool">';

	//annan ette lubatud pildivormide loendi
$email = "";
  
  $emailerror = "";
  $passworderror = "";
  $notice = "";
  if(isset($_POST["submituserdata"])){
	  if (!empty($_POST["emailinput"])){
		//$email = test_input($_POST["emailinput"]);
		$email = filter_var($_POST["emailinput"], FILTER_SANITIZE_EMAIL);
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		} else {
		  $emailerror = "Palun sisesta õige kujuga e-postiaadress!";
		}		
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
	  
	  if(empty($emailerror) and empty($passworderror)){
		  echo "Juhhei!" .$email .$_POST["passwordinput"];
		  $notice = signin($email, $_POST["passwordinput"]);
	  }
  }

require("header.php");
?>
</head>
<body>
  <img src="../b2nner/vp_banner.png" alt ="Veebiprogrammerimise kursuse 
  bänner">
  <h1>Veebirprogrammerimine</h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See leht on tehtud veebiprogrammeerimise kursusel aastal 2020
  <a href="http://www.tlu.ee">Tallinna Ülikooli<a/> Digitehnoloogiate instituudis.</p>
  <p>Lehe avamise hetk: <?php echo "Täna on " .$weekdaynameset[$weekdaynow-1] .", " .$fulltimenow;?>.</p>
  <p><?php echo "Praegu on " .$partofday ."."; ?></p>
  <p><?php echo $semesterinfo; ?></p>
  <hr>
  <?php 	$picnum = rand(0,3);
	if ($picnum == 0){
		echo '<img src ="../vp_pics/tlu_astra_1.jpg">';
}
	if ($picnum == 1){
		echo '<img src ="../vp_pics/tlu_terra_1.jpg">';
}
	if ($picnum == 2){
		echo '<img src ="../vp_pics/tlu_terra_2.jpg">';
}
	if ($picnum == 3){
		echo '<img src ="../vp_pics/tlu_terra_3.jpg">';
} ?>
  <hr>
  <h3>Logi sisse</h3>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="emailinput">E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="emailinput" id="emailinput" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
	  <br>
	  <label for="passwordinput">Salasõna:</label>
	  <br>
	  <input name="passwordinput" id="passwordinput" type="password"><span><?php echo $passworderror; ?></span>
	  <br>
	  <br>
	  <input name="submituserdata" type="submit" value="Logi sisse"><span><?php echo "&nbsp; &nbsp; &nbsp;" .$notice; ?></span>
  </form>
  <hr>
  <p> Loo endale <a href="kasutaja.php"> kasutaja</a>.</p>
</body>
</html>
