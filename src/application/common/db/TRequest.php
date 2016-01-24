<?php
require_once 'common/db/Abstract.php';

class
	TRequest
extends
	DbAbstract
{
	protected $_db	= null;
	protected $_name	= 't_request';
	protected $_primary	= array('requestID');
	protected $_referenceMap	= array(
			't_customer'	=> array(
					'columns'			=> 'recipientID',
					'refTableClass'		=> 'TCustomer',
					'refColumns'		=> 'customerID'
			),
			't_customer'	=> array(
					'columns'			=> 'deliverymanID',
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
	 * insert
	 */
	public function insertRecord($items) {
		$record	= $this->setColumn($items);
		$this->_db->insert($this->_name,$record);
		$record['requestID']	= $this->getAdapter()->lastInsertId();
		return $record;
	}
	/**
	 * update
	 */
	public function updateRecord($id, $items) {
		$record	= $this->setColumn($items);
		$rows	= $this->find($id);
		if (count($rows) != 1) {
			throw new Exception("配達リクエストが１つではありません．");
		}
		$row	= $rows->current();
		foreach ($record as $key => $value) {
			$row->$key	= $value;
		}
		$row->save();
		$ret	= $row->toArray();
		return $ret;
	}
	/**
	 * IDからDB情報を返す
	 * @param $id
	 * @throws Exception
	 */
	public function findRecord($id) {
		$rows	= $this->find($id);
		
		if(count($rows) != 1) {
			throw new Exception("配達リクエストが１つではありません．");
		}
		$row		= $rows->current();
		$itemInfo	= $row->toArray();
		
		return $itemInfo;
	}
}