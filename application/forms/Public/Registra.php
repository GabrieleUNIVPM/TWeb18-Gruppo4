<?php

class Application_Form_Public_Registra extends App_Form_Abstract
{
    
     protected $_publicModel;
    
    public function init() 
    {
        $this->_publicModel = new Application_Model_Public();
        $this->setMethod('post');
        $this->setName('registra');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        //$this->setAttrib('ruolo','user');
        
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alpha',array('StringLength',true, array(1,20))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alpha',array('StringLength',true, array(1,20))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('select', 'genere', array(
            'label' => 'Genere',
            'filters' => array('StringTrim'),
            'required' => true,
            'multiOptions' => array(
                         'M' => 'Maschio',
                         'F' => 'Femmina',
                         ),
            'decorators' => $this->elementDecorators,
                ));
        
        $this->addElement('text', 'natoil', array(
            'label' => 'Nato il (AAAA/MM/GG)',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array (array('date', false, array('yyyy/MM/dd'))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'email', array(
            'label' => 'Email',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('EmailAddress',array('StringLength',true, array(1,30))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'username', array(
            'label' => 'Username',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alnum',array('StringLength',true, array(4,15)),
                array('Db_NoRecordExists',true, 
                array('table'   => 'utenti',
                      'field'   => 'username'))),
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('password', 'password', array(
            'label' => 'Password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alnum',array('StringLength',true, array(4,15))),
            'decorators' => $this->elementDecorators,
		));
        $this->addElement('submit', 'add', array(
            'label' => 'Registrati',
            'decorators' => $this->buttonDecorators,
		));
        $this->addElement('hidden', 'ruolo', array(
            'value' => 'user'
		));
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
        		array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}