<?php
require_once 'common/db/Abstract.php';

class
	TCustomer
extends
	DbAbstract
{
	protected $_db	= null;
	protected $_name	= 't_customer';
	protected $_primary	= array('customerID');
	protected $_referenceMap	= array(
	);
	protected $_dependentTables	= array(
			't_cart',
			't_request'
	);
	
	public function __construct($db) {
		$this->_loginit(get_class());
		$this->_db	= $db;
	}
	
	/**
	 * 更新
	 */
	public function updateRecord($id, $items) {
		$record	= $this->setColumn($items);
		$rows	= $this->find($id);
		if (count($rows) == 0) {
			$this->_log->debug("顧客が存在しませんでした！！");
			return ;
		}
		$row	= $rows->current();
		foreach ($record as $key => $value) {
			$row->$key	= $value;
		}
		$row->save();
		$ret	= $row->toArray();
		return $ret;
	}
	public function findRecord($id) {
		
	}
}