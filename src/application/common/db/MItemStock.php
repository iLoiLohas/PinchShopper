<?php
require_once 'common/db/Abstract.php';

class
	MItemStock
extends
	DbAbstract
{
	protected $_db	= null;
	protected $_name	= 'm_item_stock';
	protected $_primary	= array('itemID');
	protected $_referenceMap	= array(
	);
	protected $_dependentTables	= array(
			't_cart'
	);
	
	/** 商品ID **/
	const ITEM_ID	= "itemID";
	
	public function __construct($db) {
		$this->_db	= $db;
	}
	
	/**
	 * insertメソッド
	 */
	public function insertRecord() {
		
	}
	
	/**
	 * 商品情報を返します．
	 * @param $id
	 * @throws Exception
	 */
	public function itemInfo($id) {
		$rows	= $this->find($id);
		
		if(count($rows) != 1) {
			throw new Exception("商品の個数が１つではありません．");
		}
		$row		= $rows->current();
		$itemInfo	= $row->toArray();
		
		return $itemInfo;
	}
}