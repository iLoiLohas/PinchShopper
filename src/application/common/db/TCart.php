<?php
require_once 'common/db/Abstract.php';

class
	TCart
extends
	DbAbstract
{
	protected $_db	= null;
	protected $_name	= 't_cart';
	protected $_primary	= array('customerID','itemID');
	protected $_referenceMap	= array(
			'm_item_stock'	=> array(
					'columns'			=> 'itemID',
					'refTableClass'		=> 'MItemStock',
					'refColumns'		=> 'itemID'
			),
			't_customer'	=> array(
					'columns'			=> 'customerID',
					'refTableClass'		=> 'TCustomer',
					'refColumns'		=> 'customerID'
			)
	);
	protected $_dependentTables	= array(
	);

	public function __construct($db){
		$this->_loginit(get_class($this));
		$this->_db	= $db;
	}
	
	/**
	 * DB上に登録
	 */
	public function insertRecord($items) {
		$record	= $this->setColumn($items);
		$this->_log->debug("insertするデータ".print_r($record,true));
		$this->_db->insert($this->_name,$record);
		return $record;
	}
}