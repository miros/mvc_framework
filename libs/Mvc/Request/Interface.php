<?php

interface Mvc_Request_Interface extends ArrayAccess
{

	public function getControllerName();
	public function setControllerName($name);
	public function getActionName();
	public function setActionName($name);
	public function getRequestUri();

}