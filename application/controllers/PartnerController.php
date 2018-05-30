<?php

class PartnerController extends Zend_Controller_Action
{
    protected $_organizzazioniModel;
    protected $_form;  
    protected $_authService;

    public function init()
    {
        $this->_helper->layout->setLayout('laypartner');  
     	$this->view->addForm = $this->getProductForm();  
        $this->_organizzazioniModel = new Application_Model_Organizzazioni();        
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
       	$this->_organizzazioniModel->saveProduct($values);//
        //$this->_organizzazioniModel->setNomeOrg($form->getValues('nome'));
        
	$this->_helper->redirector('index'); 
    }
    private function getProductForm()
    {
    	$urlHelper = $this->_helper->getHelper('url');
	$this->_form = new Application_Form_Organizzazioni_Product_Add();
    	$this->_form->setAction($urlHelper->url(array(
				'controller' => 'partner',
				'action' => 'addproduct'),
				'default'
		));
		return $this->_form;
    }
}

