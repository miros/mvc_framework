<?php


class Mvc_Controller_Helper_Db extends Mvc_Controller_Helper_Abstract
{
	public function execute($table)
	{
		return Doctrine_Core::getTable($table);
	}

}
