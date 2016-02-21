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
		/* 各コントローラの共通前処理 */
		parent::_preDispatch();
		$chk	= Auth::loginCheck();
		if ($chk === false) {
			$this->_log->debug('ログインしていません．リダイレクトします．');
			$this->redirect('/');
		}
	}
	/**
	 * 配達者を選択
	 * route --> /customer/deliveryman
	 */
	public function deliverymanAction() {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		
		$customerID	= Auth::getUserID();	// 依頼者
		$params		= $this->getPostList();
		if (count($params) == 0) {
			$this->_log->debug("パラメータがPOSTされていません．画面を表示します．");
			
			$mapper	= new Customer();
			$deliverCustomer	= $mapper->selectDeliveryman($customerID);
			$this->setViewSearchlist($deliverCustomer);
			return ;
		}

		$params['recipientID']	= $customerID;
		$mapper = new Customer();
		$mapper->sendMailToDeliveryman($params);
		return ;
	}
	/**
	 * 入店情報を更新
	 * route --> /customer/status
	 */
	public function statusAction() {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");

		$customerID	= Auth::getUserID();	// 配達者
		$params		= $this->getPostList();
		if (count($params) == 0) {
			$this->_log->debug("パラメータがPOSTされていません．画面を表示します．");
			return ;
		}
		$mapper	= new Customer();
		$deliverCustomer	= $mapper->updateCustomerInfo($customerID, $params);
		
		$this->redirect('/item');
		return ;
	}
	/**
	 * 配達を行うか決める
	 * route --> /customer/deliver
	 */
	public function deliverAction() {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");

		$customerID	= Auth::getUserID();	// 配達者
		$req	= $this->getRequest();
		$requestID	= $req->getUserParam('requestid');
		$indata	= array(
				'requestID'	=> $requestID
		);
		$this->setViewIndata($indata);
		return ;
	}
	/**
	 * 配達情報
	 * route --> /customer/accepted
	 */
	public function acceptedAction() {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");

		$customerID	= Auth::getUserID();	// 配達者
		$params		= $this->getPostList();
		if (count($params) == 0) {
			$this->_log->debug("パラメータがPOSTされていません．");
			return ;
		}
		if ($params['report'] == 1) {
			$this->_log->debug("配達が不許可でした．");
			return ;
		}
		/* 配達を許可した場合（配達者に表示） */
		unset($params['report']);
		$params['deliverymanID']	= $customerID;
		$mapper	= new Customer();
		$itemsInCart	= $mapper->receiveRequest($params);
		$this->setViewSearchlist($itemsInCart);
		
		$indata	= array(
				'requestID'	=> $params['requestID'],
				'address'	=> $mapper->setAddress($params['requestID'])
		);
		$this->setViewIndata($indata);
		
		return ;
	}
	/**
	 * 商品受け取り確認
	 * 決済用バーコードから飛んでくる
	 * route --> /customer/receipt
	 */
	public function receiptAction() {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");

		$params		= $this->getPostList();
		if (count($params) == 0) {
			$this->_log->debug("パラメータがPOSTされていません．画面を表示します．");
			return ;
		}
		$mapper	= new Customer();
		$errFlg	= $mapper->confirmRequest($params);
		if ($errFlg == true) {
			$this->redirect("/customer/receipt");
			return ;
		}
		$this->forward('evaluate','customer','default',array('requestID' => $params['requestID']));

		return ;
	}
	/**
	 * 人物を評価する
	 * route --> /customer/evaluate
	 */
	public function evaluateAction() {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");

		$customerID	= Auth::getUserID();	// 配達者or依頼者
		$params		= $this->getPostList();
		$mapper		= new Customer();
		/* 評価画面をセット */
		if (!array_key_exists('rate',$params)) {
			$this->_log->debug("評価画面をセット．");
			$indata		= $mapper->selectRequestInfo($params['requestID']);
			$indata['customerID']	= $customerID;
			$indata['requestID']	= $params['requestID'];
			$this->setViewIndata($indata);
			$this->_log->debug("リクエスト情報".print_r($indata,true));
			return ;
		}
		/* 相手を評価 */
		$mapper->evaluatePerson($customerID, $params);
		$this->redirect('/item');
		return ;
	}
}