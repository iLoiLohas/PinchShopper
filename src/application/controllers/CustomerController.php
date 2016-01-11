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
	public function preDispatch() {
	}
	/**
	 * ログイン処理
	 * route --> /customer
	 */
	public function loginAction() {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		$chk	= Auth::loginCheck();
		if ($chk != false) {
			$this->_log->debug('ログインしています．');
			$this->redirect('/item');
		}
		
		/** セッション情報が無い場合 **/
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
		if ($result === true) {
			$this->_log->debug("ログイン失敗．");
			return ;
		}
		
		$this->redirect('/item');
	}
}