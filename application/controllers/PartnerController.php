<?php

class PartnerController extends Zend_Controller_Action
{
    protected $_organizzazioniModel;
    protected $_form; 
    protected $_form1;
    protected $_authService;
    protected $nome;

    public function init()
    {
        $this->_helper->layout->setLayout('laypartner');  
     	$this->view->addForm = $this->getProductForm();  
        /*$this->view->gestisciForm = $this->getGestisciForm(); */
        $this->_organizzazioniModel = new Application_Model_Organizzazioni();        
        $this->_authService = new Application_Service_Auth();
        $ruolo = $this->_authService->getIdentity()->ruolo;
        $this->view->assign(array('ruolo' => $ruolo));
    }

    public function indexAction()
    {
        $nome=$this->_authService->getIdentity()->nome;

    }
    
    public function logoutAction()
    {
	$this->_authService->clear();
	return $this->_helper->redirector('index','public');	
    }

    public function newproductAction() 
    {}
    public function gestisciAction(){
        
        $paged = $this->_getParam('page', 1);
        $key= $this->_getParam('getEventi', null);
        $eventi=$this->_organizzazioniModel->getEventi($key,$paged);
        
        $elimina = $this->getParam('elimina');
        $modifica = $this->getParam('modifica');
         if($elimina){
        //    $even = $this->getParam('even');
            $this->view->assign(array('Eventi' => $eventi, 'elimina' => $elimina));
        }else if($modifica){
        //    $off = $this->getParam('off');
            $this->view->assign(array('Eventi' => $eventi,'modifica' => $modifica)); 
        }else{
           $this->view->assign(array('Eventi' => $eventi)); 
        }
        
    //    $this->view->assign(array('Eventi' => $eventi));
        $this->view->assign(array('Nome' => $this->_authService->getIdentity()->nome));
    }

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
       	$this->_organizzazioniModel->saveProduct($values);
        $this->_organizzazioniModel->insertNome($this->_authService->getIdentity()->nome,$this->_authService->getIdentity()->id_U);
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
    public function eventiAction()//
    {
        
    }
    /*public function eliminaAction()
    {
        //$form=$this->_form1;
        
       	$this->_organizzazioniModel->deleteEvento($this->$_POST['id_E']);
        $this->_helper->redirector('index'); 
    }*/
    
    public function eliminaAction(){
        $nome = $this->getParam('id_E');
        $elimina = true;
        $this->_organizzazioniModel->deleteEvento($nome);
        $this->_helper->redirector('gestisci','partner','default');
    }
   /* private function getGestisciForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
	$this->_form1 = new Application_Form_Organizzazioni_Product_Gestisci();
    	$this->_form1->setAction($urlHelper->url(array(
				'controller' => 'partner',
				'action' => 'elimina'),
				'default'
		));
    return $this->_form1;
        
    }*/
}

