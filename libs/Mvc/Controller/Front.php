<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller_Front
 *
 * @author admin
 */
class Mvc_Controller_Front
{

	private $_events = array(
		'mvc.init',
		'mvc.start',
		'mvc.routing.pre',
		'mvc.routing',
		'mvc.routing.post',
		'mvc.dispatching.pre',
		'mvc.dispatching',
		'mvc.dispatching.post',
		'mvc.response.pre',
		'mvc.response',
		'mvc.response.post',
		'mvc.finish'
	);

	public function dispatchRequest(Mvc_Controller_Request $request)
	{
		$context = $this->_createContext();
		$context->setRequest($request);

		$events = array(
			'mvc.dispatching.pre',
			'mvc.dispatching',
			'mvc.dispatching.post',
			'mvc.response.pre',
			'mvc.response',
			'mvc.response.post'
		);

		$this->_notifyEvents($events, $context);

		return $context->getResponse();
	}

	private function _notifyEvents(array $events, $context)
	{
		try {
			foreach($events as $eventName) {
				$this->_notifyEvent($eventName, $context);
			}
		} catch(Mvc_Exception $exc) {
			$context->setException($exc);
			$this->_notifyEvent('mvc.error', $context);
		}
	}

	public function dispatch()
	{
		$this->connect('mvc.init', array(new Mvc_Plugin_InitCorePlugins(), 'execute'));

		$context = $this->_createContext();
		$this->_notifyEvents($this->_events, $context);
		return $context->getResponse();
	}

	public function connect($eventName, $callable)
	{
		$this->getEventDispatcher()->connect($eventName, $callable);
	}

	protected function _notifyEvent($eventName, Mvc_EventContext $context)
	{
		$event = new sfEvent($context, $eventName);
		$this->getEventDispatcher()->notify($event);
	}

	private function _createContext()
	{
		$context = Service_Container::getInstance()->eventContext;
		$context->setFrontController($this);
		return $context;
	}

	public function getEventDispatcher()
	{
		return  Service_Container::getInstance()->eventDispatcher;
	}

	public function getHelperBrocker()
	{
		return  Service_Container::getInstance()->helperBrocker;
	}


}

