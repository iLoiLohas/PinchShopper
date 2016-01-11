<?php
require_once 'controllers/Abstract.php';
//require_once 'models/Customer.php';

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

    public function indexAction()
    {
    	$this->_log->debug(__CLASS__ . ":" . __FUNCTION__ . " called:(" . __LINE__ . ")");
    }
}