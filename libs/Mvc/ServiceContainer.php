<?php

class Service_Container 
{

	private static $_instance = null;

	private function  __construct()	{}

	private function  __clone() {}

	/**
	 *
	 * @return Service_Container
	 */
	public static function getInstance()
	{
		if (!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private $_container = null;

	public function getContainer()
	{
		return $this->_container;
	}

	public function loadContainer($configPath)
	{
		$cacheClassName = 'ServiceContainer' . md5($configPath . filemtime($configPath));
		$cacheFileName = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $cacheClassName . '.php';

		if (file_exists($cacheFileName)) {
			require_once $cacheFileName;
			$this->_container = new $cacheClassName();
			return;
		}

		$this->_container = new sfServiceContainerBuilder();
		$loader = new sfServiceContainerLoaderFileYaml($this->_container);
		$loader->load($configPath);

		$dumper = new sfServiceContainerDumperPhp($this->_container);
		file_put_contents($cacheFileName, $dumper->dump(array('class' => $cacheClassName)));
	}

	public function  __get($name)
	{
		return $this->getContainer()->$name;
	}

}