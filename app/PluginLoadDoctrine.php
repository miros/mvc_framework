<?php

class PluginLoadDoctrine
{

	public function execute($event)
	{
		require_once(LIB_DIR . '/doctrine/Doctrine.compiled.php');
		//spl_autoload_register(array('Doctrine', 'autoload'));

		$eventContext = $event->getSubject();
		Doctrine_Manager::connection($eventContext->getConfig()->db->dbh);

		$brocker = $eventContext->getHelperBrocker();
		$brocker->addHelper(new Mvc_Controller_Helper_Db());
	}

}