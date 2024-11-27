<?php

class Soapkliens_Controller
{
	public $baseName = 'soapkliens';
	public function main(array $vars)
	{
		$view = new View_Loader($this->baseName.'_main');
	}
}

?>