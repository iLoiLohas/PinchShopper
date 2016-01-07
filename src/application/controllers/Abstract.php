<?php
abstract class
	ControllerAbstract
extends
	Zend_Controller_Action
{
	protected $_log				= null;

	/**
	 *
	 * ログ初期化.
	 * @return Logger
	 */
	protected function _loginit($classname) {
		$log		= Zend_Registry::get('logger');
		$this->_log	= $log::getLogger($classname);
		return	$this->_log;
	}
	
}