<?php

class Mvc_View
{

	private $_twig = null;

	public function __construct($templatesDir, $cacheDir = null)
	{

		if (!$cacheDir) {
			$cacheDir = rtrim($templatesDir, '/') . '/cache';
		}

		$loader = new Twig_Loader_Filesystem($templatesDir);

		$this->_twig = new Twig_Environment($loader, array(
		  'cache' => $cacheDir,
		));
	}

	public function formatContext($controllerName, $actionName)
	{
		return $controllerName . '.' . $actionName;
	}

	public function render($context, $vars)
	{
		$templateName = Mvc_Utils::camelCaseToUnderscore($context) . '.html';
		$template = $this->_twig->loadTemplate($templateName);
		return $template->render($vars);
	}

}