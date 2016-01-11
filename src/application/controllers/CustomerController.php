<?php
require_once 'controllers/Abstract.php';
require_once 'models/Customer.php';

/**
 * CustomerController
 * @author iLoiLohas
 *
 */
class
	CustomerController
extends
	ControllerAbstract
{

	public function init()
	{
		$this->_loginit(get_class($this));
	}

	public function loginAction()
	{
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		$params		= $this->getPostList();
		if (count($params) == 0) {
			$this->_log->debug("パラメータがPOSTされていません．");
			return ;
		}
		
		$chechItem	= array(
				"email"		=> "NotNull",
				"password"	=> "NotNull"
		);
		
		$mapper	= new Customer();
		$result	= $mapper->login($params);
		if ($result) {
			$this->_log->debug("ログイン失敗．");
			return ;
		}
		
		$this->_redirect('/item');
	}
}