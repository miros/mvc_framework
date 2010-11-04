<?php

class Mvc_EventContext
{

	private $_request = null;
	private $_response = null;
	private $_frontController = null;

	private $_exception = null;

	public function getFrontController()
	{
		return $this->_frontController;
	}

	public function setFrontController(Mvc_Controller_Front $frontController)
	{
		$this->_frontController = $frontController;
	}

	public function getRequest()
	{
		if ($this->_request === null) {
			$this->_request = $this->getServiceContainer()->request;
		}
		return $this->_request;
	}

	public function setRequest(Mvc_Controller_Request $request)
	{
		return $this->_request = $request;
	}

	public function getResponse()
	{
		if ($this->_response === null) {
			$this->_response = $this->getServiceContainer()->response;
		}
		return $this->_response;
	}

	public function getRouter()
	{
		return  $this->getServiceContainer()->router;
	}

	public function getDispatcher()
	{
		return $this->getServiceContainer()->dispatcher;
	}

	public function getViewRenderer()
	{
		return $this->getServiceContainer()->renderer;
	}

	/**
	 *
	 * @return sfEventDispatcher
	 */
	public function getEventDispatcher()
	{
		return $this->getServiceContainer()->eventDispatcher;
	}

	public function getHelperBrocker()
	{
		return $this->getServiceContainer()->helperBrocker;
	}

	public function getConfig()
	{
		return $this->getServiceContainer()->config;
	}

	public function getServiceContainer()
	{
		return Service_Container::getInstance();
	}

	public function setException($exception)
	{
		$this->_exception = $exception;
	}

	public function getException($exception)
	{
		return $this->_exception;
	}

}
