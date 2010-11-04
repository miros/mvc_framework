<?php

require_once "app/bootstrap.php";

Mvc_Application::load();

testRoute();

function testRoute()
{

	$route = new Mvc_Router_Route('/poem/<id>', array(
		'id' => '\d+'
	), array(
		'controller' => 'testController',
		'action' => 'testAction'
	));

	$params = $route->test('/poem/1249');

	print_r($params);

}



