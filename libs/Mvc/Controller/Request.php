<?php

class Mvc_Controller_Request implements Mvc_Request_Interface
{

	private $_requestUri = null;

	public function __construct($requestUri = null)
	{
		$this->_requestUri = ($requestUri) ? $requestUri : $_SERVER['REQUEST_URI'];
	}

	public function __get($name)
	{
		if (isset($_POST[$name])) {
			return $_POST[$name];
		}

		if (isset($_GET[$name])) {
			return $_GET[$name];
		}
	}

	private $_controllerName = '';
	private $_actionName = '';

	public function getControllerName()
	{
		return $this->_controllerName;
	}

	public function setControllerName($name)
	{
		$this->_controllerName = $name;
	}

	public function getActionName()
	{
		return $this->_actionName;
	}

	public function setActionName($name)
	{
		$this->_actionName = $name;
	}

	public function isPost()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	public function getCookie($name)
	{
		return $_COOKIE[$name];
	}

	public function getRequestUri()
	{
		return $this->_requestUri;
	}

	private $_params = array();

	public function offsetGet($offset, $value)
	{
		return ($this->offsetExists($offset)) ? $this->_params[$offset] : null;
	}

	public function offsetSet($offset, $value)
	{
		$this->_params[$offset] = $value;
	}

	public function offsetExists($offset)
	{
		return isset($this->_params[$offset]);
	}

	public function offsetUnset($offset)
	{
		unset($this->_params[$offset]);
	}

}
