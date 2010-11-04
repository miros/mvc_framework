<?php

class Mvc_YamlParser
{

	public static function load($file)
	{
		$cacheFileName = sys_get_temp_dir() . DIRECTORY_SEPARATOR . md5($file . filemtime($file)) . '.yaml';

		if (file_exists($cacheFileName)) {
			$data = file_get_contents($cacheFileName);
			return unserialize($data);
		}

		$data = sfYaml::load($file);

		file_put_contents($cacheFileName, serialize($data));
		return $data;
	}

}