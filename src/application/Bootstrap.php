<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     *
     * Bootstrap Smarty view
     */
	protected function _initView() {
		$smartyConfig	= $this->getOption('smarty');
		$view = new Ext_View_Smarty($smartyConfig);
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
		$viewRenderer->setViewSuffix('tpl');
		$viewRenderer->setView($view);
		Zend_Registry::set('smarty', $smartyConfig);
		return $view;
	}
}

