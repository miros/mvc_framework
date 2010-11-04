<?php


class Mvc_Plugin_InitCorePlugins
{

	public function execute(sfEvent $event)
	{
		$dispatcher = $event->getSubject()->getEventDispatcher();

		$dispatcher->connect('mvc.routing', array(new Mvc_Plugin_Router(), 'execute'));
		$dispatcher->connect('mvc.dispatching', array(new Mvc_Plugin_Dispatcher(), 'execute'));
		$dispatcher->connect('mvc.response', array(new Mvc_Plugin_ViewRenderer(), 'execute'));

		$dispatcher->connect('mvc.start', array(new Mvc_Plugin_InitDefaultHelpers(), 'execute'));

		$dispatcher->connect('mvc.error', array(new Mvc_Plugin_Error(), 'execute'));
	}

}
