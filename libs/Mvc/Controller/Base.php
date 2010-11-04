<?php

class Mvc_Controller_Base
{

	/**
	 * @var Mvc_Controller_Request
	 */
	protected $_request = null;
	/**
	 * @var Mvc_Response 
	 */
	protected $_response = null;
	/**
	 * @var Mvc_EventContext
	 */
	private $_eventContext = null;

	public function __construct(Mvc_EventContext $eventContext)
	{
		$this->_eventContext = $eventContext;
		$this->_request = $eventContext->getRequest();
		$this->_response = $eventContext->getResponse();
	}

	public function execute()
	{
		call_user_func(array($this, $this->_request->getActionName()));
		return $this->_response;
	}

	public function getEventContext()
	{
		return $this->_eventContext;
	}


	public function  __call($name,  $arguments)
	{
		$brocker = $this->getEventContext()->getHelperBrocker();
		return $brocker->executeHelper(trim($name, '_'), $arguments);
	}


}