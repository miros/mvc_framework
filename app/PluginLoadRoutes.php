<?php

class PluginLoadRoutes
{

	private $_configFile = '';

	public function __construct($config)
	{
		$this->_configFile = $config;
	}

	public function execute($event)
	{
		$eventContext = $event->getSubject();

		$loader = new Mvc_Router_YamlLoader($this->_configFile);
		$loader->load($eventContext->getRouter());

	}

}

