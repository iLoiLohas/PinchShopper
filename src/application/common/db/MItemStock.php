<?php
require_once 'common/db/Abstract.php';

class
	MItemStock
extends
	DbAbstract
{
	protected $_name	= 'm_item_stock';
	protected $_primary	= array('itemID');
	protected $_referenceMap	= array(
	);
	protected $_dependentTables	= array(
			't_cart'
	);
	
	/** 商品ID **/
	const ITEM_ID	= "itemID";
	
	/**
	 * insertメソッド
	 */
	public function insertRecord() {
		
	}
}