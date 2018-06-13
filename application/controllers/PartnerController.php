 <?php

class PartnerController extends Zend_Controller_Action
{
    protected $_organizzazioniModel;
    protected $_publicModel;
    protected $_form; 
    protected $_form1;
    protected $_authService;
    protected $nome;
    protected $_formME;
    protected $formD;

    public function init()
    {
        $this->_helper->layout->setLayout('laypartner');  
     	$this->view->addForm = $this->getProductAddForm();
        $this->_organizzazioniModel = new Application_Model_Organizzazioni();    
        $this->_publicModel = new Application_Model_Public();    
        $this->_authService = new Application_Service_Auth();
        $ruolo = $this->_authService->getIdentity()->ruolo;
        $name = $this->_authService->getIdentity()->nome;
        $this->view->assign(array('ruolo' => $ruolo));
        $this->view->modevForm = $this->getModevForm();  
        $this->view->dataForm = $this->anavendAction();
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
    {
        
    }
    
    public function gestisciAction(){
        
        $paged = $this->_getParam('page', 1);
        $org = $this->_authService->getIdentity()->nome;
        //$key= $this->_getParam('getEventiPart', null);
        $eventi=$this->_organizzazioniModel->getEventiPart($org,$paged);
        
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
            $this->_helper->redirector('index','public');
        }
        $form=$this->_form;
        if (!$form->isValid($_POST)) {
        $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
        return $this->render('newproduct');
        }
        $values = $form->getValues();
        if($values['immagine'] === null){
                            $values['immagine']='default.png';
                }
        if($values['organizzatore'] === null) {
                            $values['organizzatore'] = 'minchia';
        }
       	$this->_organizzazioniModel->saveProduct($values);
    //    $this->_organizzazioniModel->insertNome($this->_authService->getIdentity()->nome,$this->_authService->getIdentity()->id_U);
	$this->_helper->redirector('index'); 
    }
    private function getProductAddForm()
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
    
    public function eliminaAction(){
        $nome = $this->getParam('id_E');
        $elimina = true;
        $this->_organizzazioniModel->deleteEvento($nome);
        $this->_helper->redirector('gestisci','partner','default', array('elimina' => $elimina, ));
    }
 
    public function modevAction() 
        {   
        $id = $this->getParam('id_E');
        $ev = $this->_organizzazioniModel->getEventoByID($id);
        $this->_formME->setValues($ev);
        $this->view->modevForm = $this->_formME;//
        }
    public function modificaeventoAction()
        {
        if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index','public');
		}
                $form = $this->_formME;
                $form->setValues($_POST); //viene creata la form con gli elementi già compilati
		if (!$form->isValid($_POST)) {
                    return $this->render('modev');
		}
                $values = $form->getValues();
                $id = $values['id_E'];
                unset($values['id_E']);
                    if ($values['immagine']==null) unset($values['immagine']);
                        $this->_organizzazioniModel->modificaEvento($values, $id);
                $this->_organizzazioniModel->insertNome($this->_authService->getIdentity()->nome,$this->_authService->getIdentity()->id_U);
                $modifica = true;
                $this->_helper->redirector('gestisci', 'partner', 'default', array('modifica' => $modifica, 'id_E' => $id));
        }
    private function getModevForm() 
        {
        $urlHelper = $this->_helper->getHelper('url');
	$this->_formME = new Application_Form_Organizzazioni_Product_Modev();
    	$this->_formME->setAction($urlHelper->url(array(
				'controller' => 'partner',
				'action' => 'modificaevento'),//
				'default'
		));
		return $this->_formME;
        }
        public function anavendAction()
        {
        $key= $this->_getParam('getEventi', null);
        $eventi=$this->_organizzazioniModel->getEventi($key);
        $this->view->assign(array('Nome' => $this->_authService->getIdentity()->nome));
        $this->view->assign(array('Eventi' => $eventi)); 
        $num=$this->_organizzazioniModel->getAcquisti();
        $this->view->assign(array('Acquisti' => $num));
        
        $partecipazioni=$this->_publicModel->getPartecipazioni();
        $utenti=$this->_organizzazioniModel->getUtenti();
        $this->view->assign(array('Part'=>$partecipazioni,'Utenti'=>$utenti));
               
        $urlHelper = $this->_helper->getHelper('url');
	$this->formD = new Application_Form_Organizzazioni_Product_Data();
    	$this->formD->setAction($urlHelper->url(array(
				'controller' => 'partner',
				'action' => 'incasso'),
				'default'
		));
		return $this->formD;
        }
        
        public function incassoAction()
        {
            
            
        $form1 = $this->formD;
        $ev = $this->_organizzazioniModel->calcolaIncasso($this->_authService->getIdentity()->nome,$this->getParam('datastart'),$this->getParam('dataend'));
        $prof=0;$b=0;$sconto=0;
        $acq=$this->_organizzazioniModel->getAcquisti();
        foreach ($ev as $i){
            foreach ($acq as $a){
                if($i->nome===$a->nomeevento){
                    $b=$b+$a->numerobiglietti;
                    if($a->sconto != 0){$sconto=$a->sconto;}}
                   if($sconto != 0) {$sco=(($i->prezzo*$sconto)/100);$prof=$prof + ($b*($i->prezzo-$sco));$b=0;$sco=0;$sconto=0;}
                   else{$prof=$prof + ($b*$i->prezzo);$b=0;}}}
       $this->view->assign(array('prof'=>$prof));
        
        }
}

