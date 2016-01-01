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
// 		$view = new Zend_View_Smarty(
// 				$smartyConfig['template_dir'], array(
//     	    'compile_dir' => $smartyConfig['compile_dir'],
//         	'config_dir'  => $smartyConfig['config_dir'],
//         	'cache_dir'   => $smartyConfig['cache_dir'],
//     		)
// 		);
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
		$viewRenderer->setViewSuffix('tpl');
		$viewRenderer->setView($view);
		Zend_Registry::set('smarty', $smartyConfig);
		return $view;
	}
}

