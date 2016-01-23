<?php
require_once 'controllers/Abstract.php';
require_once 'models/Customer.php';

/**
 * CustomerController
 * @author iLoiLohas
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
		parent::_preDispatch();
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
	/**
	 * 配達者を選択
	 * route --> /customer/deliveryman
	 */
	public function deliverymanAction() {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		
		$customerID	= Auth::getUserID();
		$params		= $this->getPostList();
		if (count($params) == 0) {
			$this->_log->debug("パラメータがPOSTされていません．画面を表示します．");
			
			$mapper	= new Customer();
			$deliverCustomer	= $mapper->selectDeliveryman($customerID);
			$this->_log->debug("配達者：".print_r($deliverCustomer,true));
			$this->setViewSearchlist($deliverCustomer);
			return ;
		}
		
		$mapper = new Customer();
		$mapper->sendMailToDeliveryman();
		return ;
	}
	/**
	 * 入店情報を更新
	 * route --> /customer/status
	 */
	public function statusAction() {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");

		$customerID	= Auth::getUserID();
		$params		= $this->getPostList();
		if (count($params) == 0) {
			$this->_log->debug("パラメータがPOSTされていません．画面を表示します．");
			return ;
		}
		$mapper	= new Customer();
		$deliverCustomer	= $mapper->updateCustomerInfo($customerID, $params);
		
		$this->setViewSearchlist($deliverCustomer);
		
		return ;
	}
	/**
	 * 配達を行うか決める
	 * route --> /customer/deliver
	 */
	public function deliverAction() {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");

		$customerID	= Auth::getUserID();
		$params		= $this->getPostList();
		if (count($params) == 0) {
			$this->_log->debug("パラメータがPOSTされていません．画面を表示します．");
			return ;
		}
		if ($params['report'] == 1) {
			$this->_log->debug("配達が不許可でした．");
			return ;
		}
		unset($params['report']);
		$params['deliverymanID']	= $customerID;
		$mapper	= new Customer();
		$mapper->receiveRequest($params);
		
		return ;
	}
	/**
	 * 人物を評価する
	 * route --> /customer/evaluate
	 */
	public function evaluateAction() {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");

		$customerID	= Auth::getUserID();
		$params		= $this->getPostList();
		if (count($params) == 0) {
			$this->_log->debug("パラメータがPOSTされていません．画面を表示します．");
			return ;
		}
		
		return ;
	}
}