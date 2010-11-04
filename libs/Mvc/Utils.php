<?php


class Mvc_Utils
{

	public static function lcfirst($str)
	{
		return (string)(strtolower(substr($str,0,1)).substr($str,1));
	}

	public static function camelCaseToUnderscore($str)
    {
		$str[0] = strtolower($str[0]);
		$func = create_function('$c', 'return "_" . strtolower($c[1]);');
		return preg_replace_callback('/([A-Z])/', $func, $str);
    }

	public static function startsWith($str, $beginning)
	{
		return stripos($str, $beginning) === 0;
	}

	public static function arrayToObject($data) {

		if (is_array($data)) {
			return (object) array_map(array(self, 'arrayToObject'), $data);
		} else {
			return $data;
		}

	}

	public static function get($array, $key, $default = false) {
		if (!isset($array[$key])) {
			return $default;
		}
		return $array[$key];
	}

}


