<?php

class Login_authlogin_Controller
{
	public $baseName = 'login_authlogin'; 
	public function main(array $vars)
	{
		$view = new View_Loader($this->baseName.'_main');
	}
}

?>