<?php

class Mvc_Router_HttpRouter implements Mvc_Router_Interface, Mvc_Router_Route_Brocker_Interface
{

	private $_routes = array();

	private $_defaultController = 'index';
	private $_defaultAction = 'index';

	public function route(Mvc_Request_Interface $request) {

		$requestUri = $request->getRequestUri();

		foreach($this->_routes as $route) {

			$result = $route->test($requestUri);

			if ($result !== false) {
				$request->setControllerName(Mvc_Utils::get($result, 'controller', $this->_defaultController));
				$request->setActionName(Mvc_Utils::get($result, 'action', $this->_defaultAction));
				return true;
			}

		}

		throw new Mvc_Exception_404("No route for url: $requestUri");

		return false;
	}

	public function addRoute($name, Mvc_Router_Route_Interface $route)
	{
		$this->_routes[$name] = $route;
	}

	public function hasRoute($name)
	{
		return isset($this->_routes[$name]);
	}

	public function assemble($name, array $params = array())
	{
		return $this->_routes[$name]->assemble($params);
	}



}
