<?php
class
	DbAbstract
extends
	Zend_Db_Table_Abstract
{
	/**
	 * 必要なカラム情報を含むパラメータのみ取り出す．
	 * @param $item
	 */
	protected function setColumn($item) {
		$result	= array();
		$col	= $this->info();
		foreach ($item as $key => $value) {
			if (array_key_exists($key, $col)) {
				$result[$key]	= $value;
			}
		}
		return $result;
	}
}