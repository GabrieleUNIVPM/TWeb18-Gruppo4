<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Application_Form_Public_Registrati extends Zend_Form
{
    // protected $_publicModel;
    
    public function init() 
    {
        // $this->_publicModel = new Application_Model_Public();
        $this->setMethod('post');
        $this->setName('registrati');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alpha',array('StringLength',true, array(1,20))),
		));
        
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alpha',array('StringLength',true, array(1,20))),
		));
        
        $this->addElement('text', 'genere', array(
            'label' => 'Genere',
            'filters' => array('StringTrim'),
            'required' => true,
            'multiOptions' => array(
                         'M' => 'Maschile',
                         'F' => 'Femminile',
                         ),
                ));
        
        $this->addElement('text', 'natoil', array(
            'label' => 'Nato il',
            'filters' => array('StringTrim'),
            'required' => true,
           // 'validators' => array('data',array('StringLength',true, array(1,20))),
		));
        
        $this->addElement('text', 'email', array(
            'label' => 'Email',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('EmailAddress',array('StringLength',true, array(1,30))),
		));
        
        $this->addElement('text', 'username', array(
            'label' => 'Username',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alnum',array('StringLength',true, array(4,15)),
                array('Db_NoRecordExists',true, 
                array('table'   => 'utenti',
                      'field'   => 'username'))),
		));
        
        $this->addElement('password', 'password', array(
            'label' => 'Password',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array('Alnum',array('StringLength',true, array(4,15))),
		));
        
        $this->addElement('hidden', 'ruolo', array(
            'value' => 'user',
                ));
        
        $this->addElement('submit', 'add', array(
            'label' => 'Registrati',
		));
    }
}