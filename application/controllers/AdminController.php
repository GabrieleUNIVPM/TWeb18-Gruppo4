<?php

class AdminController extends Zend_Controller_Action
{
	protected $_adminModel;
	protected $_authService;
	protected $_form;
        protected $_formF;
        protected $_formMF;
        protected $_formP;
        protected $_formT;
        protected $_formMT;
        protected $_formMU;
        protected $_userModel;

        public function init()
        {
    	$this->_helper->layout->setLayout('layadmin');   	
        $this->_adminModel = new Application_Model_Admin(); 	
        $this->_authService = new Application_Service_Auth();
        $ruolo = $this->_authService->getIdentity()->ruolo;
        $this->view->assign(array('ruolo' => $ruolo));
        $this->view->addpartnerForm = $this->getAddpartnerForm();  
        $this->view->addfaqForm = $this->getAddfaqForm();  
        $this->view->addtipevForm = $this->getAddtipevForm();  
        $this->view->modfaqForm = $this->getModfaqForm();
        $this->view->modtipoForm = $this->getModtipoForm();  
        $this->view->moduserForm = $this->getModuserForm();  

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
        if ($response !== null) 
        { $this->getResponse()->setHeader('Content-type','application/json')->setBody($response);        	
        }
    }
    public function gestisciutenteAction()
    {
        $keys=$this->_adminModel->getUtenti();
        $this->view->assign(array(
            		'utenti' => $keys,
            		)
        );
    //    $this->view->assign(array('elimina' => $elimina));
       
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
        {
        
        }
    public function newpartner1Action()
        {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form=$this->_formP;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('newpartner');
        }
        
        $values = $form->getValues();
       	$this->_adminModel->savePartner($values);
	$this->_helper->redirector('index'); 
        }
     
    public function newfaqAction()
        {
        
        }
    
    public function newfaq1Action()
        {
        if (!$this->getRequest()->isPost()) {
        $this->_helper->redirector('index');
        }
        $form=$this->_formF;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('newfaq');
        }
        
