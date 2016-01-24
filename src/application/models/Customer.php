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
	 * 配達情報を登録し，配達者へ依頼のメールを送る
	 * @todo メールを送る際，DB上の顧客情報から送る．
	 * @throws Exception
	 */
	public function sendMailToDeliveryman($params) {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		$this->_log->debug("mapperに渡した引数：".print_r($params,true));
		
		$db	 = Common::getMaster();
		$this->_begin($db);
		try {
			$mRequest	= new TRequest($db);
			$insertResult	= $mRequest->insertRecord($params);
			$this->_commit();
			
			$mCustomer	= new TCustomer($db);
			foreach ($params['customerID'] as $customerID) {
				$customerInfo	= $mCustomer->findRecord($customerID);
				$this->_sendMail('naoto.nishizaka@gmail.com', 'naoto.nishizaka@gmail.com', 'テストメール', 'http://l.pinchshopper.jp/customer/deliver/'.$insertResult['requestID']);		// テスト用
			}
				
		} catch (Exception $e) {
			$this->_rollBack();
			throw $e;
		}
		
	}
	/**
	 * 配達者が依頼を許可する．依頼者の配達情報を返す．
	 * @param $params
	 * @throws Exception
	 */
	public function receiveRequest($params) {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		
		$itemInfo	= array();
		$db	 = Common::getMaster();
		$this->_begin($db);
		try {
			// 配達情報を記録
			$mRequest		= new TRequest($db);
			$insertResult	= $mRequest->updateRecord($params['requestID'],$params);
			$this->_commit();
			
			// 依頼者のカートの中身の商品情報を取得
			$requestInfo	= $mRequest->findRecord($insertResult['requestID']);
			$mCart			= new TCart($db);
			$select	= $mCart->select();
			$select->where('customerID = ?',$requestInfo['recipientID']);
			$itemInCart		= $mCart->fetchAll($select)->toArray();
			$mItem	= new MItemStock($db);
			foreach ($itemInCart as $item) {
				$itemInfo[]	= $mItem->itemInfo($item['itemID']);
			}
			
			// 配達が許可されたことを依頼者側にメール
			$this->_sendMail('naoto.nishizaka@gmail.com', 'naoto.nishizaka@gmail.com', 'テストメール', '配達完了パスワード：'.$requestInfo['password']);		// テスト用
			
		} catch (Exception $e) {
			$this->_rollBack();
			throw $e;
		}
		
		return $itemInfo;
	}
	/**
	 * 依頼者本人が受け取ったかどうかを確認する．
	 */
	public function confirmRequest($params) {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		
		$errFlg = false;
		$db	= common::getMaster();
		$this->_begin($db);
		try {
			$mRequest		= new TRequest($db);
			$requestInfo 	= $mRequest->findRecord($params['requestID']);
			
			if ($requestInfo['password'] != $params['password']) {
				$this->_log->debug("依頼人の入力したパスワードが異なります．");
				$errFlg	= true;
			}
		} catch (Exception $e) {
			$this->_rollBack();
			throw $e;
		}
		
		return $errFlg;
	}
	/**
	 * 配達リクエスト情報を返す
	 * @param $requestID
	 * @throws Exception
	 */
	public function selectRequestInfo($requestID) {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		
		$db	= Common::getMaster();
		$this->_begin($db);
		try {
			$mRequest		= new TRequest($db);
			$requestInfo	= $mRequest->findRecord($requestID);
			
			$price	= 0;
			$mCart		= new TCart($db);
			$select		= $mCart->select();
			$select->where('customerID = ?',$requestInfo['recipientID']);
			$itemInCartInfo	= $mCart->fetchAll($select)->toArray();
			foreach ($itemInCartInfo as $value) {
				$mItem		= new MItemStock($db);
				$itemInfo	= $mItem->itemInfo($value['itemID']);
				$itemNum	= (int) $value['numItem'];
				$itemPrice	= (int) $itemInfo['price'];
				$price		+= $itemNum * $itemPrice;
			}
			$requestInfo['price']	= $price;
			
		} catch (Exception $e) {
			$this->_rollBack();
			throw $e;
		}
		
		return $requestInfo;
	}
	/**
	 * 配達者or依頼者を評価する
	 * @param $customerID
	 * @param $params
	 * @throws Exception
	 */
	public function evaluatePerson($customerID,$params) {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		
		$db	= Common::getMaster();
		$this->_begin($db);
		try {
			$mRequest		= new TRequest($db);
			$requestInfo	= $mRequest->findRecord($params['requestID']);
			$mCustomer	= new TCustomer($db);
			if ($customerID == $requestInfo['recipientID']) {
				// 配達者を評価
				$this->_log->debug("配達者を評価");
				$mCustomer->updateRecord($requestInfo['deliverymanID'], $params);
			}elseif ($customerID == $requestInfo['deliverymanID']){
				// 依頼者を評価
				$this->_log->debug("配達者を評価");
				$mCustomer->updateRecord($requestInfo['recipientID'], $params);
			}
			$this->_commit();
		} catch (Exception $e) {
			$this->_rollBack();
			throw $e;
		}
		
		return ;
	}
	/**
	 * SESからメールを送る
	 * @param $from 送信者
	 * @param $to 受信者
	 * @param $subject 題名
	 * @param $content 内容
	 */
	protected function _sendMail($from, $to, $subject, $content) {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		
		$config		= Zend_Registry::get('vendor');
		$awsConfig	= $config['amazon'];
		
		$sendMail	= new SesSendEmail($awsConfig['key'], $awsConfig['secret']);
		$result		= $sendMail->sendEmail($from, $to, $subject, $content);
		$this->_log->debug("メール送信結果:".print_r($result,true));
	}
}