<?php
require_once 'common/db/Abstract.php';

class
	TCart
extends
	DbAbstract
{
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
	
	/**
	 * DB上に登録
	 */
	public function insertRecord($items) {
//		$record	= $this->setColumn($items);
		$record	= $items;
		$this->insert($record);
		return $record;
	}
}