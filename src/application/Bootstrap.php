<?php
require_once APPLICATION_PATH . '/../library/log4j/Logger.php';

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
	/**
	 *
     * Bootstrap Logger
     */
	protected function _initLog() {
		$options = $this->getOptions();
		Logger::configure($options['log4php']['config']);
		define('LOGGER', 'default');
		$log	= Logger::getLogger('pinchshopper');
// 		$remoteAddr = getenv( "REMOTE_ADDR" );
// 		$remoteHost = getenv( "REMOTE_HOST" );
// 		LoggerMDC::put( 'REMOTE_ADDR', $remoteAddr );
// 		LoggerMDC::put( 'REMOTE_HOST', $remoteHost );
		$log->debug("start");
		Zend_Registry::set('logger', $log);
		return $log;
	}
}

