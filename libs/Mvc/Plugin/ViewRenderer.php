<?php


class Mvc_Plugin_ViewRenderer
{

	public function execute(sfEvent $event)
	{
		$eventContext = $event->getSubject();
		$eventContext->getViewRenderer()->render($eventContext->getRequest(), $eventContext->getResponse());
	}

}
