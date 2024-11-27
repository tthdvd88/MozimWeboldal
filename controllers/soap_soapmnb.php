<?php

class Soapmnb_Controller
{
	public $baseName = 'soapmnb';
	public function main(array $vars)
	{
		$view = new View_Loader($this->baseName.'_main');
	}
}

?>