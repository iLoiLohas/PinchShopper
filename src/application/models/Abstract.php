<?php
require_once 'common/Common.php';
require_once 'common/Auth.php';

class ModelAbstract
{
	protected $_log;
	
	/**
	 *
	 * ログ初期化.
	 * @return Logger
	 */
	protected function _loginit($classname) {
		$log		= Zend_Registry::get('logger');
		$this->_log	= $log::getLogger($classname);
		return	$this->_log;
	}
	/**
	 * データベーストランザクションを開始する．
	 * @param Zend_Db $db
	 */
	protected function _begin($db) {
		$db->beginTransaction();
	}
	/**
	 * データベースコミット処理を行う．
	 * @param Zend_Db $db
	 */
	protected function _commit($db) {
		$db->commit();
	}
	/**
	 * データベースロールバック処理を行う．
	 * @param Zend_Db $db
	 */
	protected function _rollBack($db) {
		$db->rollBack();
	}
}