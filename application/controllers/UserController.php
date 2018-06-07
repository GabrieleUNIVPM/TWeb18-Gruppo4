<?php

class UserController extends Zend_Controller_Action

{
    protected $_userModel;
    protected $_publicModel;
    protected $_form;
    protected $formA;
    public $n;
    
    public function init()
    {
        $this->_helper->layout->setLayout('layuser');
        $this->_authService = new Application_Service_Auth();
        $ruolo = $this->_authService->getIdentity()->ruolo;
        $this->view->assign(array('ruolo' => $ruolo));        
        $this->_userModel = new Application_Model_User();
        $this->_publicModel = new Application_Model_Public();
        $this->view->moduserForm = $this->getModuserForm();
        $this->view->acquistoForm = $this->getAcquistoForm();//
        
        
    }

    public function indexAction()
    {
        $user = $this->_authService->getIdentity()->username;
        $utente = $this->_userModel->getUtente($user);
        $this->view->assign(array('utente' => $utente));
    }  

    public function logoutAction()
    {
	$this->_authService->clear();
	return $this->_helper->redirector('index','public');	
    }
    
    public function moduserAction() {
        $user =$this->_authService->getIdentity()->username;
        $utente = $this->_userModel->getUtente($user);
        $this->_form->setValues($utente);
        $this->view->moduserForm = $this->_form;
    }
    
    public function modprofiloAction(){
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
		$form = $this->_form;
                $form->setValues($_POST);
		if (!$form->isValid($_POST)) {
			return $this->render('moduser');
		}
		$values = $form->getValues();
                $id = $values['id_U'];
                unset($values['id_U']);
		$this->_userModel->modificaUtente($values, $id);
		$this->_helper->redirector('index','user');
    }
    
    public function getModuserForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_User_Moduser();
		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'user',
				'action' => 'modprofilo'),
				'default'
				));
		return $this->_form;
    }
    public function acquistiAction()
    {
        $user = $this->_authService->getIdentity()->username;
        $acquisti = $this->_userModel->getAcquisti();
        $this->view->assign(array('utente' => $user));
        $this->view->assign(array('acquisti' => $acquisti));
        
    }
    public function eventiAction()
    {
        $paged = $this->_getParam('page', 1);
        $key= $this->_getParam('getEventi', null);
        $eventi=$this->_publicModel->getEventi($key,$paged);
        $this->view->assign(array('Eventi' => $eventi));
    }
    public function acquistoAction()
    {
        
    }
    public function acquisto1Action()
    {   
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
	}
	$form = $this->formA;
	if (!$form->isValid($_POST)) {
			return $this->render('acquisto');
	}
        $form->setValues($this->_authService->getIdentity()->username,$this->getParam('nomeevento'));
	$values = $form->getValues();
        $this->_publicModel->salvaAcquisto($values);
	$this->_helper->redirector('acquisti','user');
    }
    
    public function getAcquistoForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->formA = new Application_Form_User_Acquisto();
		$this->formA->setAction($urlHelper->url(array(
				'controller' => 'user',
				'action' => 'acquisto1'),
				'default'
				));
		return $this->formA;
    }
    public function confermaacqAction()
    {
    }

}