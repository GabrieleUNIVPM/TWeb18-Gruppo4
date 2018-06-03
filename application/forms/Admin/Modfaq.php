<?php

class Application_Form_Admin_Modfaq extends App_Form_Abstract
{
    protected $_adminModel;
    
    public function init()
    {
        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('adminmodfaq');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data'); 
        
         
    }
    
    public function setValues($values){ //per precompilare la form i valori vengono settati dopo l'init
        $this->addElement('hidden', 'id_F', array(
            'value' => $values['id_F'],
            ));
        
        $this->addElement('textarea', 'domanda', array(
            'label' => 'Domanda',
                'cols' => '60', 'rows' => '8',
            'value' => $values['domanda'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2000))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('textarea', 'risposta', array(
            'label' => 'Risposta',
                'cols' => '60', 'rows' => '8',
            'value' => $values['risposta'],
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength',true, array(1,2000))),
            'decorators' => $this->elementDecorators,
		));
        
       
        $this->addElement('submit', 'modfaq', array(
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