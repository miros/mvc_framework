<?php

define('APP_DIR', dirname(__FILE__));
define('TOP_DIR', realpath(APP_DIR . '/..'));
define('LIB_DIR', TOP_DIR . '/libs');
define('PUB_DIR', TOP_DIR . '/public');
define('CONFIG_DIR', TOP_DIR . '/config');

//// legacy code
require_once(PUB_DIR . '/engine/core.inc.php');
////

require_once(LIB_DIR . '/Mvc/Application.php');

AutoLoader::getInstance()->addClassPaths(array(
	APP_DIR,
	APP_DIR . '/domain/persistence',
	APP_DIR . '/domain/'
))->register();

class PoeziaApplication extends Mvc_Application
{

	protected function _getConfigDir()
	{
		return CONFIG_DIR;
	}

	protected function _getBaseDir()
	{
		return TOP_DIR;
	}

	protected function _init($frontController)
	{
		$brocker = $frontController->getHelperBrocker();

		$routeConfig = $this->_getConfigDir() . '/routes.yml';
		$frontController->connect('mvc.start', array(new PluginLoadRoutes($routeConfig), 'execute'));
		$frontController->connect('mvc.start', array(new PluginLoadDoctrine(), 'execute'));

		// example
		//$userHelper = new Helper_User();
		//$frontController->connect('mvc.response.pre', array($userHelper, 'preResponse'));
		//$brocker->addHelper($userHelper);

	}

}
