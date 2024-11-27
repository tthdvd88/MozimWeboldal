<?php

class Fooldal_Controller
{
	public $baseName = 'fooldal'; 
	public function main(array $vars) 
	{
		//bet�ltj�k a n�zetet
		$view = new View_Loader($this->baseName."_main");
	}
}

?>