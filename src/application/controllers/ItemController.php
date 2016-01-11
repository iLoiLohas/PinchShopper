<?php
require_once 'controllers/Abstract.php';
require_once 'models/Item.php';

/**
 * ItemController
 * @author iLoiLohas
 *
 */
class
	ItemController
extends
	ControllerAbstract
{
    public function init()
    {
    	$this->_loginit(get_class($this));
    }
    public function preDispatch() {
		/** 各コントローラの共通前処理 **/
    	$chk	= Auth::loginCheck();
    	if ($chk === false) {
    		$this->_log->debug('ログインしていません．リダイレクトします．');
    		$this->redirect('/customer/login');
    	}
    }
    /**
     * 商品一覧画面
     * route --> /item
     */
    public function indexAction() {
    	$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
    	
    	$mapper		= new Item();
    	$items		= $mapper->selectAllItems();
    	
    	$customerID		= Auth::getUserID();
    	$customerInfo	= $mapper->selectCustomerByCustomerID($customerID);
    	
    	$this->setViewSearchlist($items);
    	$this->setViewIndata($customerInfo);
    	return ;
    }
    /**
     * 商品をカートに追加
     * route --> /item/add
     */
    public function addAction() {
    	$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
    	 return ;
    }
}