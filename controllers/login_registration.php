<?php

class Login_registration_Controller
{
	public $baseName = 'login_registration';
	public function main(array $vars)
	{
		$view = new View_Loader($this->baseName.'_main');
	}
}

?>