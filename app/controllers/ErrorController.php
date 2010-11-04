<?php


class NewsCommentsController extends Mvc_Controller_Base
{

	public function error()
	{
		
		$this->_response->setNoRender();
		$this->_response->setOutput($this->_request['exception']->__toString());
		
	}

}