        $values = $form->getValues();
       	$this->_adminModel->addFaq($values);
	$this->_helper->redirector('index'); 
        }
    
    public function newtipevAction()
        {
        
        }
    
    public function newtipev1Action()
        {
            if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form=$this->_form;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('newtipev');
        }
        
        $values = $form->getValues();
       	$this->_adminModel->addTipev($values);
	$this->_helper->redirector('index'); 
            }
            
    
    
    public function modfaqAction() 
        {   
        $id = $this->getParam('id_F');
        $faq = $this->_adminModel->getFaqByID($id);
        $this->_formMF->setValues($faq);
        $this->view->modfaqForm = $this->_formMF;
        }
    
    public function modificafaqAction()
        {
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
                $form = $this->_formMF;
                $form->setValues($_POST); //viene creata la form con gli elementi già compilati
		if (!$form->isValid($_POST)) {
                    return $this->render('modfaq');
		}
                $values = $form->getValues();
                $id = $values['id_F'];
                unset($values['id_F']);
		$this->_adminModel->modificaFaq($values, $id);
            //    $modifica = true;
                $this->_helper->redirector('gestiscifaq','admin','default'/*,array('modifica'=> $modifica)*/);
        }
    
    public function gestiscitipevAction()
        {
        $paged = $this->_getParam('page', 1);
        $ke=$this->_adminModel->getTipoEventi();
        $elimina = $this->getParam('elimina');
        $modifica = $this->getParam('modifica');
        if($elimina){
            $tip = $this->getParam('tip');
            $this->view->assign(array('tipoeventi' => $ke,'tip' => $tip,'elimina' => $elimina));
            } else if($modifica){
                $tip = $this->getParam('tip');
                $vecchiatip = $this->getParam('vecchiatip');
                $this->view->assign(array('tipoeventi' => $ke,'tip' => $tip, 'vecchiatip'=> $vecchiatip, 'modifica' => $modifica)); 
                } else  {
                    $this->view->assign(array('tipoeventi' => $ke,));
                        }    
    }
   
        
    
    public function eliminatipevAction()
        {
        $id = $this->getParam('id_TE');
        $elimina = true;
        $this->_adminModel->deleteTipev($id);
        $this->_helper->redirector('gestiscitipev','admin','default',array('tip'=>$id, 'elimina'=>$elimina));
        }
    
        public function modtipAction() 
        {
        $cat = $this->getParam('id_TE');
        $tipologia = $this->_adminModel->getTipoEvento($cat);
        $this->_formMT->setValues($tipologia);
        $this->view->modtipologiaForm = $this->_formMT;
        }
        
        
        public function modtipoAction() 
        {
            if (!$this->getRequest()->isPost()) {
		$this->_helper->redirector('gestiscitipev','admin');
	}
                $form = $this->_formMT;
                $form->setValues($_POST); //viene creata la form con gli elementi già compilati
		if (!$form->isValid($_POST)) {
                    return $this->render('modtip');
		}   
                $values = $form->getValues();
                $vecchiatipologia = $values['id_TE'];
                unset($values['id_TE']);
                $modifica = true;  
                $this->_adminModel->modificaTipologia($values, $vecchiatipologia);             
                $this->_helper->redirector('gestiscitipev','admin','default',array('tip'=>$values, 'vecchiatip'=> $vecchiatipologia,'modifica'=> $modifica));          
    }
    public function moduserAction() {
        $user = $this->getParam('username');
        $utente = $this->_adminModel->getUtente($user);
        $this->formMU->setValues($utente);
        $this->view->moduserForm = $this->formMU;
    }
    public function modificauserAction(){
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
		$form = $this->formMU;
                $form->setValues($_POST);
		if (!$form->isValid($_POST)) {
			return $this->render('moduser');
		}
		$values = $form->getValues();
                $id = $values['id_U'];
                unset($values['id_U']);
		$this->_adminModel->modificaUtente($values, $id);
		$this->_helper->redirector('index');
    }
    
           
        
    private function getAddpartnerForm()
        {
    	$urlHelper = $this->_helper->getHelper('url');
	$this->_formP = new Application_Form_Admin_Addpartner();
    	$this->_formP->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'newpartner1'),
				'default'
		));
		return $this->_formP;
        }
    
    private function getAddfaqForm()
        {
    	$urlHelper = $this->_helper->getHelper('url');
	$this->_formF = new Application_Form_Admin_Addfaq();
    	$this->_formF->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'newfaq1'),
				'default'
		));
		return $this->_formF;
        }
    
    private function getAddtipevForm()
        {
        $urlHelper = $this->_helper->getHelper('url');
	$this->_form = new Application_Form_Admin_Addtipev();
    	$this->_form->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'newtipev1'),
				'default'
		));
		return $this->_form;
        }
    
    private function getModfaqForm() 
        {
        $urlHelper = $this->_helper->getHelper('url');
	$this->_formMF = new Application_Form_Admin_Modfaq();
    	$this->_formMF->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modificafaq'),
				'default'
		));
		return $this->_formMF;
        }
    
    public function getModtipoForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->_formMT = new Application_Form_Admin_Modtipologia();
		$this->_formMT->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modtipo'),
				'default'
				));
		return $this->_formMT;
    }
    public function getModuserForm(){
        $urlHelper = $this->_helper->getHelper('url');
		$this->formMU = new Application_Form_Admin_Moduser();
		$this->formMU->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modificauser'),//
				'default'
				));
		return $this->formMU;
    }
    public function profacquiAction()
    {
        $nome = $this->getParam('nome');
        $cognome = $this->getParam('cognome');
        $username=$this->getParam('username');
        $this->view->assign(array('nome' => $nome,'cognome'=>$cognome,'username'=>$username));
        $acq=$this->_adminModel->getAcquisti();
        $this->view->assign(array('acq' => $acq));
        
        
    }
    
        
}
