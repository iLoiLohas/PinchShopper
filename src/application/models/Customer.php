<?php
require_once 'models/Abstract.php';
require_once 'common/db/TCustomer.php';

class
	Customer
extends
	ModelAbstract
{
	/**
	 *
	 * 初期処理
	 */
	public function __construct() {
		$this->_loginit(get_class($this));
	}
	/**
	 * ログイン
	 * @param $params
	 */
	public function login($params) {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		$errFlg		= false;
		
		$db	= Common::getMaster();
		$mCustomer	= new TCustomer($db);
		$select		= $mCustomer->select();
		$select->where('email = ?',$params['email']);
		$customer	= $mCustomer->fetchAll($select)->toArray();
		
		if (count($customer) == 0) {
			$this->_log->error('ログインユーザが存在しません．');
			$errFlg = true;
		} else {
			$this->_log->debug('ログインユーザが存在しました．');
			Auth::setAuth($customer);
		}
		return $errFlg;
	}
}