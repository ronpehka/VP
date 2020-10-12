<?php
	//var_dump($_POST);
	require("../../../config.php");
	require("usesession.php");
	//paneme koik pildid ekraanile
	//$piccount = count($picfiles);	
	//$imghtml ="";
	//for$i = 0; $i < $piccount; $i++)
		//$imghtml .= '<img src= ../vp_pics/'.$allpicfiles[mt_rand(0, ($piccount-1))] .'" ';
		//$imghtml .= 'alt="Tallinna Ülikool">';

	//annan ette lubatud pildivormide loendi
	require ("header.php");
	
?>
	
<body>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <p><a href="?logout=1">Logi välja</a>!</p>
  <p>Pane oma<a href="mote.php"> mõtted</a> kirja sellel lehel.</p>
  <p>Loe oma<a href="ideed.php"> mõtteid</a> sellel lehel.</p>
  <p>Siin on <a href="filmid.php"> filmid</a>.</p>
  <p>Siin  <a href="addfilm.php"> filme</a> lisada.</p>
  <p>Loo <a href="profile.php">profiil</a>.</p>
  <p> Loo endale <a href="kasutaja.php"> kasutaja</a>.</p>
</body>
</html>
