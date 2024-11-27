<?php

class Soapserver_Controller
{
	public $baseName = 'soapserver';
	public function main(array $vars)
	{
		$view = new View_Loader($this->baseName.'_main');
	}
}

?>