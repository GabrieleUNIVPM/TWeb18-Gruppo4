<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initRequest()
	// Aggiunge un'istanza di Zend_Controller_Request_Http nel Front_Controller
	// che permette di utilizzare l'helper baseUrl() nel Bootstrap.php
	// Necessario solo se la Document-root di Apache non è la cartella public/
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
        $this->_view->headTitle('TicketTo');
        $this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/style.css'));
    }


}

