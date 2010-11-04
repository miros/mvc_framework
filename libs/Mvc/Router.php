<?php

/**
 * Description of Router
 *
 * @author admin
 */
class Mvc_Router implements Mvc_Router_Interface
{
    
	public function route(Mvc_Request_Interface $request)
	{
		$controllerName = $_GET['controller'];
		$request->setControllerName($controllerName);

		$actionName = $_GET['action'];
		$request->setActionName($actionName);
	}

}