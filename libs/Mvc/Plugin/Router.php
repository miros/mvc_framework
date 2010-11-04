<?php


class Mvc_Plugin_Router
{

	public function execute(sfEvent $event)
	{
		$eventContext = $event->getSubject();
		$eventContext->getRouter()->route($eventContext->getRequest());
	}

}
