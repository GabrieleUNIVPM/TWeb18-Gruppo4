<?php

class AdminController extends Zend_Controller_Action
{
	protected $_adminModel;
	protected $_authService;
	protected $_form;
	
	
    public function init()
    {
    	$this->_helper->layout->setLayout('admin');   	
        $this->_adminModel = new Application_Model_Admin();
     	$this->view->productForm = $this->getProductForm();    	
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

    public function newproductAction() 
    {}

	public function addproductAction() 
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$form=$this->_form;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('newproduct');
        }
        $values = $form->getValues();
       	$this->_adminModel->saveProduct($values);
		$this->_helper->redirector('index'); 
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

    private function getProductForm()
    {
    	$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Admin_Product_Add();
    	$this->_form->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'addproduct'),
				'default'
		));
		return $this->_form;
    }
}
