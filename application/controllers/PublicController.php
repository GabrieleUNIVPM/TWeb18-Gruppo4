<?php

class PublicController extends Zend_Controller_Action
{
    protected $_publicModel;
    protected $_form;
    protected $_formreg;
    protected $_formlogin;
    protected $_logger;
    protected $_authService;

    public function init()
    {
        $this->_publicModel = new Application_Model_Public();
        $this->_helper->layout->setLayout('layout');
        $this->view->loginForm = $this->getLoginForm();
        $this->view->registraForm = $this->getRegistraForm();
        
        $this->_authService = new Application_Service_Auth();
        if($this->_authService->getIdentity() != false){
        $ruolo = $this->_authService->getIdentity()->ruolo;
        }
        else {$ruolo=false;}        
        $this->view->assign(array('ruolo' => $ruolo));
        
    }

    public function indexAction()
    {
        $key= $this->_getParam('getTipoEventi', null);
        $keys=$this->_publicModel->getTipoEventi($key);
        foreach ($keys as $key) {$keys[] = $key->id_TE;}
        $this->view->assign(array(
            		'tipologie' => $keys,
            		)
        );
    }
    
    public function viewstaticAction() {
        $page = $this->_getParam('staticPage');
        $this->render($page);
    }
    
    public function faqAction()
    {
        //$key= $this->_getParam('getFaq', null);
        $faqs=$this->_publicModel->getFaq();
        //foreach ($keys as $key) {$keys[] = $key->id_F;}
        $this->view->assign(array(
            		'FAQ' => $faqs,
            		)
        );
    }
    public function eventiAction()
    {
        $key= $this->_getParam('getEventi', null);
        $eventi=$this->_publicModel->getEventi($key);
        $this->view->assign(array('Eventi' => $eventi));
    }
    public function eventoAction()
    {
        $key= $this->_getParam('getEventi', null);
        $evento=$this->_publicModel->getEventi($key);
        $this->view->assign(array('Eventi' => $evento));
    }

    
    public function organizzazioniAction()
    {
        $key= $this->_getParam('getOrganizzazioni', null);
        $organizzazioni=$this->_publicModel->getOrganizzazioni($key);
        $this->view->assign(array('Organizzazioni' => $organizzazioni));
    }
    
    private function getRegistraForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
		$this->_formreg = new Application_Form_Public_Registra();
    		$this->_formreg->setAction($urlHelper->url(array(
			'controller' => 'public',
			'action' => 'reg'),
			'default'
		));
		return $this->_formreg;
    }
    
    public function registraAction()
    {
    /*    if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
	}
	$form = $this->_formreg;
	if (!$form->isValid($_POST)) {
			return $this->render('registra');
	}
	$values = $form->getValues();
        $this->_publicModel->salvaUtente($values);
	$this->_helper->redirector('login','public'); */
    }
    
    public function regAction()
    {
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
	}
	$form = $this->_formreg;
	if (!$form->isValid($_POST)) {
			return $this->render('registra');
	}
	$values = $form->getValues();
        $this->_publicModel->salvaUtente($values);
	$this->_helper->redirector('login','public');
    }
     public function loginAction()
    {
         
    }

    public function authenticateAction()
	{        
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('login');
        }
        $form = $this->_formlogin;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
        	    return $this->render('login');
        }
        if (false === $this->_authService->authenticate($form->getValues())) {
            $form->setDescription('Autenticazione fallita. Riprova');
            return $this->render('login');
        }
        return $this->_helper->redirector('index', $this->_authService->getIdentity()->ruolo);
	}
        
        private function getLoginForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->_formlogin = new Application_Form_Public_Auth_Login();
    		$this->_formlogin->setAction($urlHelper->url(array(
			'controller' => 'public',
			'action' => 'authenticate'),
			'default'
		));
		return $this->_formlogin;
    }
}
