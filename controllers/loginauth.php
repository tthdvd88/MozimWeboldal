<?php

class Loginauth_Controller
{
	public $baseName = 'loginauth';
	public function main(array $vars)
	{
		$loginauthModel = new Loginauth_Model;

		$retData = $loginauthModel->get_data($vars);
		if($retData['eredmeny'] == "ERROR")
			$this->baseName="login_authlogin";

		$view = new View_Loader($this->baseName.'_main');

		foreach($retData as $name => $value)
		$view->assign($name, $value);
	}
}

?>