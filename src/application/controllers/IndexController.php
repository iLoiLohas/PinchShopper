<?php
require_once 'controllers/Abstract.php';
require_once 'models/Index.php';

/**
 * IndexController
 * @author iLoiLohas
 */
class
	IndexController
extends
	ControllerAbstract
{

	public function init()
	{
		$this->_loginit(get_class($this));
	}
	public function preDispatch() {
		/* 各コントローラの共通前処理 */
		parent::_preDispatch();
	}
	/**
	 * ログイン処理
	 * route --> /customer
	 */
	public function indexAction() {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		$chk	= Auth::loginCheck();
		if ($chk != false) {
			$this->_log->debug('ログインしています．');
			$this->redirect('/item');
			return ;
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
		
		$mapper	= new Index();
		$result	= $mapper->login($params);
		if ($result === true) {
			$this->_log->debug("ログイン失敗．");
			return ;
		}

		$this->redirect('/item');
	}
}