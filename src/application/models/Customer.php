<?php
require_once 'models/Abstract.php';
require_once 'common/db/db.php';
require_once 'common/enum/Status.php';
require_once 'common/SesSendEmail.php';

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
	/**
	 * 配達可能な人を選択する
	 * 現在はstatusが「店舗にいる」or「店舗に向かっている」だけでフィルターをかけている
	 * todo 配達者の候補として自分を選択肢から外す
	 * @param $id
	 */
	public function selectDeliveryman($id) {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		
		$db	= Common::getMaster();
		$mCustomer	= new TCustomer($db);
		$select	= $mCustomer->select();
		$select->where('status = ?',customerStatus::In)
				->orWhere('status = ?',customerStatus::Going);
//				->orWhere('customerID != ?', $id);
		$deliverCustomer	= $mCustomer->fetchAll($select)->toArray();
		
		return $deliverCustomer;
	}
	/**
	 * 配達者へ依頼のメールを送る
	 */
	public function sendMailToDeliveryman() {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		
		$config		= Zend_Registry::get('vendor');
		$awsConfig	= $config['amazon'];
		
		$sendMail	= new SesSendEmail($awsConfig['key'], $awsConfig['secret']);
		$result		= $sendMail->sendEmail('naoto_nishizaka@hotmail.com', 'naoto.nishizaka@gmail.com', 'テストメール', 'テストメールの内容');
		$this->_log->debug("メール送信結果:".print_r($result,true));
	}
	public function receiveRequest($params) {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		
		$db	 = Common::getMaster();
		$this->_begin($db);
		try {
			$mRequest	= new TRequest($db);
			$insertResult	= $mRequest->insertRecord($params);
			$this->_commit();
			
		} catch (Exception $e) {
			$this->_rollBack();
			throw $e;
		}
	}
}