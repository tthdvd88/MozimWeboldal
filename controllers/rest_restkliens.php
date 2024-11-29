<?php

class Rest_restkliens_Controller
{
	public $baseName = 'rest_restkliens';
	public function main(array $vars) 
	{
		$view = new View_Loader($this->baseName.'_main');
	}
}

?>