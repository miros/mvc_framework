<?php


class Mvc_Plugin_InitDefaultHelpers
{

	public function execute(sfEvent $event)
	{
		$eventContext = $event->getSubject();
		
		$dispatcher = $eventContext->getEventDispatcher();
		$brocker = $eventContext->getHelperBrocker();

		$flashMessageHelper = new Mvc_Controller_Helper_FlashMessage();
		$dispatcher->connect('mvc.response.pre', array($flashMessageHelper, 'preResponse'));
		$brocker->addHelper($flashMessageHelper);

		$brocker->addHelper(new Mvc_Controller_Helper_Redirect($eventContext->getResponse()));
		$brocker->addHelper(new Mvc_Controller_Helper_Db());
		$brocker->addHelper(new Mvc_Controller_Helper_Dispatch($eventContext->getFrontController()));

		$this->_addViewHelpers($brocker, $eventContext);
	}

	protected function _addViewHelpers($brocker, $eventContext)
	{
		$eventContext->getResponse()->assign('HELPER', $brocker, 'helper');

		$brocker->addHelper(new Mvc_View_Helper_Url($eventContext->getRouter()));
	}

}
