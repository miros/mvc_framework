<?php
class NewsController extends Mvc_Controller_Base
{

	public function show()
	{
		$this->_response->news = $this->_db('News')->find($this->_request->sid);
	}

}
