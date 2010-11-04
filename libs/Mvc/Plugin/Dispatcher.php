<?php


class Mvc_Plugin_Dispatcher
{

	public function execute(sfEvent $event)
	{
		$eventContext = $event->getSubject();
		$eventContext->getDispatcher()->dispatch($eventContext);
	}

}
