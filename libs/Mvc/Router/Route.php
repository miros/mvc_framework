<?php


class Mvc_Router_Route implements Mvc_Router_Route_Interface
{

	private $_path = '';
	private $_regExps = '';
	private $_defaults = '';

	private $_defaultRegExp = '[a-zA-Z0-9_]+';

	public function  __construct($path, $regExps = array(), $defaults = array())
	{
		$this->_path = rtrim($path, '/');
		$this->_regExps = $regExps;
		$this->_defaults = $defaults;
	}

	private function _getPathRegExp()
	{
		return preg_replace_callback("%<(.+?)>%", array($this, '_replaceParameterWithRegExp'), $this->_path);
	}


	/**
	 *	This function is public because it is callback
	 * @param <type> $matches
	 * @return <type>
	 */
	public function _replaceParameterWithRegExp($matches)
	{
		$paramName = $matches[1];
		$regExp = $this->_getRegExpForParam($paramName);
		return "(?P<$paramName>$regExp)";
	}

	private function _getRegExpForParam($name)
	{
		$regExp = Mvc_Utils::get($this->_regExps, $name, $this->_defaultRegExp);
		return $regExp;
	}

	public function test($url)
	{
		$url = rtrim($url, '/');

		$regExp = $this->_getPathRegExp();
		$matches = array();

		if (preg_match("%$regExp%", $url, $matches) === 0) {
			return false;
		}

		$params = $this->_defaults;

		foreach($matches as $key => $value) {
			if(!is_numeric($key)){
				$params[$key] = $value;
			}
		}

		return $params;

	}

	public function assemble(array $params = array())
	{
		$url = $this->_path;

		foreach($params as $paramName => $paramValue) {
			$url = str_replace("<$paramName>", $paramValue, $url);
		}

		return $url;
	}

}