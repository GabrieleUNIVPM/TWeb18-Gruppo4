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
        
    	protected function _initDbParms()
    {
    	include_once (APPLICATION_PATH . '/../../include/connect.php');
		$db = new Zend_Db_Adapter_Pdo_Mysql(array(
    			'host'     => $HOST,
    			'username' => $USER,
    			'password' => $PASSWORD,
    			'dbname'   => $DB
				));  
		Zend_Db_Table_Abstract::setDefaultAdapter($db);
                //metodo che si può utilizzare direttamente sulla classe dell'oggetto
                //prende come parametro un adapter
	}

}

