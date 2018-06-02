<?php

class AdminController extends Zend_Controller_Action
{
	protected $_adminModel;
	protected $_authService;
	protected $_form;
        protected $form;
	
	
    public function init()
    {
    	$this->_helper->layout->setLayout('layadmin');   	
        $this->_adminModel = new Application_Model_Admin(); 	
        $this->_authService = new Application_Service_Auth();
        $ruolo = $this->_authService->getIdentity()->ruolo;
        $this->view->assign(array('ruolo' => $ruolo));
        $this->view->addpartnerForm = $this->getAddpartnerForm();  
        $this->view->addfaqForm = $this->getAddfaqForm();  
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
        $keys=$this->_adminModel->getUtenti();
        $this->view->assign(array(
            		'utenti' => $keys,
            		)
        );
        $this->view->assign(array('elimina' => $elimina));
       
    }
    public function gestiscifaqAction()
    {
        $keys=$this->_adminModel->getFaq();
        $this->view->assign(array(
            		'faq' => $keys,
            		)
        );
    }
    public function eliminafaqAction()
    {
        $id = $this->getParam('id_F');
        $this->_adminModel->deleteFaq($id);
        $this->_helper->redirector('gestiscifaq','admin','default');
    }
    public function eliminaAction()
    {
        $id = $this->getParam('id_U');
        $this->_adminModel->cancellaUtente($id);
        $this->_helper->redirector('gestisciutente','admin','default');
    }
    public function newpartnerAction()
    {}
    public function newpartner1Action()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form=$this->_form;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('newpartner');
        }
        
        $values = $form->getValues();
       	$this->_adminModel->savePartner($values);
	$this->_helper->redirector('index'); 
    }
     private function getAddpartnerForm()
    {
    	$urlHelper = $this->_helper->getHelper('url');
	$this->_form = new Application_Form_Admin_Addpartner();
    	$this->_form->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'newpartner1'),
				'default'
		));
		return $this->_form;
    }
    public function newfaqAction(){}
    public function newfaq1Action()
        {
            if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form=$this->_form;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('newfaq');
        }
        
        $values = $form->getValues();
       	$this->_adminModel->addFaq($values);
	$this->_helper->redirector('index'); 
        }
     private function getAddfaqForm()
    {
    	$urlHelper = $this->_helper->getHelper('url');
	$this->_form = new Application_Form_Admin_Addfaq();
    	$this->_form->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'newfaq1'),
				'default'
		));
		return $this->_form;
    }

    
}
