<?php
require_once 'models/Abstract.php';
require_once 'common/db/db.php';

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
		
		if (count($customer) != 1) {
			$this->_log->error('ログインユーザが存在しない or 複数人存在します．');
			$errFlg = true;
		} else {
			$this->_log->debug('ログインユーザが存在しました．');
			Auth::setAuth($customer[0]);
		}
		return $errFlg;
	}
	/**
	 * 顧客情報更新
	 * @param $params
	 */
	public function updateCustomerInfo($id, $params) {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		
		$db	= Common::getMaster();
		$this->_begin($db);
		try {
			$mCustomer	= new TCustomer($db);
			$mCustomer->updateRecord($id, $params);
			$this->_commit();
			
		} catch (Exception $e) {
			$this->_rollBack();
			throw $e;
		}
		
		return ;
	}
}