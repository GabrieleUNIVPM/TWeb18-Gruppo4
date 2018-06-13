<?php

class UserController extends Zend_Controller_Action

{
    protected $_userModel;
    protected $_publicModel;
    protected $_form;
    protected $formA;
    public $n;
    protected $formR;
    
    public function init()
    {
        $this->_helper->layout->setLayout('layuser');
        $this->_authService = new Application_Service_Auth();
        $ruolo = $this->_authService->getIdentity()->ruolo;
        $this->view->assign(array('ruolo' => $ruolo));        
        $this->_userModel = new Application_Model_User();
        $this->_publicModel = new Application_Model_Public();
        $this->view->moduserForm = $this->getModuserForm();
        $this->view->acquistoForm = $this->getAcquistoForm();
        $this->view->ricercaForm = $this->getRicercaForm();
        
    }

    public function indexAction()
    {
        $user = $this->_authService->getIdentity()->username;
        $utente = $this->_userModel->getUtente($user);
        $this->view->assign(array('utente' => $utente));
        $this->view->assign(array('nome' => $this->_authService->getIdentity()->nome,'cognome'=>$this->_authService->getIdentity()->cognome));
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
        $eventi=$this->_publicModel->getEventiAttivi($paged);
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->layout->setLayout('layout');
        $partecipazioni=$this->_publicModel->getPartecipazioni();
        
        $this->view->assign(array('Eventi' => $eventi,'Part'=>$partecipazioni,'Username'=>$this->_authService->getIdentity()->username));
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
        
        $eventi=$this->_publicModel->getEventi($key);
        $bool=false;
        foreach ($eventi as $nb){if($this->getParam('nomeevento')===$nb->nome){if($nb->numerobiglietti < $values['numerobiglietti'])
            {$bool=true;
            $this->_helper->redirector('bigliettifiniti','user');
        }}}
        if($bool===false){
        if($this->getParam('sconto')!=0){$values['sconto']=$this->getParam('sconto');}
        $this->_publicModel->salvaAcquisto($values);
        $nbr=0;
        foreach ($eventi as $nb){if($this->getParam('nomeevento')===$nb->nome){$nbr=$nb->numerobiglietti;}}
        $nba=$nbr-$values['numerobiglietti'];
        $a=array('numerobiglietti'=>$nba);
        $this->_publicModel->aggiornabiglietti($this->getParam('nomeevento'),$a);
        }
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
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->layout->setLayout('layout');
    }
    private function getRicercaForm()
    {
    		$urlHelper = $this->_helper->getHelper('url');
		$this->formR = new Application_Form_Public_Ricerca();
    		$this->formR->setAction($urlHelper->url(array(
			'controller' => 'user',
			'action' => 'risultati'),
			'default'
		));
		return $this->formR;
    }
    public function risultatiAction() {
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
		$form=$this->formR;
		if (!$form->isValid($_POST)) {
			return $this->render('eventi');
		}
                $values = $form->getValues();
                $type=$values['tipologia'];
                $part=$values['organizzatore'];
                $nome=array($values['nome']);
                $data=$values['data'];
                $luogo=$values['luogo'];
                $paged = $this->_getParam('page', 1);
		$eventi=$this->_publicModel->getEventiCercati($type, $nome, $part, $data, $luogo, $paged);
                $this->_helper->getHelper('layout')->disableLayout();
                $this->_helper->layout->setLayout('layout');
                $partecipazioni=$this->_publicModel->getPartecipazioni();
                $this->view->assign(array('Eventi' => $eventi,'Part'=>$partecipazioni,'Username'=>$this->_authService->getIdentity()->username));
    
    }
    public function genpdfAction()
    {
        $nomeevento = $this->_getParam('nomeevento');
        $numerobiglietti = $this->_getParam('numerobiglietti');
        $metodo = $this->_getParam('metodo');
        $titolo = $this->_getParam('titolo');
        $t='';
        if($metodo==='P'){$t= 'Paypal';}
        if($metodo==='V'){$t= 'Visa';}
        if($metodo==='M'){$t= 'Mastercard';}
        if($metodo==='B'){$t= 'Bonifico bancario';}
        $this->view->assign(array('nomeevento' => $nomeevento,'numerobiglietti'=>$numerobiglietti,
                                  'pag'=> $t));
        $this->view->assign(array('nome' => $this->_authService->getIdentity()->nome,'cognome'=>$this->_authService->getIdentity()->cognome));
        
    }
     public function partecipazioneAction()
     {
        $this->_helper->getHelper('layout')->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
        
        $nomeevento = $this->getParam('nomeevento');
        $add=array('nomeevento'=>$nomeevento,'username'=>$this->_authService->getIdentity()->username);
        $this->_userModel->addPartecipazione($add);
        $this->_helper->redirector('eventi','user');
     }
     public function bigliettifinitiAction()
     {
     }

}
