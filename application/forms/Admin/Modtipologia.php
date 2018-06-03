<?php

class Application_Form_Admin_Modtipologia extends App_Form_Abstract
{
    protected $_adminModel;
    
    public function init()
    {
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('adminmodtip');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data'); 
        
         
    }
    
    public function setValues($values){ //per precompilare la form i valori vengono settati dopo l'init
        $this->addElement('text', 'id_TE', array(
            'label' => 'ID_TIPOLOGIA',
            'attribs' => array('readonly' => 'true'),
            'filters' => array('StringTrim'),
            'value' => $values['id_TE'],
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'tipologia', array(
            'label' => 'Modifica tipologia',
            'filters' => array('StringTrim'),
            'required' => true,
            'value' => $values['tipologia'],
            'validators' => array('Alnum',array('StringLength',true, array(1,20))),
            'decorators' => $this->elementDecorators,
		));
        
       
        $this->addElement('submit', 'modtip', array(
            'label' => 'Modifica',
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