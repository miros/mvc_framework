<?php


class Mvc_Config
{

	private $_config;

	public function  __construct($file)
	{
		$config =  Mvc_YamlParser::load($file);
		$this->_config = Mvc_Utils::arrayToObject($config);
	}

	public function __get($name)
	{
		return $this->_config->$name;
	}

}

