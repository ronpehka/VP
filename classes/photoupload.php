<?php

	class Photoupload{
		private $photoinput;
		private $photofiletype;
		
		function __construct($photoinput, $filetype){
			$this->photoinput = $photoinput;
			$this->photofiletype = $filetype;
		}
	}
