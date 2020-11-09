<?php

	class First{
	//muutujad, klassis omadused (properties)
	private $mybusiness;
	public $everybodysbusiness;
	
	function __construct($limit){
		$this->mybusiness = mt_rand(0,$limit);
		$this->everybodysbusiness = mt_rand(0,$limit);
		echo "arvude korrutis on: " .$this->mybusiness * $this->everybodysbusiness;
	}//construct loppeb
	function __destruct(){
		echo "nägite hunniku lampi infi!";
	}
	private function tellSecret(){
		echo " saladusi võib rääkida!";
	}
	public function tellMe(){
		echo " salajane arv on: " .$this->mybusiness;
	//funktsioonid, klassis meetodid (methods
}
		
} //klass lõppeb
