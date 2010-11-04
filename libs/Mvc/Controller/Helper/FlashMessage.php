<?php


class Mvc_Controller_Helper_FlashMessage extends Mvc_Controller_Helper_Abstract
{

	public function  __construct()
	{
		if(!isset($_SESSION)) {
			session_start();
		}
	}

	public function execute($msg = null)
	{
		if ($msg === null) {
			return $this;
		}

		$this->setMessage($msg);
	}

	private $_messageSet = false;

	public function preResponse($event)
	{
		$event->getSubject()->getResponse()->assign('FLASH_MESSAGE', $this->getFlashMessage(), 'helper');
	}

	const MESSAGE_KEY = 'flashMessage';

	/**
	 * @param string $msg
	 */
	protected function setMessage($msg)
	{
		$_SESSION[self::MESSAGE_KEY] = $msg;
		$this->_messageSet = true;
	}

	/**
	 * @param string $msg
	 */
	protected function getFlashMessage()
	{
		$message = isset($_SESSION[self::MESSAGE_KEY]) ? $_SESSION[self::MESSAGE_KEY] : false;
		
		if (!$this->_messageSet) {
			$_SESSION[self::MESSAGE_KEY] = '';
		}
		
		return $message;
	}

}
