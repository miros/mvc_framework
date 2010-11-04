<?php

class Mvc_Router_YamlLoader
{

	private $_configFile = null;

	public function __construct($configFile)
	{
		$this->_configFile = $configFile;
	}

	public function load(Mvc_Router_Route_Brocker_Interface $brocker)
	{
		$routesData = Mvc_YamlParser::load($this->_configFile);

		foreach($routesData as $name => $routeData) {
			$path = $routeData['path'];
			$params = Mvc_Utils::get($routeData, 'params', array());
			$defaults = Mvc_Utils::get($routeData, 'defaults', array());
			
			$route = $this->_createRoute($path, $params, $defaults);

			$brocker->addRoute($name, $route);
		}
	}

	protected function _createRoute($path, $params, $defaults)
	{
		return new Mvc_Router_Route($path, $params, $defaults);
	}

}
