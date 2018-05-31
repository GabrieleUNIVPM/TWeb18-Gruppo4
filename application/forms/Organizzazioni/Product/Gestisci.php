<?php
class Application_Form_Organizzazioni_Product_Gestisci extends App_Form_Abstract
{
	protected $_organizzazioniModel;

        public function init()
    {
    	$this->_organizzazioniModel = new Application_Model_Organizzazioni();
        $this->setMethod('post');
        $this->setName('elimina');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');

        $this->addElement('hidden', 'add', array('value' =>$this->getId()
        ));
        
        
        $this->addElement('submit', 'gestisci', array(
            'label' => 'ELIMINA',
            'value' =>$this->getId(),
            'decorators' => $this->buttonDecorators,
        ));
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
        	array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
    ));}
}
    

