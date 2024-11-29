<?php

class Rest_restserver_Controller
{
	public $baseName = 'rest_restserver';
	public function main(array $vars) 
	{
		$view = new View_Loader($this->baseName.'_main');
	}
}

?>