<?php

class AutoLoader
{

	private static $_instance = null;

	protected function  __construct() {}
	protected function  __clone() {}

	/**
	 * @return AutoLoader
	 */
	public static function getInstance()
	{
		if (!self::$_instance) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function register()
	{
		spl_autoload_register(array($this, 'loadClass'));
	}

	const CLASS_EXTENSION = 'php';

	public function loadClass($className)
	{
		if (class_exists($class_name, false) || interface_exists($class_name, false)) {
			return true;
		}

		$fileName = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.' . self::CLASS_EXTENSION;

		foreach($this->_prefixes as $prefix => $path) {
			if (Mvc_Utils::startsWith($className, $prefix)) {
				require $path . DIRECTORY_SEPARATOR . $fileName;
				return true;
			}
		}

		foreach($this->_paths as $path) {
			$name = $path . DIRECTORY_SEPARATOR . $fileName;
			if (file_exists($name)) {
				require $name;
				return true;
			}
		}

		return false;
	}

	private $_paths = array();
	private $_prefixes = array();

	public function debug()
	{
		print_r($this->_paths);
		print_r($this->_prefixes);
	}

	public function addClassPath($path)
	{
		$this->_paths[] = realpath($path);
		return $this;
	}

	public function addClassPrefix($prefix, $path)
	{
		$this->_prefixes[$prefix] = realpath($path);
		return $this;
	}

	public function addClassPaths(array $paths)
	{
		foreach($paths as $path) {
			$this->addClassPath($path);
		}

		return $this;
	}

	public function setClassPaths(array $paths)
	{
		$this->_paths = array();
		$this->addClassPaths($paths);
	}

}

