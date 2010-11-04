<?php

require_once(Mvc_Application::getMvcDir() . DIRECTORY_SEPARATOR . 'Utils.php');
require_once(Mvc_Application::getMvcDir() . DIRECTORY_SEPARATOR . 'AutoLoader.php');
require_once(Mvc_Application::getMvcDir() . DIRECTORY_SEPARATOR . 'ServiceContainer.php');

abstract class Mvc_Application
{

	abstract protected function _getConfigDir();
	abstract protected function _getBaseDir();
	protected function _init($frontController) {}

	private static $_mvcDir = null;

	public static function getMvcDir()
	{
		if (self::$_mvcDir === null) {
			self::$_mvcDir = dirname(__FILE__);
		}
		return self::$_mvcDir;
	}

	public function start()
	{
		$this->_loadServiceContainer();

		$frontController = new Mvc_Controller_Front();

		$this->_init($frontController);

		$responseObject = $frontController->dispatch();
		$this->_finish($responseObject);
	}

	protected function _finish($responseObject)
	{
		$responseObject->echoOutput();
	}

	protected function _loadServiceContainer()
	{
		$serviceContainer = Service_Container::getInstance();
		$serviceContainer->loadContainer($this->_getConfigDir() . '/services.yml');
		$serviceContainer->getContainer()->addParameters(array('path' => $this->_getBaseDir()));
	}

	static public function load()
	{
		$autoloader = AutoLoader::getInstance();
		$autoloader->addClassPrefix('Twig', self::getMvcDir() . '/vendor');
		$autoloader->addClassPrefix('sfService', self::getMvcDir() . '/vendor/sfServiceContainer');
		$autoloader->addClassPrefix('Mvc', self::getMvcDir() . '/..');

		require_once(self::getMvcDir() . '/vendor/sfYaml/sfYaml.php');
		require_once(self::getMvcDir() . '/vendor/sfEvent/sfEventDispatcher.php');
	}


}

Mvc_Application::load();