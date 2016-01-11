<?php
class Common
{
	/**
	 * マスターDBを取得する．
	 * @return Zend_Db
	 */
	static public function getMaster() {
		$db	= Zend_Registry::get('db1');
		$db->getConnection();
		$db->setFetchMode(Zend_DB::FETCH_ASSOC);
		return $db;
	}
	/**
	 * スレイブDBを取得する．
	 * @return Zend_Db
	 */
	static public function getSlave() {
		$db	= Zend_Registry::get('db2');
		$db->getConnection();
		$db->setFetchMode(Zend_DB::FETCH_ASSOC);
		return $db;
	}
}