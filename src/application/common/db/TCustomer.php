<?php
require_once 'common/db/Abstract.php';

class
	TCustomer
extends
	DbAbstract
{
	protected $_name	= 't_customer';
	protected $_primary	= array('customerID');
	protected $_referenceMap	= array(
	);
	protected $_dependentTables	= array(
			't_cart',
			't_request'
	);
	
	/**
	 * insertメソッド
	 */
	public function insertRecord() {
		
	}
	public function findRecord($id) {
		
	}
}