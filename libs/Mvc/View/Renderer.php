<?php

class Mvc_View_Renderer
{

	public function render(Mvc_Controller_Request $request, Mvc_Response $response)
	{
		if (!$response->shouldRender()) {
			return;
		}

		$view = $this->_getView();

		$context = $this->_getContextFor($request, $response, $view);
		$content = $view->render($context, $response->getVars());

		$response->appendOutput($content);
	}

	private function _getContextFor(Mvc_Controller_Request $request, Mvc_Response $response, $view)
	{
		$controllerName = $request->getControllerName();
		$actionName = $request->getActionName();
		$context = ($response->getContext()) ? $response->getContext() : $view->formatContext($controllerName, $actionName);
		return $context;
	}

	private function _getView()
	{
		return Service_Container::getInstance()->view;
	}

}

