<?php
	//var_dump($_POST);
	require("../../../config.php");
	
	//kui on idee sisestatud ja nuppu vajutatud
	//salvestame selle andmebaasi

	$username = "Rono Pehka";
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
		//$imghtml .= '<img src= ../vp_pics/'.$picfiles[$i] .'" ';
		//$imghtml .= 'alt="Tallinna Ülikool">';

	//annan ette lubatud pildivormide loendi
	require ("header.php");
	
?>
	
<body>
  <img src="../b2nner/vp_banner.png" alt ="Veebiprogrammerimise kursuse 
  bänner">
  <h1><?php echo $username; ?></h1>
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
  <p>Pane oma<a href="mote.php"> mõtted</a> kirja sellel lehel.</p>
  <p>Loe oma<a href="ideed.php"> mõtteid</a> sellel lehel.</p>
</body>
</html>
