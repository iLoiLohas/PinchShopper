<?php
require_once 'controllers/Abstract.php';

/**
 * 顧客に関する処理
 * @author iLoiLohas
 *
 */
class
	CustomerController
extends
	ControllerAbstract
{

    public function init()
    {
    	$this->_loginit(get_class($this));
        /* Initialize action controller here */
    }

    public function loginAction()
    {
    	$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
		$this->view->str = 'Hello Customer controller!!';
    }


}

