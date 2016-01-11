<?php
require_once 'common/Auth.php';

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
	/**
	 * POSTリクエストを取得．
	 * @return array
	 */
	public function getPostList() {
		$req	= $this->getRequest();
		$list	= array();
		if (!$req->isPost()) {
			return $list;
		}
		$list	= $req->getParams();
		return $list;
	}
	/**
	 * viewの$indataへ書き込む．
	 */
	public function setViewIndata($var) {
		$this->view->indata		= $var;
	}
	/**
	 * viewの$serachlistへ書き込む．
	 */
	public function setViewSearchlist($var) {
		$this->view->searchlist		= $var;
	}
}