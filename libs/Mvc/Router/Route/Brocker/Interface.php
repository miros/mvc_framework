<?php

interface Mvc_Router_Route_Brocker_Interface
{

	public function addRoute($name, Mvc_Router_Route_Interface $route);
	public function hasRoute($name);
	public function assemble($name, array $params = array());

}
