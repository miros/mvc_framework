<?php

class Mvc_Controller_Dispatcher
{

	private $_controllersPath = '';

	public function  __construct($controllersPath)
	{
		$this->_controllersPath = $controllersPath;
	}

	public function dispatch(Mvc_EventContext $eventContext)
	{
		$controller = $this->_createController($eventContext);
		$response = $controller->execute();

		return $response;
	}

	protected function _createController(Mvc_EventContext $eventContext)
	{
		$controllerName = $eventContext->getRequest()->getControllerName() . 'Controller';
		$helperBroker = Service_Container::getInstance()->helperBrocker;
		require_once $this->_controllersPath . DIRECTORY_SEPARATOR . $controllerName . '.php';
		return new $controllerName($eventContext, $helperBroker);
	}

}
