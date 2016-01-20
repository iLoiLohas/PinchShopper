<?php
require_once 'models/Abstract.php';
require_once 'common/db/db.php';

class
	Item
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
	 * 在庫一覧を取得．
	 * 商品IDの順で整列させる．
	 * @param $params
	 */
	public function selectAllItems() {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		$items	= array();
		$db		= Common::getMaster();

		$mItemStock		= new MItemStock($db);
		$select		= $mItemStock->select();
		$select->order('m_item_stock.'.$mItemStock::ITEM_ID);
		$items		= $mItemStock->fetchAll($select)->toArray();

		return $items;
	}
	/**
	 * 商品をカートに追加する．
	 * カートのDBは顧客IDごとに用意してある．
	 * @param $params
	 */
	public function addItemInCart($params) {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		
		$db		= Common::getMaster();
		$this->_begin($db);
		try {			
			$mCart		= new TCart($db);
			$result		= $mCart->insertRecord($params);
			$this->_commit();

			$this->_log->debug('DB上に登録した値：'.print_r($result));
		} catch (Exception $e) {
			$this->_rollBack();
			throw $e;
		}

		return ;
	}
	/**
	 * 顧客情報を取得．
	 * @param int $id
	 */
	public function selectCustomerByCustomerID($id) {
		$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		$customerInfo	= array();
		$db	= Common::getMaster();

		$mCustomer	= new TCustomer($db);
		$select		= $mCustomer->select();
		$select->where('customerID = ?',$id);
		$customerInfo	= $mCustomer->fetchAll($select)->toArray();

		if (count($customerInfo) != 1) {
			$this->_log->error('取得した顧客情報が1つではありませんでした．');
			return ;
		}

		return $customerInfo[0];
	}
}