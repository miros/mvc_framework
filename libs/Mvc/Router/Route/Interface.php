<?php

interface Mvc_Router_Route_Interface
{

	public function test($url);
	public function assemble(array $params = array());

}