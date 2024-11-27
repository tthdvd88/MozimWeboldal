<?php

class Restserver_Controller
{
	public $baseName = 'restserver';
	public function main(array $vars)
	{
		$view = new View_Loader($this->baseName.'_main');
	}
}

?>