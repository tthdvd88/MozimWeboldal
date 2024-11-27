<?php

class Mozimusor_Controller
{
	public $baseName = 'fooldal_mozimusor'; 
	public function main(array $vars) 
	{
		$view = new View_Loader($this->baseName.'_main');
	}
}

?>