<?php

class Mvc_Controller_Helper_Dispatch extends Mvc_Controller_Helper_Abstract
{
	/**
	 *
	 * @var Mvc_Controller_Front
	 */
	private $_frontController = null;

	public function  __construct(Mvc_Controller_Front $frontController)
	{
		$this->_frontController = $frontController;
	}

	public function execute($location)
	{
		list($controllerName, $actionName) = explode('.', $location);

		$request = Service_Container::getInstance()->request;
		$request->setControllerName($controllerName);
		$request->setActionName($actionName);

		$response = $this->_frontController->dispatchRequest($request);
		return $response;
	}

}
