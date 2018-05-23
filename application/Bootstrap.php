<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initRequest()
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
    }
    
    protected function _initViewSettings()
    {
        $this->bootstrap('view');
        $this->_view = $this->getResource('view');
        $this->_view->headTitle('TickeTo');
        $this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/style.css'));
    }
    protected function _initDefaultModuleAutoloader()
    {
    	$loader = Zend_Loader_Autoloader::getInstance();
		$loader->registerNamespace('App_');
        $this->getResourceLoader()
             ->addResourceType('modelResource','models/resources','Resource');
  	}

}

