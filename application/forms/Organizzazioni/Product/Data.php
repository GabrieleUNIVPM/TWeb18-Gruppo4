<?php
class Application_Form_Organizzazioni_Product_Data extends App_Form_Abstract
{
	protected $_organizzazioniModel;
        protected $_authService;


        public function init()
    {
    	$this->_organizzazioniModel = new Application_Model_Organizzazioni();
        $this->setMethod('post');
        $this->setName('data');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->_authService = new Application_Service_Auth();
        $nome=$this->_authService->getIdentity()->nome;
        
        $eventi = array();
        $tip = $this->_organizzazioniModel->getEventiPart($nome);
        foreach ($tip as $cat) {
        	$eventi[$cat -> nome] = $cat->nome;       
        }

        $this->addElement('select', 'nomeevento', array(
            'label' => 'Evento',
            'required' => true,
            'multiOptions' => $eventi,
            'values'=>$eventi,
            'decorators' => $this->elementDecorators,
        ));
        
         $this->addElement('text', 'datastart', array(
            'label' => 'Inizio',
            'class'=> 'datepicker',
            'required' => true,
            'validators' => array (array('date', false, array('yyyy/MM/dd'))),
            'decorators' => $this->elementDecorators,
        ));
          $this->addElement('text', 'dataend', array(
            'label' => 'Fine',
            'class'=> 'datepicker',
            'required' => true,
            'validators' => array (array('date', false, array('yyyy/MM/dd'))),
            'decorators' => $this->elementDecorators,
        ));
       
        $this->addElement('submit', 'calcola', array(
            'label' => 'Calcola',
            'decorators' => $this->buttonDecorators,
        ));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
        	array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}
