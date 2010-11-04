<?php


class Mvc_View_Helper_Url implements Mvc_Helper_Interface
{

	private $_router = null;

	public function __consctruct($router)
	{
		$this->_router = $router;
	}


	public function execute($routeName, array $params = array())
	{
		return $this->_router->assemble($routeName, $params);
	}
	
}