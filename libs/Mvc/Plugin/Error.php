<?php


class Mvc_Plugin_Router
{

	public function execute(sfEvent $event)
	{
		$eventContext = $event->getSubject();

		$config = $eventContext->getConfig()->errors;

		if (isset($config->errors)) {
			return;
		}

		$exception = $eventContext->getException();
		$type = end(explode('_', get_class($exception)));

		if (isset($config->$type)) {
			$type = 'default';
		}

		$controllerName = $config->$type->controller;
		$actionName = $config->$type->action;

		$request = Service_Container::getInstance()->request;
		$request->setControllerName($controllerName);
		$request->setActionName($actionName);
		$request['exception'] = $exception;

		$eventContext->getFrontController($request);
	}

}
