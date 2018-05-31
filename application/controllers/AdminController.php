<?php

class AdminController extends Zend_Controller_Action
{
	protected $_adminModel;
	protected $_authService;
	protected $_form;
	
	
    public function init()
    {
    	$this->_helper->layout->setLayout('layadmin');   	
        $this->_adminModel = new Application_Model_Admin();
  	
        $this->_authService = new Application_Service_Auth();
        $ruolo = $this->_authService->getIdentity()->ruolo;
        $this->view->assign(array('ruolo' => $ruolo));
    }

    public function indexAction()
    {
        
    }
    
	public function logoutAction()
	{
		$this->_authService->clear();
		return $this->_helper->redirector('index','public');	
	}

    
	// Validazione AJAX
	public function validateproductAction() 
    {
        $this->_helper->getHelper('layout')->disableLayout();
    		$this->_helper->viewRenderer->setNoRender();

        $prodform = new Application_Form_Admin_Product_Add();
        $response = $prodform->processAjax($_POST); 
        if ($response !== null) {
        	$this->getResponse()->setHeader('Content-type','application/json')->setBody($response);        	
        }
    }
    public function gestisciutenteAction()
    {
        $keys=$this->_adminModel->getadmUtenti();
        $this->view->assign(array(
            		'utenti' => $keys,
            		)
        );
    }
    public function gestiscifaqAction()
    {
        $keys=$this->_adminModel->getFaq();
        $this->view->assign(array(
            		'faq' => $keys,
            		)
        );
    }

    
}
