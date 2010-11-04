<?php

class Mvc_Helper_Brocker
{

	private $_helpers;

	public function executeHelper($name, $arguments)
	{
		if (!$this->hasHelper($name)) {
			throw new Exception("Helper $name was not found!");
		}

		$helper = $this->getHelper($name);
		return call_user_func_array(array($helper, 'execute'), $arguments);
	}

	public function hasHelper($name)
	{
		return array_key_exists($name, $this->_helpers);
	}

	public function getHelper($name)
	{
		return $this->_helpers[$name];
	}

	public function addHelper(Mvc_Helper_Interface $helper)
	{
		$name = $this->_findHelperName($helper);
		$this->_helpers[$name] = $helper;
	}

	protected function _findHelperName($helper) {
		$helperClass = get_class($helper);
		return Mvc_Utils::lcfirst(end(explode('_', $helperClass)));
	}

	public function __call($name,  $arguments) {
		$this->executeHelper($name, $arguments);
	}

}
?>
