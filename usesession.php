<?php
	//kui on idee sisestatud ja nuppu vajutatud
	//salvestame selle andmebaasi
	//kas on sisse loginud
	session_start();
	if(!isset($_SESSION["userid"])){
		header("Location: page.php");
		exit();
	}
	//$username = "Rono Pehka";
	if(isset($_GET["logout"])){
		//lõpetame sessiooni
		session_destroy();
		header("Location: page.php");
		exit();
	}
?>
