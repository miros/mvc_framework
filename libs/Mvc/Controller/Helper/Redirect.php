<?php


class Mvc_Controller_Helper_Redirect extends Mvc_Controller_Helper_Abstract
{
	private $_response = null;

	public function  __construct(Mvc_Response $response)
	{
		$this->_response = $response;
	}

	public function execute($location)
	{
		$this->_response->addHeader('Location', $location);
	}

}
